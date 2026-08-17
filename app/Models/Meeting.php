<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'meeting_date',
        'location',
        'participants',
        'agenda',
        'raw_notes',
        'ai_summary',
        'decisions',
        'follow_up_message',
        'health_score',
        'status',
    ];

    public function actionItems()
    {
        return $this->hasMany(ActionItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

