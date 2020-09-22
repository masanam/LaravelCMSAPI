<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestimonyApiTest extends TestCase
{
    use MakeTestimonyTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateTestimony()
    {
        $testimony = $this->fakeTestimonyData();
        $this->json('POST', '/api/v1/testimonies', $testimony);

        $this->assertApiResponse($testimony);
    }

    /**
     * @test
     */
    public function testReadTestimony()
    {
        $testimony = $this->makeTestimony();
        $this->json('GET', '/api/v1/testimonies/'.$testimony->id);

        $this->assertApiResponse($testimony->toArray());
    }

    /**
     * @test
     */
    public function testUpdateTestimony()
    {
        $testimony = $this->makeTestimony();
        $editedTestimony = $this->fakeTestimonyData();

        $this->json('PUT', '/api/v1/testimonies/'.$testimony->id, $editedTestimony);

        $this->assertApiResponse($editedTestimony);
    }

    /**
     * @test
     */
    public function testDeleteTestimony()
    {
        $testimony = $this->makeTestimony();
        $this->json('DELETE', '/api/v1/testimonies/'.$testimony->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/testimonies/'.$testimony->id);

        $this->assertResponseStatus(404);
    }
}
