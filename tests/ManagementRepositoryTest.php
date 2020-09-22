<?php

use App\Models\Management;
use App\Repositories\ManagementRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManagementRepositoryTest extends TestCase
{
    use MakeManagementTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ManagementRepository
     */
    protected $managementRepo;

    public function setUp()
    {
        parent::setUp();
        $this->managementRepo = App::make(ManagementRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateManagement()
    {
        $management = $this->fakeManagementData();
        $createdManagement = $this->managementRepo->create($management);
        $createdManagement = $createdManagement->toArray();
        $this->assertArrayHasKey('id', $createdManagement);
        $this->assertNotNull($createdManagement['id'], 'Created Management must have id specified');
        $this->assertNotNull(Management::find($createdManagement['id']), 'Management with given id must be in DB');
        $this->assertModelData($management, $createdManagement);
    }

    /**
     * @test read
     */
    public function testReadManagement()
    {
        $management = $this->makeManagement();
        $dbManagement = $this->managementRepo->find($management->id);
        $dbManagement = $dbManagement->toArray();
        $this->assertModelData($management->toArray(), $dbManagement);
    }

    /**
     * @test update
     */
    public function testUpdateManagement()
    {
        $management = $this->makeManagement();
        $fakeManagement = $this->fakeManagementData();
        $updatedManagement = $this->managementRepo->update($fakeManagement, $management->id);
        $this->assertModelData($fakeManagement, $updatedManagement->toArray());
        $dbManagement = $this->managementRepo->find($management->id);
        $this->assertModelData($fakeManagement, $dbManagement->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteManagement()
    {
        $management = $this->makeManagement();
        $resp = $this->managementRepo->delete($management->id);
        $this->assertTrue($resp);
        $this->assertNull(Management::find($management->id), 'Management should not exist in DB');
    }
}
