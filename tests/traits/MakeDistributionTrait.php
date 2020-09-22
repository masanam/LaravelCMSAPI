<?php

use Faker\Factory as Faker;
use App\Models\Distribution;
use App\Repositories\DistributionRepository;

trait MakeDistributionTrait
{
    /**
     * Create fake instance of Distribution and save it in database
     *
     * @param array $distributionFields
     * @return Distribution
     */
    public function makeDistribution($distributionFields = [])
    {
        /** @var DistributionRepository $distributionRepo */
        $distributionRepo = App::make(DistributionRepository::class);
        $theme = $this->fakeDistributionData($distributionFields);
        return $distributionRepo->create($theme);
    }

    /**
     * Get fake instance of Distribution
     *
     * @param array $distributionFields
     * @return Distribution
     */
    public function fakeDistribution($distributionFields = [])
    {
        return new Distribution($this->fakeDistributionData($distributionFields));
    }

    /**
     * Get fake data of Distribution
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDistributionData($distributionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'longitude' => $fake->word,
            'latitude' => $fake->word,
            'type' => $fake->randomDigitNotNull,
            'description' => $fake->text,
            'color' => $fake->word,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $distributionFields);
    }
}
