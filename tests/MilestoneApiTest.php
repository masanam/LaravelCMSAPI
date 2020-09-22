<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MilestoneApiTest extends TestCase
{
    use MakeMilestoneTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMilestone()
    {
        $milestone = $this->fakeMilestoneData();
        $this->json('POST', '/api/v1/milestones', $milestone);

        $this->assertApiResponse($milestone);
    }

    /**
     * @test
     */
    public function testReadMilestone()
    {
        $milestone = $this->makeMilestone();
        $this->json('GET', '/api/v1/milestones/'.$milestone->id);

        $this->assertApiResponse($milestone->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMilestone()
    {
        $milestone = $this->makeMilestone();
        $editedMilestone = $this->fakeMilestoneData();

        $this->json('PUT', '/api/v1/milestones/'.$milestone->id, $editedMilestone);

        $this->assertApiResponse($editedMilestone);
    }

    /**
     * @test
     */
    public function testDeleteMilestone()
    {
        $milestone = $this->makeMilestone();
        $this->json('DELETE', '/api/v1/milestones/'.$milestone->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/milestones/'.$milestone->id);

        $this->assertResponseStatus(404);
    }
}
