<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActionItem extends Model

{

    use HasFactory;

    protected $fillable = [

        'meeting_id',

        'task',

        'pic',

        'deadline',

        'status',

    ];

    public function meeting()

    {

        return $this->belongsTo(Meeting::class);

    }

}