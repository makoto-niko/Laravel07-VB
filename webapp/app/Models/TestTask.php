<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestTask extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'task_status', 'title', 'comment'];
    public function user()
    {
        return $this->belongsTo(TestUser::class);
    }
}
