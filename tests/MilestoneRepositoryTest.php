<?php

use App\Models\Milestone;
use App\Repositories\MilestoneRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MilestoneRepositoryTest extends TestCase
{
    use MakeMilestoneTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MilestoneRepository
     */
    protected $milestoneRepo;

    public function setUp()
    {
        parent::setUp();
        $this->milestoneRepo = App::make(MilestoneRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMilestone()
    {
        $milestone = $this->fakeMilestoneData();
        $createdMilestone = $this->milestoneRepo->create($milestone);
        $createdMilestone = $createdMilestone->toArray();
        $this->assertArrayHasKey('id', $createdMilestone);
        $this->assertNotNull($createdMilestone['id'], 'Created Milestone must have id specified');
        $this->assertNotNull(Milestone::find($createdMilestone['id']), 'Milestone with given id must be in DB');
        $this->assertModelData($milestone, $createdMilestone);
    }

    /**
     * @test read
     */
    public function testReadMilestone()
    {
        $milestone = $this->makeMilestone();
        $dbMilestone = $this->milestoneRepo->find($milestone->id);
        $dbMilestone = $dbMilestone->toArray();
        $this->assertModelData($milestone->toArray(), $dbMilestone);
    }

    /**
     * @test update
     */
    public function testUpdateMilestone()
    {
        $milestone = $this->makeMilestone();
        $fakeMilestone = $this->fakeMilestoneData();
        $updatedMilestone = $this->milestoneRepo->update($fakeMilestone, $milestone->id);
        $this->assertModelData($fakeMilestone, $updatedMilestone->toArray());
        $dbMilestone = $this->milestoneRepo->find($milestone->id);
        $this->assertModelData($fakeMilestone, $dbMilestone->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMilestone()
    {
        $milestone = $this->makeMilestone();
        $resp = $this->milestoneRepo->delete($milestone->id);
        $this->assertTrue($resp);
        $this->assertNull(Milestone::find($milestone->id), 'Milestone should not exist in DB');
    }
}
