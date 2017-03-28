<?php

namespace App\Repositories;

use App\Repositories\Contracts\Repository;
use App\User;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository implements Repository
{
    /**
     * Find a user on Database.
     *
     * @param integer $id
     * @param array $columns
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*'])
    {
        return User::findOrFail($id);
    }

    /**
     * Paginate a list of users.
     *
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15)
    {
        return User::paginate($perPage);
    }

    /**
     * Create a user throught an array with data.
     *
     * @param array $data
     */
    public function create(array $data)
    {
        User::create($data);
    }

    /**
     * Update a user.
     *
     * @param array $data
     * @param $id
     */
    public function update(array $data, $id)
    {
        $user = $this->findOrFail($id);
        $user->update($data);
    }

    /**
     * Delete a user.
     *
     * @param $id
     */
    public function delete($id)
    {
        $user = $this->findOrFail($id);
        $user->delete();
    }
}
