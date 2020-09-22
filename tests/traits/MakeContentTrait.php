<?php

use Faker\Factory as Faker;
use App\Models\Content;
use App\Repositories\ContentRepository;

trait MakeContentTrait
{
    /**
     * Create fake instance of Content and save it in database
     *
     * @param array $contentFields
     * @return Content
     */
    public function makeContent($contentFields = [])
    {
        /** @var ContentRepository $contentRepo */
        $contentRepo = App::make(ContentRepository::class);
        $theme = $this->fakeContentData($contentFields);
        return $contentRepo->create($theme);
    }

    /**
     * Get fake instance of Content
     *
     * @param array $contentFields
     * @return Content
     */
    public function fakeContent($contentFields = [])
    {
        return new Content($this->fakeContentData($contentFields));
    }

    /**
     * Get fake data of Content
     *
     * @param array $postFields
     * @return array
     */
    public function fakeContentData($contentFields = [])
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
        ], $contentFields);
    }
}
