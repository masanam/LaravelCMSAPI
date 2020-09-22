<?php

use Faker\Factory as Faker;
use App\Models\Composition;
use App\Repositories\CompositionRepository;

trait MakeCompositionTrait
{
    /**
     * Create fake instance of Composition and save it in database
     *
     * @param array $compositionFields
     * @return Composition
     */
    public function makeComposition($compositionFields = [])
    {
        /** @var CompositionRepository $compositionRepo */
        $compositionRepo = App::make(CompositionRepository::class);
        $theme = $this->fakeCompositionData($compositionFields);
        return $compositionRepo->create($theme);
    }

    /**
     * Get fake instance of Composition
     *
     * @param array $compositionFields
     * @return Composition
     */
    public function fakeComposition($compositionFields = [])
    {
        return new Composition($this->fakeCompositionData($compositionFields));
    }

    /**
     * Get fake data of Composition
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCompositionData($compositionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->text,
            'jumlah' => $fake->randomDigitNotNull,
            'quantity' => $fake->randomDigitNotNull,
            'persentase' => $fake->randomDigitNotNull,
            'status' => $fake->randomDigitNotNull,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $compositionFields);
    }
}
