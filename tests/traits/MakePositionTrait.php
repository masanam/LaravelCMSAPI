<?php

use Faker\Factory as Faker;
use App\Models\Position;
use App\Repositories\PositionRepository;

trait MakePositionTrait
{
    /**
     * Create fake instance of Position and save it in database
     *
     * @param array $positionFields
     * @return Position
     */
    public function makePosition($positionFields = [])
    {
        /** @var PositionRepository $positionRepo */
        $positionRepo = App::make(PositionRepository::class);
        $theme = $this->fakePositionData($positionFields);
        return $positionRepo->create($theme);
    }

    /**
     * Get fake instance of Position
     *
     * @param array $positionFields
     * @return Position
     */
    public function fakePosition($positionFields = [])
    {
        return new Position($this->fakePositionData($positionFields));
    }

    /**
     * Get fake data of Position
     *
     * @param array $postFields
     * @return array
     */
    public function fakePositionData($positionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->text,
            'position' => $fake->text,
            'quantity' => $fake->randomDigitNotNull,
            'persentase' => $fake->randomDigitNotNull,
            'status' => $fake->randomDigitNotNull,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $positionFields);
    }
}
