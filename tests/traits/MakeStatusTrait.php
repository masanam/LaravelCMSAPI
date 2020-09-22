<?php

use Faker\Factory as Faker;
use App\Models\Status;
use App\Repositories\StatusRepository;

trait MakeStatusTrait
{
    /**
     * Create fake instance of Status and save it in database
     *
     * @param array $statusFields
     * @return Status
     */
    public function makeStatus($statusFields = [])
    {
        /** @var StatusRepository $statusRepo */
        $statusRepo = App::make(StatusRepository::class);
        $theme = $this->fakeStatusData($statusFields);
        return $statusRepo->create($theme);
    }

    /**
     * Get fake instance of Status
     *
     * @param array $statusFields
     * @return Status
     */
    public function fakeStatus($statusFields = [])
    {
        return new Status($this->fakeStatusData($statusFields));
    }

    /**
     * Get fake data of Status
     *
     * @param array $postFields
     * @return array
     */
    public function fakeStatusData($statusFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'description' => $fake->text,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $statusFields);
    }
}
