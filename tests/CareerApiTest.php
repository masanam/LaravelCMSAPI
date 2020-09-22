<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CareerApiTest extends TestCase
{
    use MakeCareerTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCareer()
    {
        $career = $this->fakeCareerData();
        $this->json('POST', '/api/v1/careers', $career);

        $this->assertApiResponse($career);
    }

    /**
     * @test
     */
    public function testReadCareer()
    {
        $career = $this->makeCareer();
        $this->json('GET', '/api/v1/careers/'.$career->id);

        $this->assertApiResponse($career->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCareer()
    {
        $career = $this->makeCareer();
        $editedCareer = $this->fakeCareerData();

        $this->json('PUT', '/api/v1/careers/'.$career->id, $editedCareer);

        $this->assertApiResponse($editedCareer);
    }

    /**
     * @test
     */
    public function testDeleteCareer()
    {
        $career = $this->makeCareer();
        $this->json('DELETE', '/api/v1/careers/'.$career->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/careers/'.$career->id);

        $this->assertResponseStatus(404);
    }
}
