<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DividenApiTest extends TestCase
{
    use MakeDividenTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDividen()
    {
        $dividen = $this->fakeDividenData();
        $this->json('POST', '/api/v1/dividens', $dividen);

        $this->assertApiResponse($dividen);
    }

    /**
     * @test
     */
    public function testReadDividen()
    {
        $dividen = $this->makeDividen();
        $this->json('GET', '/api/v1/dividens/'.$dividen->id);

        $this->assertApiResponse($dividen->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDividen()
    {
        $dividen = $this->makeDividen();
        $editedDividen = $this->fakeDividenData();

        $this->json('PUT', '/api/v1/dividens/'.$dividen->id, $editedDividen);

        $this->assertApiResponse($editedDividen);
    }

    /**
     * @test
     */
    public function testDeleteDividen()
    {
        $dividen = $this->makeDividen();
        $this->json('DELETE', '/api/v1/dividens/'.$dividen->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/dividens/'.$dividen->id);

        $this->assertResponseStatus(404);
    }
}
