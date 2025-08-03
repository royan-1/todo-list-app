<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['user_id', 'title', 'description', 'deadline', 'is_completed', 'priority'];

    protected $casts = [
        'deadline' => 'date',
        'is_completed' => 'boolean',
    ];
}
