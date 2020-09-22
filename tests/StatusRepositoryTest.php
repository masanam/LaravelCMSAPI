<?php

use App\Models\Status;
use App\Repositories\StatusRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StatusRepositoryTest extends TestCase
{
    use MakeStatusTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var StatusRepository
     */
    protected $statusRepo;

    public function setUp()
    {
        parent::setUp();
        $this->statusRepo = App::make(StatusRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateStatus()
    {
        $status = $this->fakeStatusData();
        $createdStatus = $this->statusRepo->create($status);
        $createdStatus = $createdStatus->toArray();
        $this->assertArrayHasKey('id', $createdStatus);
        $this->assertNotNull($createdStatus['id'], 'Created Status must have id specified');
        $this->assertNotNull(Status::find($createdStatus['id']), 'Status with given id must be in DB');
        $this->assertModelData($status, $createdStatus);
    }

    /**
     * @test read
     */
    public function testReadStatus()
    {
        $status = $this->makeStatus();
        $dbStatus = $this->statusRepo->find($status->id);
        $dbStatus = $dbStatus->toArray();
        $this->assertModelData($status->toArray(), $dbStatus);
    }

    /**
     * @test update
     */
    public function testUpdateStatus()
    {
        $status = $this->makeStatus();
        $fakeStatus = $this->fakeStatusData();
        $updatedStatus = $this->statusRepo->update($fakeStatus, $status->id);
        $this->assertModelData($fakeStatus, $updatedStatus->toArray());
        $dbStatus = $this->statusRepo->find($status->id);
        $this->assertModelData($fakeStatus, $dbStatus->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteStatus()
    {
        $status = $this->makeStatus();
        $resp = $this->statusRepo->delete($status->id);
        $this->assertTrue($resp);
        $this->assertNull(Status::find($status->id), 'Status should not exist in DB');
    }
}
