<?php

use App\Models\spot_container_customer;
use App\Repositories\spot_container_customerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class spot_container_customerRepositoryTest extends TestCase
{
    use Makespot_container_customerTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var spot_container_customerRepository
     */
    protected $spotContainerCustomerRepo;

    public function setUp()
    {
        parent::setUp();
        $this->spotContainerCustomerRepo = App::make(spot_container_customerRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatespot_container_customer()
    {
        $spotContainerCustomer = $this->fakespot_container_customerData();
        $createdspot_container_customer = $this->spotContainerCustomerRepo->create($spotContainerCustomer);
        $createdspot_container_customer = $createdspot_container_customer->toArray();
        $this->assertArrayHasKey('id', $createdspot_container_customer);
        $this->assertNotNull($createdspot_container_customer['id'], 'Created spot_container_customer must have id specified');
        $this->assertNotNull(spot_container_customer::find($createdspot_container_customer['id']), 'spot_container_customer with given id must be in DB');
        $this->assertModelData($spotContainerCustomer, $createdspot_container_customer);
    }

    /**
     * @test read
     */
    public function testReadspot_container_customer()
    {
        $spotContainerCustomer = $this->makespot_container_customer();
        $dbspot_container_customer = $this->spotContainerCustomerRepo->find($spotContainerCustomer->id);
        $dbspot_container_customer = $dbspot_container_customer->toArray();
        $this->assertModelData($spotContainerCustomer->toArray(), $dbspot_container_customer);
    }

    /**
     * @test update
     */
    public function testUpdatespot_container_customer()
    {
        $spotContainerCustomer = $this->makespot_container_customer();
        $fakespot_container_customer = $this->fakespot_container_customerData();
        $updatedspot_container_customer = $this->spotContainerCustomerRepo->update($fakespot_container_customer, $spotContainerCustomer->id);
        $this->assertModelData($fakespot_container_customer, $updatedspot_container_customer->toArray());
        $dbspot_container_customer = $this->spotContainerCustomerRepo->find($spotContainerCustomer->id);
        $this->assertModelData($fakespot_container_customer, $dbspot_container_customer->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletespot_container_customer()
    {
        $spotContainerCustomer = $this->makespot_container_customer();
        $resp = $this->spotContainerCustomerRepo->delete($spotContainerCustomer->id);
        $this->assertTrue($resp);
        $this->assertNull(spot_container_customer::find($spotContainerCustomer->id), 'spot_container_customer should not exist in DB');
    }
}
