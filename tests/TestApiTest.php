<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestApiTest extends TestCase
{
    private $uri = '/app/task';

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShowAllTask() {
      //  $this->assertTrue(true);
        $this->json('GET',$this->uri)//-> seeJson();
           ->dump();

    }

    public function testShowOneTask() {

        $task = factory(App\Task::class)->create();
        $id = 1;
        $this->json('GET', $this->uri, '/', $id)-> seeJsonContains([
            'name'=>$task->name
           // 'done'=>$task->done,
          //  'priority'=>$task->priority

        ]);

    }



}


