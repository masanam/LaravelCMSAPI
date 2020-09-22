<?php

use Faker\Factory as Faker;
use App\Models\Career;
use App\Repositories\CareerRepository;

trait MakeCareerTrait
{
    /**
     * Create fake instance of Career and save it in database
     *
     * @param array $careerFields
     * @return Career
     */
    public function makeCareer($careerFields = [])
    {
        /** @var CareerRepository $careerRepo */
        $careerRepo = App::make(CareerRepository::class);
        $theme = $this->fakeCareerData($careerFields);
        return $careerRepo->create($theme);
    }

    /**
     * Get fake instance of Career
     *
     * @param array $careerFields
     * @return Career
     */
    public function fakeCareer($careerFields = [])
    {
        return new Career($this->fakeCareerData($careerFields));
    }

    /**
     * Get fake data of Career
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCareerData($careerFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'category_id' => $fake->randomDigitNotNull,
            'title' => $fake->word,
            'seotitle' => $fake->word,
            'content' => $fake->text,
            'picture' => $fake->word,
            'status' => $fake->randomDigitNotNull,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $careerFields);
    }
}
