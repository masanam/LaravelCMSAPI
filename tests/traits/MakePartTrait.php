<?php

use Faker\Factory as Faker;
use App\Models\Part;
use App\Repositories\PartRepository;

trait MakePartTrait
{
    /**
     * Create fake instance of Part and save it in database
     *
     * @param array $partFields
     * @return Part
     */
    public function makePart($partFields = [])
    {
        /** @var PartRepository $partRepo */
        $partRepo = App::make(PartRepository::class);
        $theme = $this->fakePartData($partFields);
        return $partRepo->create($theme);
    }

    /**
     * Get fake instance of Part
     *
     * @param array $partFields
     * @return Part
     */
    public function fakePart($partFields = [])
    {
        return new Part($this->fakePartData($partFields));
    }

    /**
     * Get fake data of Part
     *
     * @param array $postFields
     * @return array
     */
    public function fakePartData($partFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'description' => $fake->text,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $partFields);
    }
}
