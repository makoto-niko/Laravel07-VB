<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'task_status', 'title', 'comment'];
    // ステータスの定数
    const STATUS_NOT_STARTED = 0;  // 未着手
    const STATUS_IN_PROGRESS = 1;  // 着手中
    const STATUS_ON_HOLD = 2;      // 保留
    const STATUS_COMPLETED = 3;     // 完了

    // ステータスの表示用配列
    public static $statusLabels = [
        self::STATUS_NOT_STARTED => '未着手',
        self::STATUS_IN_PROGRESS => '着手中',
        self::STATUS_ON_HOLD => '保留',
        self::STATUS_COMPLETED => '完了'
    ];

    // ステータスの表示名を取得
    public function getStatusLabelAttribute()
    {
        return self::$statusLabels[$this->task_status] ?? '不明';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
