<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use App\Task;
use App\Transformers\TaskTransformer;
use Auth;
use Gate;
use Illuminate\Http\Request;

/**
 * Class TasksController
 *
 * [Descripció de la classe] -> Opcional (accepta HTML bàsic)
 *
 * @package App\Http\Controllers
 */
class TasksController extends Controller
{
    /**
     * Repository object
     *
     * @var TaskRepository
     */
    protected $repository;

    /**
     * TasksController constructor.
     *
     * @param TaskTransformer $transformer
     * @param TaskRepository $repository
     */
    public function __construct(TaskTransformer $transformer, TaskRepository $repository)
    {
        parent::__construct($transformer);

        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = $this->repository->paginate(15);
        return $this->generatePaginatedResponse($tasks, ['propietari' => 'Franc Auxach']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->has('user_id')) {
            $request->merge(['user_id' => Auth::id()]);
        }

        $this->repository->create($request->all());   // Retorna tots els arrays

        return response([
            'error'   => false,
            'created' => true,
            'message' => 'Task created successfully',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = $this->repository->findOrFail($id);

        return $this->transformer->transform($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->repository->update($request->all(),$id);
        return response([
            'error'   => false,
            'updated' => true,
            'message' => 'Task updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return response([
            'error'   => false,
            'destroyed' => true,
            'message' => 'Task deleted successfully',
        ], 200);
    }
}
