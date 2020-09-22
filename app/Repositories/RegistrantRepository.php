<?php

namespace App\Repositories;

use App\Models\Registrant;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class RegistrantRepository
 * @package App\Repositories
 * @version June 25, 2020, 10:31 am WIB
 *
 * @method Registrant findWithoutFail($id, $columns = ['*'])
 * @method Registrant find($id, $columns = ['*'])
 * @method Registrant first($columns = ['*'])
*/
class RegistrantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fullName',
        'email',
        'phone',
        'positionId',
        'resume',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Registrant::class;
    }
}
