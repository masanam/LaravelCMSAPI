<?php

namespace App\Repositories;

use App\Models\Users;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class UsersRepository
 * @package App\Repositories
 * @version February 23, 2021, 11:28 pm WIB
 *
 * @method Users findWithoutFail($id, $columns = ['*'])
 * @method Users find($id, $columns = ['*'])
 * @method Users first($columns = ['*'])
*/
class UsersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password',
        'activation_code',
        'persist_code',
        'reset_password_code',
        'permissions',
        'is_activated',
        'activated_at',
        'last_login',
        'username',
        'surname',
        'last_seen',
        'is_guest',
        'is_superuser',
        'phone',
        'company',
        'street_addr',
        'city',
        'zip',
        'state_id',
        'country_id',
        'mobile',
        'role_id',
        'city_id',
        'area_id',
        'manager',
        'places',
        'gender',
        'driver',
        'office',
        'language',
        'devicetoken',
        'vat_number',
        'budget',
        'box',
        'lang_id',
        'custom_clearance',
        'fiscal_representation',
        'payment_term',
        'price_kg',
        'storage_fee',
        'cost_24',
        'cost_48'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Users::class;
    }
}
