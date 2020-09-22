<?php

use Faker\Factory as Faker;
use App\Models\Advisor;
use App\Repositories\AdvisorRepository;

trait MakeAdvisorTrait
{
    /**
     * Create fake instance of Advisor and save it in database
     *
     * @param array $advisorFields
     * @return Advisor
     */
    public function makeAdvisor($advisorFields = [])
    {
        /** @var AdvisorRepository $advisorRepo */
        $advisorRepo = App::make(AdvisorRepository::class);
        $theme = $this->fakeAdvisorData($advisorFields);
        return $advisorRepo->create($theme);
    }

    /**
     * Get fake instance of Advisor
     *
     * @param array $advisorFields
     * @return Advisor
     */
    public function fakeAdvisor($advisorFields = [])
    {
        return new Advisor($this->fakeAdvisorData($advisorFields));
    }

    /**
     * Get fake data of Advisor
     *
     * @param array $postFields
     * @return array
     */
    public function fakeAdvisorData($advisorFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'slug' => $fake->word,
            'description' => $fake->text,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $advisorFields);
    }
}
