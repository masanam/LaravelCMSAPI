<?php

use Faker\Factory as Faker;
use App\Models\Release;
use App\Repositories\ReleaseRepository;

trait MakeReleaseTrait
{
    /**
     * Create fake instance of Release and save it in database
     *
     * @param array $releaseFields
     * @return Release
     */
    public function makeRelease($releaseFields = [])
    {
        /** @var ReleaseRepository $releaseRepo */
        $releaseRepo = App::make(ReleaseRepository::class);
        $theme = $this->fakeReleaseData($releaseFields);
        return $releaseRepo->create($theme);
    }

    /**
     * Get fake instance of Release
     *
     * @param array $releaseFields
     * @return Release
     */
    public function fakeRelease($releaseFields = [])
    {
        return new Release($this->fakeReleaseData($releaseFields));
    }

    /**
     * Get fake data of Release
     *
     * @param array $postFields
     * @return array
     */
    public function fakeReleaseData($releaseFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'category_id' => $fake->randomDigitNotNull,
            'title' => $fake->word,
            'seotitle' => $fake->word,
            'content' => $fake->text,
            'picture' => $fake->word,
            'picture_description' => $fake->word,
            'tag' => $fake->word,
            'active' => $fake->word,
            'headline' => $fake->randomDigitNotNull,
            'hits' => $fake->randomDigitNotNull,
            'status' => $fake->randomDigitNotNull,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $releaseFields);
    }
}
