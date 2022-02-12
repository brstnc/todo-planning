<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = ["name" , "time", "level"];

    public function tasks()
    {
        return $this->hasMany(TaskCard::class, 'level', 'level')->select('task_id')->groupBy('task_id');
    }

    public function carts($task_id)
    {
        return $this->hasMany(TaskCard::class, 'level', 'level')->where('task_id', $task_id);
    }
}
