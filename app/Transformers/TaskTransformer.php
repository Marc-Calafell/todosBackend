<?php

namespace App\Transformers;

use App\Exceptions\IncorrectModelException;
use App\Task;

/**
 * Class TaskTransformer
 * @package App\Transformers
 */
class TaskTransformer extends Transformer
{
    /**
     * Transform a Task.
     *
     * @param $resource
     * @return array
     * @throws IncorrectModelException
     */
    public function transform($resource)
    {
        if (!$resource instanceof Task) {
            throw new IncorrectModelException();
        }

        return [
            'id'       => $resource['id'],
            'name'     => $resource['name'],
            'done'     => (bool) $resource['done'],
            'priority' => (integer) $resource['priority'],
            'user_id'  => (integer) $resource['user_id']
        ];
    }
}
