<?php

use App\Models\Achievement;
use App\Repositories\AchievementRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AchievementRepositoryTest extends TestCase
{
    use MakeAchievementTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AchievementRepository
     */
    protected $achievementRepo;

    public function setUp()
    {
        parent::setUp();
        $this->achievementRepo = App::make(AchievementRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateAchievement()
    {
        $achievement = $this->fakeAchievementData();
        $createdAchievement = $this->achievementRepo->create($achievement);
        $createdAchievement = $createdAchievement->toArray();
        $this->assertArrayHasKey('id', $createdAchievement);
        $this->assertNotNull($createdAchievement['id'], 'Created Achievement must have id specified');
        $this->assertNotNull(Achievement::find($createdAchievement['id']), 'Achievement with given id must be in DB');
        $this->assertModelData($achievement, $createdAchievement);
    }

    /**
     * @test read
     */
    public function testReadAchievement()
    {
        $achievement = $this->makeAchievement();
        $dbAchievement = $this->achievementRepo->find($achievement->id);
        $dbAchievement = $dbAchievement->toArray();
        $this->assertModelData($achievement->toArray(), $dbAchievement);
    }

    /**
     * @test update
     */
    public function testUpdateAchievement()
    {
        $achievement = $this->makeAchievement();
        $fakeAchievement = $this->fakeAchievementData();
        $updatedAchievement = $this->achievementRepo->update($fakeAchievement, $achievement->id);
        $this->assertModelData($fakeAchievement, $updatedAchievement->toArray());
        $dbAchievement = $this->achievementRepo->find($achievement->id);
        $this->assertModelData($fakeAchievement, $dbAchievement->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteAchievement()
    {
        $achievement = $this->makeAchievement();
        $resp = $this->achievementRepo->delete($achievement->id);
        $this->assertTrue($resp);
        $this->assertNull(Achievement::find($achievement->id), 'Achievement should not exist in DB');
    }
}
