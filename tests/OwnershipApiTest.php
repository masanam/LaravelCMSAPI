<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OwnershipApiTest extends TestCase
{
    use MakeOwnershipTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateOwnership()
    {
        $ownership = $this->fakeOwnershipData();
        $this->json('POST', '/api/v1/ownerships', $ownership);

        $this->assertApiResponse($ownership);
    }

    /**
     * @test
     */
    public function testReadOwnership()
    {
        $ownership = $this->makeOwnership();
        $this->json('GET', '/api/v1/ownerships/'.$ownership->id);

        $this->assertApiResponse($ownership->toArray());
    }

    /**
     * @test
     */
    public function testUpdateOwnership()
    {
        $ownership = $this->makeOwnership();
        $editedOwnership = $this->fakeOwnershipData();

        $this->json('PUT', '/api/v1/ownerships/'.$ownership->id, $editedOwnership);

        $this->assertApiResponse($editedOwnership);
    }

    /**
     * @test
     */
    public function testDeleteOwnership()
    {
        $ownership = $this->makeOwnership();
        $this->json('DELETE', '/api/v1/ownerships/'.$ownership->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/ownerships/'.$ownership->id);

        $this->assertResponseStatus(404);
    }
}
