<?php

namespace App\Repositories\Contracts;

/**
 * Interface Repository
 * @package App\Repositories\Contracts
 */
/**
 * Interface Repository
 * @package App\Repositories\Contracts
 */
interface Repository
{
    /**
     * Find a Repository.
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*']);

    /**
     * @param int $perPage
     * @return mixed
     */
    public function paginate($perPage = 15);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
