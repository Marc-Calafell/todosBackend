<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 * @package App
 */
class Task extends Model
{
    protected $fillable = ['name', 'done', 'priority', 'user_id'];

    /**
     * Assign an User to newly created task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
