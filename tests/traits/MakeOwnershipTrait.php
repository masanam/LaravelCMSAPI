<?php

use Faker\Factory as Faker;
use App\Models\Ownership;
use App\Repositories\OwnershipRepository;

trait MakeOwnershipTrait
{
    /**
     * Create fake instance of Ownership and save it in database
     *
     * @param array $ownershipFields
     * @return Ownership
     */
    public function makeOwnership($ownershipFields = [])
    {
        /** @var OwnershipRepository $ownershipRepo */
        $ownershipRepo = App::make(OwnershipRepository::class);
        $theme = $this->fakeOwnershipData($ownershipFields);
        return $ownershipRepo->create($theme);
    }

    /**
     * Get fake instance of Ownership
     *
     * @param array $ownershipFields
     * @return Ownership
     */
    public function fakeOwnership($ownershipFields = [])
    {
        return new Ownership($this->fakeOwnershipData($ownershipFields));
    }

    /**
     * Get fake data of Ownership
     *
     * @param array $postFields
     * @return array
     */
    public function fakeOwnershipData($ownershipFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->text,
            'quantity' => $fake->randomDigitNotNull,
            'persentase' => $fake->randomDigitNotNull,
            'status' => $fake->randomDigitNotNull,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $ownershipFields);
    }
}
