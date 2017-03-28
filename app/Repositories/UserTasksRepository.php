<?php

namespace App\Repositories;

use App\Task;
use App\User;

/**
 * Class UserTasksRepository.
 */
class UserTasksRepository
{

    /**
     * Find a userTask on Database.
     *
     * @param $userID
     * @param $taskID
     * @return mixed
     *
     */
    public function findOrFail($userID,$taskID)
    {
        $user = User::findOrFail($userID);

        return $user->tasks()->findOrFail($taskID);
    }

    /**
     * Paginate a list of tasks of an user.
     *
     * @param $userID
     * @param int $perPage
     * @return mixed
     */
    public function paginate($userID, $perPage = 15)
    {
        $user = User::findOrFail($userID);

        return $user->tasks()->paginate($perPage);
    }

    /**
     * Create a userTask through an array with data.
     *
     * @param array $data
     * @param $userID
     */
    public function create(array $data, $userID)
    {
        User::findOrFail($userID);
        Task::create($data);
    }

    /**
     * Update a userTask.
     *
     * @param array $data
     * @param $userID
     * @param $taskID
     */
    public function update(array $data, $userID, $taskID)
    {
        $user = User::findOrFail($userID);
        $task = $user->tasks()->findOrFail($taskID);
        $task->update($data);
    }

    /**
     * Delete a userTask.
     *
     * @param $userID
     * @param $taskID
     */
    public function delete($userID, $taskID)
    {
        $user = User::findOrFail($userID);
        $task = $user->tasks()->findOrFail($taskID);
        $task->delete();
    }
}