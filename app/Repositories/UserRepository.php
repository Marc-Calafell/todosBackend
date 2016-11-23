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
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return User::findOrFail($id);
    }
}
