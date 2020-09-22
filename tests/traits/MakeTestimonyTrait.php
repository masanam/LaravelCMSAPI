<?php

use Faker\Factory as Faker;
use App\Models\Testimony;
use App\Repositories\TestimonyRepository;

trait MakeTestimonyTrait
{
    /**
     * Create fake instance of Testimony and save it in database
     *
     * @param array $testimonyFields
     * @return Testimony
     */
    public function makeTestimony($testimonyFields = [])
    {
        /** @var TestimonyRepository $testimonyRepo */
        $testimonyRepo = App::make(TestimonyRepository::class);
        $theme = $this->fakeTestimonyData($testimonyFields);
        return $testimonyRepo->create($theme);
    }

    /**
     * Get fake instance of Testimony
     *
     * @param array $testimonyFields
     * @return Testimony
     */
    public function fakeTestimony($testimonyFields = [])
    {
        return new Testimony($this->fakeTestimonyData($testimonyFields));
    }

    /**
     * Get fake data of Testimony
     *
     * @param array $postFields
     * @return array
     */
    public function fakeTestimonyData($testimonyFields = [])
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
        ], $testimonyFields);
    }
}
