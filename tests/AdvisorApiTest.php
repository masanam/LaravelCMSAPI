<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdvisorApiTest extends TestCase
{
    use MakeAdvisorTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateAdvisor()
    {
        $advisor = $this->fakeAdvisorData();
        $this->json('POST', '/api/v1/advisors', $advisor);

        $this->assertApiResponse($advisor);
    }

    /**
     * @test
     */
    public function testReadAdvisor()
    {
        $advisor = $this->makeAdvisor();
        $this->json('GET', '/api/v1/advisors/'.$advisor->id);

        $this->assertApiResponse($advisor->toArray());
    }

    /**
     * @test
     */
    public function testUpdateAdvisor()
    {
        $advisor = $this->makeAdvisor();
        $editedAdvisor = $this->fakeAdvisorData();

        $this->json('PUT', '/api/v1/advisors/'.$advisor->id, $editedAdvisor);

        $this->assertApiResponse($editedAdvisor);
    }

    /**
     * @test
     */
    public function testDeleteAdvisor()
    {
        $advisor = $this->makeAdvisor();
        $this->json('DELETE', '/api/v1/advisors/'.$advisor->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/advisors/'.$advisor->id);

        $this->assertResponseStatus(404);
    }
}
