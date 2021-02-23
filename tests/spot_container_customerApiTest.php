<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class spot_container_customerApiTest extends TestCase
{
    use Makespot_container_customerTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatespot_container_customer()
    {
        $spotContainerCustomer = $this->fakespot_container_customerData();
        $this->json('POST', '/api/v1/spotContainerCustomers', $spotContainerCustomer);

        $this->assertApiResponse($spotContainerCustomer);
    }

    /**
     * @test
     */
    public function testReadspot_container_customer()
    {
        $spotContainerCustomer = $this->makespot_container_customer();
        $this->json('GET', '/api/v1/spotContainerCustomers/'.$spotContainerCustomer->id);

        $this->assertApiResponse($spotContainerCustomer->toArray());
    }

    /**
     * @test
     */
    public function testUpdatespot_container_customer()
    {
        $spotContainerCustomer = $this->makespot_container_customer();
        $editedspot_container_customer = $this->fakespot_container_customerData();

        $this->json('PUT', '/api/v1/spotContainerCustomers/'.$spotContainerCustomer->id, $editedspot_container_customer);

        $this->assertApiResponse($editedspot_container_customer);
    }

    /**
     * @test
     */
    public function testDeletespot_container_customer()
    {
        $spotContainerCustomer = $this->makespot_container_customer();
        $this->json('DELETE', '/api/v1/spotContainerCustomers/'.$spotContainerCustomer->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/spotContainerCustomers/'.$spotContainerCustomer->id);

        $this->assertResponseStatus(404);
    }
}
