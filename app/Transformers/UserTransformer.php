<?php

namespace App\Transformers;

use App\Exceptions\IncorrectModelException;
use App\User;

/**
 * Class UserTransformer
 * @package App\Transformers
 */
class UserTransformer extends Transformer
{
    /**
     * Transform a resource.
     *
     * @param $resource
     * @return array
     * @throws IncorrectModelException
     */
    public function transform($resource)
    {
        if (!$resource instanceof User) {
            throw new IncorrectModelException();
        }

        return [
            'name'  => $resource['name'],
            'email' => $resource['email'],
        ];
    }
}
