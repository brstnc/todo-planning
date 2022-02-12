<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCard extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'name', 'level', 'time'];

    public function task()
    {
        return $this->belongsTo(Tasks::class, 'task_id');
    }
}
