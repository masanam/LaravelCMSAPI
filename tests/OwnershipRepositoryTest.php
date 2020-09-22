<?php

use App\Models\Ownership;
use App\Repositories\OwnershipRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OwnershipRepositoryTest extends TestCase
{
    use MakeOwnershipTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var OwnershipRepository
     */
    protected $ownershipRepo;

    public function setUp()
    {
        parent::setUp();
        $this->ownershipRepo = App::make(OwnershipRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateOwnership()
    {
        $ownership = $this->fakeOwnershipData();
        $createdOwnership = $this->ownershipRepo->create($ownership);
        $createdOwnership = $createdOwnership->toArray();
        $this->assertArrayHasKey('id', $createdOwnership);
        $this->assertNotNull($createdOwnership['id'], 'Created Ownership must have id specified');
        $this->assertNotNull(Ownership::find($createdOwnership['id']), 'Ownership with given id must be in DB');
        $this->assertModelData($ownership, $createdOwnership);
    }

    /**
     * @test read
     */
    public function testReadOwnership()
    {
        $ownership = $this->makeOwnership();
        $dbOwnership = $this->ownershipRepo->find($ownership->id);
        $dbOwnership = $dbOwnership->toArray();
        $this->assertModelData($ownership->toArray(), $dbOwnership);
    }

    /**
     * @test update
     */
    public function testUpdateOwnership()
    {
        $ownership = $this->makeOwnership();
        $fakeOwnership = $this->fakeOwnershipData();
        $updatedOwnership = $this->ownershipRepo->update($fakeOwnership, $ownership->id);
        $this->assertModelData($fakeOwnership, $updatedOwnership->toArray());
        $dbOwnership = $this->ownershipRepo->find($ownership->id);
        $this->assertModelData($fakeOwnership, $dbOwnership->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteOwnership()
    {
        $ownership = $this->makeOwnership();
        $resp = $this->ownershipRepo->delete($ownership->id);
        $this->assertTrue($resp);
        $this->assertNull(Ownership::find($ownership->id), 'Ownership should not exist in DB');
    }
}
