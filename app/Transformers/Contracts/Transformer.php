<?php

namespace App\Transformers\Contracts;

/**
 * Interface Transformer
 * @package App\Transformers\Contracts
 */
interface Transformer
{
    /**
     * Transform a resource.
     *
     * @param $resource
     * @return mixed
     */
    public function transform($resource);

    /**
     * Transform a Collection of a Resource.
     *
     * @param $resource
     * @return mixed
     */
    public function transformCollection($resource);
}
