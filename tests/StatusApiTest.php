<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StatusApiTest extends TestCase
{
    use MakeStatusTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateStatus()
    {
        $status = $this->fakeStatusData();
        $this->json('POST', '/api/v1/statuses', $status);

        $this->assertApiResponse($status);
    }

    /**
     * @test
     */
    public function testReadStatus()
    {
        $status = $this->makeStatus();
        $this->json('GET', '/api/v1/statuses/'.$status->id);

        $this->assertApiResponse($status->toArray());
    }

    /**
     * @test
     */
    public function testUpdateStatus()
    {
        $status = $this->makeStatus();
        $editedStatus = $this->fakeStatusData();

        $this->json('PUT', '/api/v1/statuses/'.$status->id, $editedStatus);

        $this->assertApiResponse($editedStatus);
    }

    /**
     * @test
     */
    public function testDeleteStatus()
    {
        $status = $this->makeStatus();
        $this->json('DELETE', '/api/v1/statuses/'.$status->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/statuses/'.$status->id);

        $this->assertResponseStatus(404);
    }
}
