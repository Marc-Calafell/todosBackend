<?php

namespace App\Transformers;

use App\Exceptions\IncorrectModelException;

/**
 * Class UserTransformer
 * @package App\Transformers
 */
class UserTransformer extends Transformer
{
    /**
     * @param $resource
     * @return array
     * @throws IncorrectModelException
     */
    public function transform($resource)
    {
        if (!$resource instanceof \App\Task) {
            throw new IncorrectModelException();
        }

        return [
            'name'      => $resource['name'],
            'email'     => $resource['email'],
        ];
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 77e35ab6dc972761f25ec180c66aba89ba0b8c2c
