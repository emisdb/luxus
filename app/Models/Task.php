<?php

namespace App\Models;

use App\Jobs\MailTaskPendingJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
        'user_id',
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
    public function search($request){
        $query = $this->newQuery()->with('user')->orderBy('created_at', 'desc');
        foreach ($this->filters as $field => $filter ) {
            if ($request->has($filter)) {
                $query->where($field, $request->$filter);
            }
        }
         // Paginate the results
        $tasks = $query->paginate($request->per_page ?? 5);
        return $tasks;
    }
    public static function sendPendingEmails()
    {
        $overdueTasks = self::where('completion_date', '<', Carbon::today())
            ->whereNotNull('completion_date')
            ->where('status', '!=', self::STATUS_COMPLETE)
            ->get();

        foreach ($overdueTasks as $task) {
            MailTaskPendingJob::dispatch($task->user, $task);
        }
    }


}
