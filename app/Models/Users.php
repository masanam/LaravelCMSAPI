<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Users",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="password",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="activation_code",
 *          description="activation_code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="persist_code",
 *          description="persist_code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="reset_password_code",
 *          description="reset_password_code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="permissions",
 *          description="permissions",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="is_activated",
 *          description="is_activated",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="username",
 *          description="username",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="surname",
 *          description="surname",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="is_guest",
 *          description="is_guest",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="is_superuser",
 *          description="is_superuser",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="phone",
 *          description="phone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="company",
 *          description="company",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="street_addr",
 *          description="street_addr",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="city",
 *          description="city",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="zip",
 *          description="zip",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="state_id",
 *          description="state_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="country_id",
 *          description="country_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="mobile",
 *          description="mobile",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="role_id",
 *          description="role_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="city_id",
 *          description="city_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="area_id",
 *          description="area_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="manager",
 *          description="manager",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="places",
 *          description="places",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="gender",
 *          description="gender",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="driver",
 *          description="driver",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="office",
 *          description="office",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="language",
 *          description="language",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="devicetoken",
 *          description="devicetoken",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="vat_number",
 *          description="vat_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="budget",
 *          description="budget",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="box",
 *          description="box",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="lang_id",
 *          description="lang_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="custom_clearance",
 *          description="custom_clearance",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="fiscal_representation",
 *          description="fiscal_representation",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="payment_term",
 *          description="payment_term",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="price_kg",
 *          description="price_kg",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="storage_fee",
 *          description="storage_fee",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="cost_24",
 *          description="cost_24",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="cost_48",
 *          description="cost_48",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Users extends Model
{
    use SoftDeletes;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'activation_code' => 'string',
        'persist_code' => 'string',
        'reset_password_code' => 'string',
        'permissions' => 'string',
        'is_activated' => 'boolean',
        'username' => 'string',
        'surname' => 'string',
        'is_guest' => 'boolean',
        'is_superuser' => 'boolean',
        'phone' => 'string',
        'company' => 'string',
        'street_addr' => 'string',
        'city' => 'string',
        'zip' => 'string',
        'state_id' => 'integer',
        'country_id' => 'integer',
        'mobile' => 'string',
        'role_id' => 'integer',
        'city_id' => 'integer',
        'area_id' => 'integer',
        'manager' => 'string',
        'places' => 'string',
        'gender' => 'string',
        'driver' => 'string',
        'office' => 'string',
        'language' => 'string',
        'devicetoken' => 'string',
        'vat_number' => 'string',
        'budget' => 'integer',
        'box' => 'integer',
        'lang_id' => 'integer',
        'custom_clearance' => 'integer',
        'fiscal_representation' => 'integer',
        'payment_term' => 'integer',
        'price_kg' => 'integer',
        'storage_fee' => 'boolean',
        'cost_24' => 'integer',
        'cost_48' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    
}
