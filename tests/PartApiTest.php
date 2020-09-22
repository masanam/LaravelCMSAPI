<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PartApiTest extends TestCase
{
    use MakePartTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePart()
    {
        $part = $this->fakePartData();
        $this->json('POST', '/api/v1/parts', $part);

        $this->assertApiResponse($part);
    }

    /**
     * @test
     */
    public function testReadPart()
    {
        $part = $this->makePart();
        $this->json('GET', '/api/v1/parts/'.$part->id);

        $this->assertApiResponse($part->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePart()
    {
        $part = $this->makePart();
        $editedPart = $this->fakePartData();

        $this->json('PUT', '/api/v1/parts/'.$part->id, $editedPart);

        $this->assertApiResponse($editedPart);
    }

    /**
     * @test
     */
    public function testDeletePart()
    {
        $part = $this->makePart();
        $this->json('DELETE', '/api/v1/parts/'.$part->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/parts/'.$part->id);

        $this->assertResponseStatus(404);
    }
}
