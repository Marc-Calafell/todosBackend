<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class TasksApiTest.
 */
class TasksApiTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * RESOURCE URL ON API.
     *
     * @var string
     */
    protected $uri = '/api/v1/task';

    /**
     * Default number of tasks created in database.
     */
    const DEFAULT_NUMBER_OF_TASKS = 5;

    /**
     * Default user_id created in database.
     */
    const DEFAULT_USER_ID = 1;

    /**
     * Seed database with tasks.
     *
     * @param int $numberOfTasks to create
     */
    protected function seedDatabaseWithTasks($numberOfTasks = self::DEFAULT_NUMBER_OF_TASKS)
    {
        factory(App\Task::class, self::DEFAULT_NUMBER_OF_TASKS)->create(['user_id' => self::DEFAULT_USER_ID]);
    }

    /**
     * Create task.
     *
     * @return mixed
     */
    protected function createTask()
    {
        return factory(App\Task::class)->make(['user_id' => self::DEFAULT_USER_ID]);
    }

    /**
     * Convert task to array.
     *
     * @param $task
     *
     * @return array
     */
    protected function convertTaskToArray($task)
    {
        //        return $task->toArray();
        return [
            'name'     => $task->name,
            'done'     => $task->done,
            'priority' => $task->priority,
            'user_id'  => $task->user_id,
//            "updated_at" => $task->updated_at,
//            "created_at" => $task->created_at,
//            "id" => $task->id
        ];
    }

    /**
     * Create and persist task on database.
     *
     * @return mixed
     */
    protected function createAndPersistTask()
    {
        return factory(App\Task::class)->create(['user_id' => self::DEFAULT_USER_ID]);
    }

    protected function login()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user, 'api');
//        return $this;
    }

    public function userNotAuthenticated()
    {
        $response = $this->json('GET', $this->uri)->getResult();
        $this->assertEquals(401, $response->status());
        // TODO: test message error
    }

    /**
     * Test Retrieve all tasks.
     *
     * @group failing
     *
     * @return void
     */
    public function testRetrieveAllTasks()
    {
        //Seed database
        $this->seedDatabaseWithTasks();

        $this->login();
        $this->json('GET', $this->uri)
            ->seeJsonStructure([
                'propietari',
                'total',
                'per_page',
                'current_page',
                'last_page',
                'previous_page_url',
                'next_page_url',
                'data' => [
                    '*' => [
                        'name',
                        'done',
                        'priority',
                        'user_id'
                    ],
                ],
            ])
            ->assertEquals(
                self::DEFAULT_NUMBER_OF_TASKS,
                count($this->decodeResponseJson()['data'])
            );
    }

    /**
     * Test Retrieve one task.
     *
     * @group failing
     *
     * @return void
     */
    public function testRetrieveOneTask()
    {
        //Create task in database
        $task = $this->createAndPersistTask();

        $this->login();

        $this->json('GET', $this->uri.'/'.$task->id)
            ->seeJsonStructure(
                ['name', 'done', 'priority'])
            ->seeJsonContains([
                'name'     => $task->name,
                'done'     => (bool) $task->done,
                'priority' => (int) $task->priority,
                'user_id'  => (int) $task->user_id
            ]);
    }

    /**
     * Test Create new task.
     *
     * @group failing
     *
     * @return void
     */
    public function testCreateNewTask()
    {
        $task = $this->createTask();

        $this->login();

        $this->json('POST', $this->uri, $atask = $this->convertTaskToArray($task))
            ->seeJson([
                'created' => true,
            ])
            ->seeInDatabase('tasks', $atask);
    }

    /**
     * Test update existing task.
     *
     * @group failing
     *
     * @return void
     */
    public function testUpdateExistingTask()
    {
        $task = $this->createAndPersistTask();
        $task->done = !$task->done;
        $task->name = 'New task name';
        $task->save();

        $this->login();

        $this->json('PUT', $this->uri.'/'.$task->id, $atask = $this->convertTaskToArray($task))
            ->seeJson([
                'updated' => true,
            ])
            ->seeInDatabase('tasks', $atask);
    }

    /**
     * Test delete existing task.
     *
     * @group failing
     *
     * @return void
     */
    public function testDeleteExistingTask()
    {
        $task = $this->createAndPersistTask();

        $this->login();

        $this->json('DELETE', $this->uri.'/'.$task->id, $atask = $this->convertTaskToArray($task))
            ->seeJson([
                'destroyed' => true,
            ])
            ->notSeeInDatabase('tasks', $atask);
    }

    /**
     * Test not exists.
     *
     * @param $http_method
     */
    protected function aTestNotExists($http_method)
    {
        $this->login();

        $this->json($http_method, $this->uri.'/99999999')
            ->seeJson([
                'status' => 404,
            ])
            ->assertEquals(404, $this->response->status());
    }

    /**
     * Test get not existing task.
     *
     * @group failing
     *
     * @return void
     */
    public function testGetNotExistingTask()
    {
        $this->aTestNotExists('GET');
    }

    /**
     * Test delete not existing task.
     *
     * @group failing
     *
     * @return void
     */
    public function testUpdateNotExistingTask()
    {
        $this->aTestNotExists('PUT');
    }


}