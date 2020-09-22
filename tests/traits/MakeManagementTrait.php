<?php

use Faker\Factory as Faker;
use App\Models\Management;
use App\Repositories\ManagementRepository;

trait MakeManagementTrait
{
    /**
     * Create fake instance of Management and save it in database
     *
     * @param array $managementFields
     * @return Management
     */
    public function makeManagement($managementFields = [])
    {
        /** @var ManagementRepository $managementRepo */
        $managementRepo = App::make(ManagementRepository::class);
        $theme = $this->fakeManagementData($managementFields);
        return $managementRepo->create($theme);
    }

    /**
     * Get fake instance of Management
     *
     * @param array $managementFields
     * @return Management
     */
    public function fakeManagement($managementFields = [])
    {
        return new Management($this->fakeManagementData($managementFields));
    }

    /**
     * Get fake data of Management
     *
     * @param array $postFields
     * @return array
     */
    public function fakeManagementData($managementFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'picture' => $fake->word,
            'tipe' => $fake->randomDigitNotNull,
            'description' => $fake->text,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $managementFields);
    }
}
