<?php

use Faker\Factory as Faker;
use App\Models\Users;
use App\Repositories\UsersRepository;

trait MakeUsersTrait
{
    /**
     * Create fake instance of Users and save it in database
     *
     * @param array $usersFields
     * @return Users
     */
    public function makeUsers($usersFields = [])
    {
        /** @var UsersRepository $usersRepo */
        $usersRepo = App::make(UsersRepository::class);
        $theme = $this->fakeUsersData($usersFields);
        return $usersRepo->create($theme);
    }

    /**
     * Get fake instance of Users
     *
     * @param array $usersFields
     * @return Users
     */
    public function fakeUsers($usersFields = [])
    {
        return new Users($this->fakeUsersData($usersFields));
    }

    /**
     * Get fake data of Users
     *
     * @param array $postFields
     * @return array
     */
    public function fakeUsersData($usersFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'email' => $fake->word,
            'password' => $fake->word,
            'activation_code' => $fake->word,
            'persist_code' => $fake->word,
            'reset_password_code' => $fake->word,
            'permissions' => $fake->text,
            'is_activated' => $fake->word,
            'activated_at' => $fake->date('Y-m-d H:i:s'),
            'last_login' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'username' => $fake->word,
            'surname' => $fake->word,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'last_seen' => $fake->date('Y-m-d H:i:s'),
            'is_guest' => $fake->word,
            'is_superuser' => $fake->word,
            'phone' => $fake->word,
            'company' => $fake->word,
            'street_addr' => $fake->word,
            'city' => $fake->word,
            'zip' => $fake->word,
            'state_id' => $fake->randomDigitNotNull,
            'country_id' => $fake->randomDigitNotNull,
            'mobile' => $fake->word,
            'role_id' => $fake->randomDigitNotNull,
            'city_id' => $fake->randomDigitNotNull,
            'area_id' => $fake->randomDigitNotNull,
            'manager' => $fake->text,
            'places' => $fake->text,
            'gender' => $fake->word,
            'driver' => $fake->word,
            'office' => $fake->word,
            'language' => $fake->word,
            'devicetoken' => $fake->word,
            'vat_number' => $fake->word,
            'budget' => $fake->randomDigitNotNull,
            'box' => $fake->randomDigitNotNull,
            'lang_id' => $fake->randomDigitNotNull,
            'custom_clearance' => $fake->randomDigitNotNull,
            'fiscal_representation' => $fake->randomDigitNotNull,
            'payment_term' => $fake->randomDigitNotNull,
            'price_kg' => $fake->randomDigitNotNull,
            'storage_fee' => $fake->word,
            'cost_24' => $fake->randomDigitNotNull,
            'cost_48' => $fake->randomDigitNotNull
        ], $usersFields);
    }
}
