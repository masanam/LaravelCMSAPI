<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AchievementApiTest extends TestCase
{
    use MakeAchievementTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateAchievement()
    {
        $achievement = $this->fakeAchievementData();
        $this->json('POST', '/api/v1/achievements', $achievement);

        $this->assertApiResponse($achievement);
    }

    /**
     * @test
     */
    public function testReadAchievement()
    {
        $achievement = $this->makeAchievement();
        $this->json('GET', '/api/v1/achievements/'.$achievement->id);

        $this->assertApiResponse($achievement->toArray());
    }

    /**
     * @test
     */
    public function testUpdateAchievement()
    {
        $achievement = $this->makeAchievement();
        $editedAchievement = $this->fakeAchievementData();

        $this->json('PUT', '/api/v1/achievements/'.$achievement->id, $editedAchievement);

        $this->assertApiResponse($editedAchievement);
    }

    /**
     * @test
     */
    public function testDeleteAchievement()
    {
        $achievement = $this->makeAchievement();
        $this->json('DELETE', '/api/v1/achievements/'.$achievement->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/achievements/'.$achievement->id);

        $this->assertResponseStatus(404);
    }
}
