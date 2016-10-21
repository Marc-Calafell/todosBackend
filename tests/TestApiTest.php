<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function ShowAllTask() {
      //  $this->assertTrue(true);
        $this->json('GET', '/app/task')-> seeJson();
           // ->dump();

    }

    public function testShowOneTask() {


        $id = 1;
        $this->json('GET', '/app/task', '/', $id)-> seeJson();

    }



}


