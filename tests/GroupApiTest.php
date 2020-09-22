<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroupApiTest extends TestCase
{
    use MakeGroupTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateGroup()
    {
        $group = $this->fakeGroupData();
        $this->json('POST', '/api/v1/groups', $group);

        $this->assertApiResponse($group);
    }

    /**
     * @test
     */
    public function testReadGroup()
    {
        $group = $this->makeGroup();
        $this->json('GET', '/api/v1/groups/'.$group->id);

        $this->assertApiResponse($group->toArray());
    }

    /**
     * @test
     */
    public function testUpdateGroup()
    {
        $group = $this->makeGroup();
        $editedGroup = $this->fakeGroupData();

        $this->json('PUT', '/api/v1/groups/'.$group->id, $editedGroup);

        $this->assertApiResponse($editedGroup);
    }

    /**
     * @test
     */
    public function testDeleteGroup()
    {
        $group = $this->makeGroup();
        $this->json('DELETE', '/api/v1/groups/'.$group->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/groups/'.$group->id);

        $this->assertResponseStatus(404);
    }
}
