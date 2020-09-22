<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DirectorApiTest extends TestCase
{
    use MakeDirectorTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDirector()
    {
        $director = $this->fakeDirectorData();
        $this->json('POST', '/api/v1/directors', $director);

        $this->assertApiResponse($director);
    }

    /**
     * @test
     */
    public function testReadDirector()
    {
        $director = $this->makeDirector();
        $this->json('GET', '/api/v1/directors/'.$director->id);

        $this->assertApiResponse($director->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDirector()
    {
        $director = $this->makeDirector();
        $editedDirector = $this->fakeDirectorData();

        $this->json('PUT', '/api/v1/directors/'.$director->id, $editedDirector);

        $this->assertApiResponse($editedDirector);
    }

    /**
     * @test
     */
    public function testDeleteDirector()
    {
        $director = $this->makeDirector();
        $this->json('DELETE', '/api/v1/directors/'.$director->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/directors/'.$director->id);

        $this->assertResponseStatus(404);
    }
}
