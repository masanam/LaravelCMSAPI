<?php

use App\Models\Testimony;
use App\Repositories\TestimonyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestimonyRepositoryTest extends TestCase
{
    use MakeTestimonyTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TestimonyRepository
     */
    protected $testimonyRepo;

    public function setUp()
    {
        parent::setUp();
        $this->testimonyRepo = App::make(TestimonyRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateTestimony()
    {
        $testimony = $this->fakeTestimonyData();
        $createdTestimony = $this->testimonyRepo->create($testimony);
        $createdTestimony = $createdTestimony->toArray();
        $this->assertArrayHasKey('id', $createdTestimony);
        $this->assertNotNull($createdTestimony['id'], 'Created Testimony must have id specified');
        $this->assertNotNull(Testimony::find($createdTestimony['id']), 'Testimony with given id must be in DB');
        $this->assertModelData($testimony, $createdTestimony);
    }

    /**
     * @test read
     */
    public function testReadTestimony()
    {
        $testimony = $this->makeTestimony();
        $dbTestimony = $this->testimonyRepo->find($testimony->id);
        $dbTestimony = $dbTestimony->toArray();
        $this->assertModelData($testimony->toArray(), $dbTestimony);
    }

    /**
     * @test update
     */
    public function testUpdateTestimony()
    {
        $testimony = $this->makeTestimony();
        $fakeTestimony = $this->fakeTestimonyData();
        $updatedTestimony = $this->testimonyRepo->update($fakeTestimony, $testimony->id);
        $this->assertModelData($fakeTestimony, $updatedTestimony->toArray());
        $dbTestimony = $this->testimonyRepo->find($testimony->id);
        $this->assertModelData($fakeTestimony, $dbTestimony->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteTestimony()
    {
        $testimony = $this->makeTestimony();
        $resp = $this->testimonyRepo->delete($testimony->id);
        $this->assertTrue($resp);
        $this->assertNull(Testimony::find($testimony->id), 'Testimony should not exist in DB');
    }
}
