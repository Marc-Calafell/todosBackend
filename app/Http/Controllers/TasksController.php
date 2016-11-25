<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use App\Task;
use App\Transformers\TaskTransformer;
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
        // $this->paginator = Paginator($transformer);
        parent::__construct($transformer);

        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        abort(500);
        $tasks = Task::paginate(15);
//        dd($tasks);
        return $this->generatePaginatedResponse($tasks, ['propietari' => 'marc calafell']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
        Task::create($request->all());   // Retorna tots els arrays
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
        //        $task = Task::findOrFail($id);
        $task = $this->repository->find($id);

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
        Task::findOrFail($id)->update($request->all());
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
        Task::destroy($id);
        return response([
            'error'   => false,
            'destroyed' => true,
            'message' => 'Task deleted successfully',
        ], 200);
    }
}
