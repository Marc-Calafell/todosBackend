<?php

namespace App\Repositories;

use App\Repositories\Contracts\Repository;
use App\Task;

/**
 * Class TaskRepository
 * @package App\Repositories
 */
class TaskRepository implements Repository
{
    /**
     * Find a Task.
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return Task::findOrFail($id);
    }
}
