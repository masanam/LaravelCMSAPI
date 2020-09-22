<?php

use Faker\Factory as Faker;
use App\Models\Varian;
use App\Repositories\VarianRepository;

trait MakeVarianTrait
{
    /**
     * Create fake instance of Varian and save it in database
     *
     * @param array $varianFields
     * @return Varian
     */
    public function makeVarian($varianFields = [])
    {
        /** @var VarianRepository $varianRepo */
        $varianRepo = App::make(VarianRepository::class);
        $theme = $this->fakeVarianData($varianFields);
        return $varianRepo->create($theme);
    }

    /**
     * Get fake instance of Varian
     *
     * @param array $varianFields
     * @return Varian
     */
    public function fakeVarian($varianFields = [])
    {
        return new Varian($this->fakeVarianData($varianFields));
    }

    /**
     * Get fake data of Varian
     *
     * @param array $postFields
     * @return array
     */
    public function fakeVarianData($varianFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'description' => $fake->text,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $varianFields);
    }
}
