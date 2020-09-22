<?php

use Faker\Factory as Faker;
use App\Models\Brand;
use App\Repositories\BrandRepository;

trait MakeBrandTrait
{
    /**
     * Create fake instance of Brand and save it in database
     *
     * @param array $brandFields
     * @return Brand
     */
    public function makeBrand($brandFields = [])
    {
        /** @var BrandRepository $brandRepo */
        $brandRepo = App::make(BrandRepository::class);
        $theme = $this->fakeBrandData($brandFields);
        return $brandRepo->create($theme);
    }

    /**
     * Get fake instance of Brand
     *
     * @param array $brandFields
     * @return Brand
     */
    public function fakeBrand($brandFields = [])
    {
        return new Brand($this->fakeBrandData($brandFields));
    }

    /**
     * Get fake data of Brand
     *
     * @param array $postFields
     * @return array
     */
    public function fakeBrandData($brandFields = [])
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
        ], $brandFields);
    }
}
