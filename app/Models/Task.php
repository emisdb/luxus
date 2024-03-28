<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETE = 'complete';

    public $filters = [
        'status' => 'status',
        'user_id' => 'user_id',
        'completion_date' => 'completion_date',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'completion_date',
        'status',
    ];

    protected $columnLabels = [
        'name' => 'Задача',
        'description' => 'Описание',
        'completion_date' => 'Завершить',
        'status' => 'Статус',
        'user_id' => 'Назначена',
    ];

    public static function getStatusOptions()
    {
        return [
            self::STATUS_NEW => 'New',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_COMPLETE => 'Complete',
        ];
    }
    /**
     * Accessor method to map status enum values to labels.
     *
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        return $this->getStatusOptions()[$this->status] ?? $this->status;
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
