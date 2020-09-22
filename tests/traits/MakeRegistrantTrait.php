<?php

use Faker\Factory as Faker;
use App\Models\Registrant;
use App\Repositories\RegistrantRepository;

trait MakeRegistrantTrait
{
    /**
     * Create fake instance of Registrant and save it in database
     *
     * @param array $registrantFields
     * @return Registrant
     */
    public function makeRegistrant($registrantFields = [])
    {
        /** @var RegistrantRepository $registrantRepo */
        $registrantRepo = App::make(RegistrantRepository::class);
        $theme = $this->fakeRegistrantData($registrantFields);
        return $registrantRepo->create($theme);
    }

    /**
     * Get fake instance of Registrant
     *
     * @param array $registrantFields
     * @return Registrant
     */
    public function fakeRegistrant($registrantFields = [])
    {
        return new Registrant($this->fakeRegistrantData($registrantFields));
    }

    /**
     * Get fake data of Registrant
     *
     * @param array $postFields
     * @return array
     */
    public function fakeRegistrantData($registrantFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'firstname' => $fake->word,
            'lastname' => $fake->word,
            'email' => $fake->word,
            'phone' => $fake->word,
            'address' => $fake->text,
            'position' => $fake->word,
            'resume' => $fake->word,
            'status' => $fake->randomDigitNotNull,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $registrantFields);
    }
}
