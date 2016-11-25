<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class UsersApiTest
 */
class UsersApiTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * RESOURCE URL ON API.
     *
     * @var string
     */
    protected $uri = '/api/v1/user';

    /**
     * Default number of users created in database.
     */
    const DEFAULT_NUMBER_OF_USERS = 5;

    /**
     * Seed database with users.
     *
     * @param int $numberOfUsers to create
     */
    protected function seedDatabaseWithUsers($numberOfUsers = self::DEFAULT_NUMBER_OF_USERS)
    {
        factory(App\User::class, $numberOfUsers)->create();
    }

    /**
     * Create user.
     *
     * @return mixed
     */
    protected function createUser()
    {
        return factory(App\User::class)->make();
    }

    /**
     * Convert user to array.
     *
     * @param $user
     *
     * @return array
     */
    protected function convertUserToArray($user)
    {
        return [
            'name'  => $user->name,
            'email' => $user->email,
            'password' => $user->password
        ];
    }

    /**
     * Create and persist user on database.
     *
     * @return mixed
     */
    protected function createAndPersistUser()
    {
        return factory(App\User::class)->create();
    }

    //TODO ADD TEST FOR AUTHENTICATION AND REFACTOR EXISTING TESTS
    //NOT AUTHORIZED: $this->assertEquals(301, $response->status());

    /**
     * Test Retrieve all users.
     *
     * @group failing2
     *
     * @return void
     */
    public function testRetrieveAllUsers()
    {
        //Seed database
        $this->seedDatabaseWithUsers();

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
                        'email',
                    ],
                ],
            ])
            ->assertEquals(
                self::DEFAULT_NUMBER_OF_USERS,
                count($this->decodeResponseJson()['data'])
            );
    }

    /**
     * Test Retrieve one user.
     *
     * @group failing2
     *
     * @return void
     */
    public function testRetrieveOneUser()
    {
        //Create user in database
        $user = $this->createAndPersistUser();

        $this->json('GET', $this->uri.'/'.$user->id)
            ->seeJsonStructure(
                ['name', 'email'])
            ->seeJsonContains([
                'name'  => $user->name,
                'email' => $user->email,
            ]);
    }

    /**
     * Test Create new user.
     *
     * @group failing2
     *
     * @return void
     */
    public function testCreateNewUser()
    {
        $user = $this->createUser();
        $this->json('POST', $this->uri, $anuser = $this->convertUserToArray($user))
            ->seeJson([
                'created' => true,
            ])
            ->seeInDatabase('users', $anuser);
    }

    /**
     * Test update existing user.
     *
     * @group failing2
     *
     * @return void
     */
    public function testUpdateExistingUser()
    {
        $user = $this->createAndPersistUser();
        $user->name = 'New user name';
        $user->save();
        $this->json('PUT', $this->uri.'/'.$user->id, $anuser = $this->convertUserToArray($user))
            ->seeJson([
                'updated' => true,
            ])
            ->seeInDatabase('users', $anuser);
    }

    /**
     * Test delete existing user.
     *
     * @group failing2
     *
     * @return void
     */
    public function testDeleteExistingUser()
    {
        $user = $this->createAndPersistUser();
        $this->json('DELETE', $this->uri.'/'.$user->id, $anuser = $this->convertUserToArray($user))
            ->seeJson([
                'destroyed' => true,
            ])
            ->notSeeInDatabase('users', $anuser);
    }

    /**
     * Test not exists.
     *
     * @param $http_method
     */
    protected function testNotExists($http_method)
    {
        $this->json($http_method, $this->uri.'/99999999')
            ->seeJson([
                'status' => 404,
            ])
            ->assertEquals(404, $this->response->status());
    }

    /**
     * Test get not existing user.
     *
     * @group failing2
     *
     * @return void
     */
    public function testGetNotExistingUser()
    {
        $this->testNotExists('GET');
    }

    /**
     * Test delete not existing user.
     *
     * @group failing2
     *
     * @return void
     */
    public function testUpdateNotExistingUser()
    {
        $this->testNotExists('PUT');
    }

    /**
     * Test pagination.
     *
     * @return void
     */
    public function testPagination()
    {
        //TODO
    }

    //TODO: Test validation
}
