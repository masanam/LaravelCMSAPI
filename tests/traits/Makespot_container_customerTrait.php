<?php

use Faker\Factory as Faker;
use App\Models\spot_container_customer;
use App\Repositories\spot_container_customerRepository;

trait Makespot_container_customerTrait
{
    /**
     * Create fake instance of spot_container_customer and save it in database
     *
     * @param array $spotContainerCustomerFields
     * @return spot_container_customer
     */
    public function makespot_container_customer($spotContainerCustomerFields = [])
    {
        /** @var spot_container_customerRepository $spotContainerCustomerRepo */
        $spotContainerCustomerRepo = App::make(spot_container_customerRepository::class);
        $theme = $this->fakespot_container_customerData($spotContainerCustomerFields);
        return $spotContainerCustomerRepo->create($theme);
    }

    /**
     * Get fake instance of spot_container_customer
     *
     * @param array $spotContainerCustomerFields
     * @return spot_container_customer
     */
    public function fakespot_container_customer($spotContainerCustomerFields = [])
    {
        return new spot_container_customer($this->fakespot_container_customerData($spotContainerCustomerFields));
    }

    /**
     * Get fake data of spot_container_customer
     *
     * @param array $postFields
     * @return array
     */
    public function fakespot_container_customerData($spotContainerCustomerFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'username' => $fake->word,
            'password' => $fake->word,
            'display_name' => $fake->word,
            'email' => $fake->word,
            'contact_email' => $fake->word,
            'vat_number' => $fake->word,
            'budget' => $fake->randomDigitNotNull,
            'street' => $fake->text,
            'country' => $fake->randomDigitNotNull,
            'city' => $fake->randomDigitNotNull,
            'postcode' => $fake->word,
            'number' => $fake->word,
            'box' => $fake->word,
            'language' => $fake->word,
            'clearance' => $fake->randomDigitNotNull,
            'payment_term' => $fake->randomDigitNotNull,
            'fiscal_representation' => $fake->randomDigitNotNull,
            'storage_fee' => $fake->randomDigitNotNull,
            'cost_24' => $fake->randomDigitNotNull,
            'cost_48' => $fake->randomDigitNotNull,
            'kg_price' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $spotContainerCustomerFields);
    }
}
