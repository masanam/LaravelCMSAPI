<?php

use Faker\Factory as Faker;
use App\Models\Milestone;
use App\Repositories\MilestoneRepository;

trait MakeMilestoneTrait
{
    /**
     * Create fake instance of Milestone and save it in database
     *
     * @param array $milestoneFields
     * @return Milestone
     */
    public function makeMilestone($milestoneFields = [])
    {
        /** @var MilestoneRepository $milestoneRepo */
        $milestoneRepo = App::make(MilestoneRepository::class);
        $theme = $this->fakeMilestoneData($milestoneFields);
        return $milestoneRepo->create($theme);
    }

    /**
     * Get fake instance of Milestone
     *
     * @param array $milestoneFields
     * @return Milestone
     */
    public function fakeMilestone($milestoneFields = [])
    {
        return new Milestone($this->fakeMilestoneData($milestoneFields));
    }

    /**
     * Get fake data of Milestone
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMilestoneData($milestoneFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'year' => $fake->word,
            'slug' => $fake->word,
            'description' => $fake->text,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $milestoneFields);
    }
}
