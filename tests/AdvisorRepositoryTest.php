<?php

use App\Models\Advisor;
use App\Repositories\AdvisorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdvisorRepositoryTest extends TestCase
{
    use MakeAdvisorTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AdvisorRepository
     */
    protected $advisorRepo;

    public function setUp()
    {
        parent::setUp();
        $this->advisorRepo = App::make(AdvisorRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateAdvisor()
    {
        $advisor = $this->fakeAdvisorData();
        $createdAdvisor = $this->advisorRepo->create($advisor);
        $createdAdvisor = $createdAdvisor->toArray();
        $this->assertArrayHasKey('id', $createdAdvisor);
        $this->assertNotNull($createdAdvisor['id'], 'Created Advisor must have id specified');
        $this->assertNotNull(Advisor::find($createdAdvisor['id']), 'Advisor with given id must be in DB');
        $this->assertModelData($advisor, $createdAdvisor);
    }

    /**
     * @test read
     */
    public function testReadAdvisor()
    {
        $advisor = $this->makeAdvisor();
        $dbAdvisor = $this->advisorRepo->find($advisor->id);
        $dbAdvisor = $dbAdvisor->toArray();
        $this->assertModelData($advisor->toArray(), $dbAdvisor);
    }

    /**
     * @test update
     */
    public function testUpdateAdvisor()
    {
        $advisor = $this->makeAdvisor();
        $fakeAdvisor = $this->fakeAdvisorData();
        $updatedAdvisor = $this->advisorRepo->update($fakeAdvisor, $advisor->id);
        $this->assertModelData($fakeAdvisor, $updatedAdvisor->toArray());
        $dbAdvisor = $this->advisorRepo->find($advisor->id);
        $this->assertModelData($fakeAdvisor, $dbAdvisor->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteAdvisor()
    {
        $advisor = $this->makeAdvisor();
        $resp = $this->advisorRepo->delete($advisor->id);
        $this->assertTrue($resp);
        $this->assertNull(Advisor::find($advisor->id), 'Advisor should not exist in DB');
    }
}
