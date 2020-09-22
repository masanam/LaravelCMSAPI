<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PositionApiTest extends TestCase
{
    use MakePositionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePosition()
    {
        $position = $this->fakePositionData();
        $this->json('POST', '/api/v1/positions', $position);

        $this->assertApiResponse($position);
    }

    /**
     * @test
     */
    public function testReadPosition()
    {
        $position = $this->makePosition();
        $this->json('GET', '/api/v1/positions/'.$position->id);

        $this->assertApiResponse($position->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePosition()
    {
        $position = $this->makePosition();
        $editedPosition = $this->fakePositionData();

        $this->json('PUT', '/api/v1/positions/'.$position->id, $editedPosition);

        $this->assertApiResponse($editedPosition);
    }

    /**
     * @test
     */
    public function testDeletePosition()
    {
        $position = $this->makePosition();
        $this->json('DELETE', '/api/v1/positions/'.$position->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/positions/'.$position->id);

        $this->assertResponseStatus(404);
    }
}
