<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['teacher_id', 'title', 'content', 'date'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
