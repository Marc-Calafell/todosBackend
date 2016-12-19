<?php

namespace App\Http\Controllers;

use App\Transformers\Contracts\Transformer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Response;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $transformer;

    /**
     * Controller constructor.
     *
     * @param $transformer
     */
    public function __construct(Transformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * Generated a paginated Response
     *
     * @param $resources
     * @param array $metadada
     * @return \Illuminate\Http\JsonResponse
     * @internal param $resource
     */
    protected function generatePaginatedResponse($resources, array $metadada = [])
    {
        $paginationData = $this->generatePaginationData($resources);

        $data = [
            'data' => $this->transformer->transformCollection($resources->items()),
        ];

        return Response::json(array_merge($metadada, $paginationData, $data), 200);
    }

    /**
     * Generate the pagination Data.
     *
     * @param $resources
     * @return array
     * @internal param $resource
     *
     */
    protected function generatePaginationData($resources)
    {
        $paginationData = [
            'total'             => $resources->total(),
            'per_page'          => $resources->perPage(),
            'current_page'      => $resources->currentPage(),
            'last_page'         => $resources->lastPage(),
            'previous_page_url' => $resources->previousPageUrl(),
            'next_page_url'     => $resources->nextPageUrl(),
            'from'              => $resources->firstItem(),
            'to'                => $resources->lastItem()
        ];

        return $paginationData;
    }
}
