<?php

namespace App\Http\Controllers;

use App\Repositories\UserTasksRepository;
use App\Transformers\TaskTransformer;
use App\User;
use Illuminate\Http\Request;

/**
 * Class UserTasksController
 * @package App\Http\Controllers
 */
class UserTasksController extends Controller
{

    protected $repository;

    /**
     * UserTasksController constructor.
     * @param TaskTransformer $transformer
     * @param UserTasksRepository $repository
     */
    public function __construct(TaskTransformer $transformer, UserTasksRepository $repository)
    {
        parent::__construct($transformer);

        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $tasks = $this->repository->paginate($id,5);

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
     * @param $userID
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$userID)
    {
        $this->repository->create($request->all(),$userID);
        return response([
            'error'   => false,
            'created' => true,
            'message' => 'Task from user created successfully',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param $userID
     * @param $taskID
     * @return \Illuminate\Http\Response
     */
    public function show($userID, $taskID)
    {

        $task = $this->repository->findOrFail($userID, $taskID);
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
     * @param $userID
     * @param $taskID
     * @return \Illuminate\Http\Response
     *
     */
    public function update(Request $request, $userID, $taskID)
    {
        $this->repository->update($request->only(['name', 'done', 'priority', 'user_id']),$userID, $taskID);

        return response([
            'error'   => false,
            'updated' => true,
            'message' => 'Task from user updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $userID
     * @param $taskID
     * @return \Illuminate\Http\Response
     */
    public function destroy($userID, $taskID)
    {
        $this->repository->delete($userID, $taskID);
        return response([
            'error'   => false,
            'deleted' => true,
            'message' => 'Task from user deleted successfully',
        ], 200);
    }
}
