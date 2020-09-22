<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManagementApiTest extends TestCase
{
    use MakeManagementTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateManagement()
    {
        $management = $this->fakeManagementData();
        $this->json('POST', '/api/v1/managements', $management);

        $this->assertApiResponse($management);
    }

    /**
     * @test
     */
    public function testReadManagement()
    {
        $management = $this->makeManagement();
        $this->json('GET', '/api/v1/managements/'.$management->id);

        $this->assertApiResponse($management->toArray());
    }

    /**
     * @test
     */
    public function testUpdateManagement()
    {
        $management = $this->makeManagement();
        $editedManagement = $this->fakeManagementData();

        $this->json('PUT', '/api/v1/managements/'.$management->id, $editedManagement);

        $this->assertApiResponse($editedManagement);
    }

    /**
     * @test
     */
    public function testDeleteManagement()
    {
        $management = $this->makeManagement();
        $this->json('DELETE', '/api/v1/managements/'.$management->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/managements/'.$management->id);

        $this->assertResponseStatus(404);
    }
}
