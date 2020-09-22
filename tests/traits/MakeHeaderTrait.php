<?php

use Faker\Factory as Faker;
use App\Models\Header;
use App\Repositories\HeaderRepository;

trait MakeHeaderTrait
{
    /**
     * Create fake instance of Header and save it in database
     *
     * @param array $headerFields
     * @return Header
     */
    public function makeHeader($headerFields = [])
    {
        /** @var HeaderRepository $headerRepo */
        $headerRepo = App::make(HeaderRepository::class);
        $theme = $this->fakeHeaderData($headerFields);
        return $headerRepo->create($theme);
    }

    /**
     * Get fake instance of Header
     *
     * @param array $headerFields
     * @return Header
     */
    public function fakeHeader($headerFields = [])
    {
        return new Header($this->fakeHeaderData($headerFields));
    }

    /**
     * Get fake data of Header
     *
     * @param array $postFields
     * @return array
     */
    public function fakeHeaderData($headerFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'album_id' => $fake->randomDigitNotNull,
            'title' => $fake->word,
            'picture' => $fake->word,
            'content' => $fake->text,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $headerFields);
    }
}
