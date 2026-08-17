<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\ActionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MeetingController extends Controller
{
    public function index()
    {
        $meetings = Meeting::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('meetings.index', compact('meetings'));
    }

    public function create()
    {
        return view('meetings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meeting_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'participants' => 'nullable|string',
            'agenda' => 'nullable|string|max:255',
            'raw_notes' => 'required|string',
        ]);

        Meeting::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'meeting_date' => $request->meeting_date,
            'location' => $request->location,
            'participants' => $request->participants,
            'agenda' => $request->agenda,
            'raw_notes' => $request->raw_notes,
            'status' => 'Draft',
        ]);

        return redirect()->route('meetings.index')->with('success', 'Notulensi berhasil dibuat.');
    }

    public function show(Meeting $meeting)
    {
        $this->authorizeMeeting($meeting);

        $meeting->load('actionItems');

        return view('meetings.show', compact('meeting'));
    }

    public function edit(Meeting $meeting)
    {
        $this->authorizeMeeting($meeting);

        return view('meetings.edit', compact('meeting'));
    }

    public function update(Request $request, Meeting $meeting)
    {
        $this->authorizeMeeting($meeting);

        $request->validate([
            'title' => 'required|string|max:255',
            'meeting_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'participants' => 'nullable|string',
            'agenda' => 'nullable|string|max:255',
            'raw_notes' => 'required|string',
            'status' => 'required|string|max:50',
        ]);

        $meeting->update($request->only([
            'title',
            'meeting_date',
            'location',
            'participants',
            'agenda',
            'raw_notes',
            'status',
        ]));

        return redirect()->route('meetings.show', $meeting)->with('success', 'Notulensi berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Meeting $meeting)
    {
        $this->authorizeMeeting($meeting);

        $request->validate([
            'status' => 'required|in:Draft,Final',
        ]);

        $meeting->update([
            'status' => $request->status,
        ]);

        return back();
    }

    public function destroy(Meeting $meeting)
    {
        $this->authorizeMeeting($meeting);

        $meeting->delete();

        return redirect()->route('meetings.index')->with('success', 'Notulensi berhasil dihapus.');
    }

    public function generateAI(Meeting $meeting)
    {
        $this->authorizeMeeting($meeting);

        $rawNotes = $meeting->raw_notes;
        $apiKey = env('GROQ_API_KEY');
        $model = env('AI_MODEL', 'llama-3.1-8b-instant');

        $prompt = "
Kamu adalah asisten perapihan catatan rapat bernama MOTE AI.

Tugas kamu:
1. Perbaiki typo, ejaan, tanda baca, dan kalimat yang kurang rapi.
2. Rapikan catatan rapat agar lebih formal, jelas, dan mudah dibaca.
3. Jangan menambahkan informasi baru yang tidak ada di catatan.
4. Jangan membuat action item otomatis.
5. Jangan mengubah makna asli catatan.
6. Gunakan bahasa Indonesia yang rapi.

Format jawaban wajib:

Catatan Rapat yang Sudah Diperbaiki:
...

Hasil Rapat:
- ...

Catatan mentah:
{$rawNotes}
";

        $aiText = null;
        $followUpMessage = null;
        $successMessage = 'Catatan rapat berhasil diperbaiki menggunakan MOTE AI.';

        if ($apiKey) {
            $response = Http::timeout(60)
                ->withToken($apiKey)
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => $model,
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $prompt,
                        ],
                    ],
                    'temperature' => 0.2,
                ]);

            if ($response->successful()) {
                $aiText = $response->json('choices.0.message.content');
            }

            if ($response->status() === 429) {
                $successMessage = 'Kuota Groq sedang penuh, jadi MOTE AI memakai fallback otomatis agar catatan tetap diperbaiki.';
            } elseif ($response->failed()) {
                $successMessage = 'Request ke Groq gagal, jadi MOTE AI memakai fallback otomatis agar catatan tetap diperbaiki.';
            }
        } else {
            $successMessage = 'GROQ_API_KEY belum terbaca, jadi MOTE AI memakai fallback otomatis.';
        }

        if (!$aiText) {
            $aiText = "Catatan Rapat yang Sudah Diperbaiki:\n"
                . ucfirst(trim($rawNotes))
                . "\n\nHasil Rapat:\n"
                . "- Catatan rapat telah dirapikan agar lebih mudah dibaca.\n"
                . "- Kalimat dalam catatan disusun ulang tanpa mengubah makna asli.\n\n"
                . "Catatan Tambahan:\n"
                . "- Silakan periksa kembali hasil catatan sebelum dibagikan.\n"
                . "- Tambahkan catatan tindak lanjut secara manual jika diperlukan.";
        }

        if ($apiKey && $aiText) {
            $followUpPrompt = "
Buat pesan follow-up singkat untuk grup WhatsApp berdasarkan catatan rapat berikut.

Aturan:
1. Gunakan bahasa Indonesia.
2. Buat sopan, jelas, dan tidak terlalu panjang.
3. Jangan menambahkan informasi baru.
4. Fokus pada penyampaian bahwa catatan rapat sudah dirapikan dan dapat dicek kembali.

Catatan rapat:
{$aiText}
";

            $followUpResponse = Http::timeout(60)
                ->withToken($apiKey)
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => $model,
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $followUpPrompt,
                        ],
                    ],
                    'temperature' => 0.2,
                ]);

            if ($followUpResponse->successful()) {
                $followUpMessage = $followUpResponse->json('choices.0.message.content');
            }
        }

        if (!$followUpMessage) {
            $followUpMessage = "Halo teman-teman, catatan rapat sudah dirapikan. Mohon dicek kembali agar informasi penting dapat dipastikan sudah sesuai.";
        }

        $meeting->update([
            'ai_summary' => $aiText,
            'decisions' => 'Catatan rapat telah diperbaiki menggunakan MOTE AI.',
            'follow_up_message' => $followUpMessage,
            'health_score' => 90,
            'status' => 'Final',
        ]);

        return redirect()->route('meetings.show', $meeting)->with('success', $successMessage);
    }

    public function storeActionItem(Request $request, Meeting $meeting)
    {
        $this->authorizeMeeting($meeting);

        $request->validate([
            'task' => 'required|string|max:1000',
            'pic' => 'nullable|string|max:255',
            'deadline' => 'nullable|date',
        ]);

        $meeting->actionItems()->create([
            'task' => $request->task,
            'pic' => $request->pic,
            'deadline' => $request->deadline,
            'status' => 'Pending',
        ]);

        return back()->with('success', 'Catatan tindak lanjut berhasil ditambahkan.');
    }

    public function toggleActionItemStatus(Request $request, ActionItem $actionItem)
    {
        $meeting = $actionItem->meeting;

        if ($meeting->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:Pending,Done',
        ]);

        $actionItem->update([
            'status' => $request->status,
        ]);

        return back();
    }

    private function authorizeMeeting(Meeting $meeting)
    {
        if ($meeting->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
