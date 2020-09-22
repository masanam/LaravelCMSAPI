<?php

use Faker\Factory as Faker;
use App\Models\Section;
use App\Repositories\SectionRepository;

trait MakeSectionTrait
{
    /**
     * Create fake instance of Section and save it in database
     *
     * @param array $sectionFields
     * @return Section
     */
    public function makeSection($sectionFields = [])
    {
        /** @var SectionRepository $sectionRepo */
        $sectionRepo = App::make(SectionRepository::class);
        $theme = $this->fakeSectionData($sectionFields);
        return $sectionRepo->create($theme);
    }

    /**
     * Get fake instance of Section
     *
     * @param array $sectionFields
     * @return Section
     */
    public function fakeSection($sectionFields = [])
    {
        return new Section($this->fakeSectionData($sectionFields));
    }

    /**
     * Get fake data of Section
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSectionData($sectionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'slug' => $fake->word,
            'content' => $fake->text,
            'created_by' => $fake->randomDigitNotNull,
            'type' => $fake->randomDigitNotNull,
            'orderid' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $sectionFields);
    }
}
