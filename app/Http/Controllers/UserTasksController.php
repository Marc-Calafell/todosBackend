<?php

namespace App\Http\Controllers;

use App\Transformers\TaskTransformer;
use App\User;
use Illuminate\Http\Request;

/**
 * Class UserTasksController
 * @package App\Http\Controllers
 */
class UserTasksController extends Controller
{
    /**
     * UserTasksController constructor.
     * @param TaskTransformer $transformer
     */
    public function __construct(TaskTransformer $transformer)
    {
        parent::__construct($transformer);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = User::findOrFail($id);

        $tasks = $user->tasks()->paginate(15);

        return $this->generatePaginatedResponse($tasks, ['propietari' => 'Marc Calafell']);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $idUser
     * @param $idTask
     * @return \Illuminate\Http\Response
     * @internal param int $id
     *
     */
    public function show($idUser, $idTask)
    {
        $task = User::findOrFail($idUser)->tasks[$idTask]; // Busquem primer que existeixi un usuari i a partir d'aques busquem la task
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
     * @param int                      $idUser
     * @param int                      $idTask
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idUser, $idTask)
    {
        User::findOrFail($idUser)->tasks[$idTask]->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $idUser
     * @param $idTask
     * @return \Illuminate\Http\Response
     * @internal param int $id
     *
     */
    public function destroy($idUser, $idTask)
    {
        User::findOrFail($idUser)->tasks[$idTask]->delete();
    }
}
