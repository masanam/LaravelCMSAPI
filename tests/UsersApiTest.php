<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersApiTest extends TestCase
{
    use MakeUsersTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateUsers()
    {
        $users = $this->fakeUsersData();
        $this->json('POST', '/api/v1/users', $users);

        $this->assertApiResponse($users);
    }

    /**
     * @test
     */
    public function testReadUsers()
    {
        $users = $this->makeUsers();
        $this->json('GET', '/api/v1/users/'.$users->id);

        $this->assertApiResponse($users->toArray());
    }

    /**
     * @test
     */
    public function testUpdateUsers()
    {
        $users = $this->makeUsers();
        $editedUsers = $this->fakeUsersData();

        $this->json('PUT', '/api/v1/users/'.$users->id, $editedUsers);

        $this->assertApiResponse($editedUsers);
    }

    /**
     * @test
     */
    public function testDeleteUsers()
    {
        $users = $this->makeUsers();
        $this->json('DELETE', '/api/v1/users/'.$users->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/users/'.$users->id);

        $this->assertResponseStatus(404);
    }
}
