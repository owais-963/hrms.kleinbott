<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBreak extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'start_time',
        'date',
        'note',
        'end_time',
        'attendance_id',
    ];
}
