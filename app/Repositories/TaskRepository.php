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
     * @param integer $id
     * @param array $columns
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*'])
    {
        return Task::findOrFail($id);
    }


    /**
     * Paginate a list of tasks.
     *
     * @param $perPage
     * @return mixed
     */
    public function paginate($perPage = 15)
    {
        return Task::paginate($perPage);
    }

    /**
     * Create a task throught an array with data.
     *
     * @param array $data
     */
    public function create(array $data)
    {
        Task::create($data);
    }

    /**
     * Update a task.
     *
     * @param array $data
     * @param $id
     */
    public function update(array $data, $id)
    {
        $task = $this->findOrFail($id);
        $task->update($data);
    }

    /**
     * Delete a task.
     *
     * @param $id
     */
    public function delete($id)
    {
        $task = $this->findOrFail($id);
        $task->delete();
    }
}
