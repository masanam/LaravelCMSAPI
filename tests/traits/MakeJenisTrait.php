<?php

use Faker\Factory as Faker;
use App\Models\Jenis;
use App\Repositories\JenisRepository;

trait MakeJenisTrait
{
    /**
     * Create fake instance of Jenis and save it in database
     *
     * @param array $jenisFields
     * @return Jenis
     */
    public function makeJenis($jenisFields = [])
    {
        /** @var JenisRepository $jenisRepo */
        $jenisRepo = App::make(JenisRepository::class);
        $theme = $this->fakeJenisData($jenisFields);
        return $jenisRepo->create($theme);
    }

    /**
     * Get fake instance of Jenis
     *
     * @param array $jenisFields
     * @return Jenis
     */
    public function fakeJenis($jenisFields = [])
    {
        return new Jenis($this->fakeJenisData($jenisFields));
    }

    /**
     * Get fake data of Jenis
     *
     * @param array $postFields
     * @return array
     */
    public function fakeJenisData($jenisFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'description' => $fake->text,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $jenisFields);
    }
}
