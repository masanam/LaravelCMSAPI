<?php

use Faker\Factory as Faker;
use App\Models\Achievement;
use App\Repositories\AchievementRepository;

trait MakeAchievementTrait
{
    /**
     * Create fake instance of Achievement and save it in database
     *
     * @param array $achievementFields
     * @return Achievement
     */
    public function makeAchievement($achievementFields = [])
    {
        /** @var AchievementRepository $achievementRepo */
        $achievementRepo = App::make(AchievementRepository::class);
        $theme = $this->fakeAchievementData($achievementFields);
        return $achievementRepo->create($theme);
    }

    /**
     * Get fake instance of Achievement
     *
     * @param array $achievementFields
     * @return Achievement
     */
    public function fakeAchievement($achievementFields = [])
    {
        return new Achievement($this->fakeAchievementData($achievementFields));
    }

    /**
     * Get fake data of Achievement
     *
     * @param array $postFields
     * @return array
     */
    public function fakeAchievementData($achievementFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'category_id' => $fake->randomDigitNotNull,
            'title' => $fake->word,
            'seotitle' => $fake->word,
            'content' => $fake->text,
            'picture' => $fake->word,
            'year' => $fake->randomDigitNotNull,
            'status' => $fake->randomDigitNotNull,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $achievementFields);
    }
}
