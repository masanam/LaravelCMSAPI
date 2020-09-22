<?php

use Faker\Factory as Faker;
use App\Models\Share;
use App\Repositories\ShareRepository;

trait MakeShareTrait
{
    /**
     * Create fake instance of Share and save it in database
     *
     * @param array $shareFields
     * @return Share
     */
    public function makeShare($shareFields = [])
    {
        /** @var ShareRepository $shareRepo */
        $shareRepo = App::make(ShareRepository::class);
        $theme = $this->fakeShareData($shareFields);
        return $shareRepo->create($theme);
    }

    /**
     * Get fake instance of Share
     *
     * @param array $shareFields
     * @return Share
     */
    public function fakeShare($shareFields = [])
    {
        return new Share($this->fakeShareData($shareFields));
    }

    /**
     * Get fake data of Share
     *
     * @param array $postFields
     * @return array
     */
    public function fakeShareData($shareFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'tanggal' => $fake->word,
            'price' => $fake->randomDigitNotNull,
            'share' => $fake->randomDigitNotNull,
            'status' => $fake->randomDigitNotNull,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $shareFields);
    }
}
