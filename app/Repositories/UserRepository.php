<?php

namespace App\Repositories;

use App\User;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version June 17, 2020, 1:37 pm WIB
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
*/
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'email_verified_at',
        'is_admin'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
