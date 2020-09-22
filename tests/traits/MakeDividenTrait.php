<?php

use Faker\Factory as Faker;
use App\Models\Dividen;
use App\Repositories\DividenRepository;

trait MakeDividenTrait
{
    /**
     * Create fake instance of Dividen and save it in database
     *
     * @param array $dividenFields
     * @return Dividen
     */
    public function makeDividen($dividenFields = [])
    {
        /** @var DividenRepository $dividenRepo */
        $dividenRepo = App::make(DividenRepository::class);
        $theme = $this->fakeDividenData($dividenFields);
        return $dividenRepo->create($theme);
    }

    /**
     * Get fake instance of Dividen
     *
     * @param array $dividenFields
     * @return Dividen
     */
    public function fakeDividen($dividenFields = [])
    {
        return new Dividen($this->fakeDividenData($dividenFields));
    }

    /**
     * Get fake data of Dividen
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDividenData($dividenFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'year' => $fake->randomDigitNotNull,
            'total' => $fake->randomDigitNotNull,
            'share' => $fake->randomDigitNotNull,
            'payment_date' => $fake->word,
            'status' => $fake->randomDigitNotNull,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $dividenFields);
    }
}
