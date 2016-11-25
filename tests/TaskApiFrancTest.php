<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class TaskApiFrancTest
 */
class TaskApiFrancTest extends TestCase
{
    protected $uri = '/api/v1/task';

    use DatabaseMigrations;

    /**
     * @group
     */
    public function testShowAllTasks()
    {
        //        $this->json('GET', $this->uri)   // Mètode + URL
////        ->dump();   // Per veure que ens està tornant
//            ->seeJson();

        $numTasks = 5;
        factory(App\Task::class, $numTasks)->create();   // Creem 5 tasques amb la nostra factoria
        $this->json('GET', $this->uri)
            ->seeJsonStructure([    // Comprovem que l'estructura del Json generat és correcta
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
                    ],
                ],
            ]);
//            ->assertEquals( // Comprovem que el número de tasques realitzades és igual al número de respostes Json
//                $numTasks,
//                count($this->decodeResponseJson())
//            );
    }

    /**
     * @group
     */
    public function testShowOneTask()
    {
        $task = factory(App\Task::class)->create();
        $this->json('GET', $this->uri.'/'.$task->id)
//            ->dump();
            ->seeJsonStructure(
                ['name', 'done', 'priority']
            )
            ->seeJsonContains([
                'name'     => $task->name,
                'done'     => (bool) $task->done,
                'priority' => (int) $task->priority,
            ]);
    }
}
