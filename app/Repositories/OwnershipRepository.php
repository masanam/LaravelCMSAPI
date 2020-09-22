<?php

namespace App\Repositories;

use App\Models\Ownership;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class OwnershipRepository
 * @package App\Repositories
 * @version July 21, 2020, 4:25 pm WIB
 *
 * @method Ownership findWithoutFail($id, $columns = ['*'])
 * @method Ownership find($id, $columns = ['*'])
 * @method Ownership first($columns = ['*'])
*/
class OwnershipRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'quantity',
        'persentase',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Ownership::class;
    }
}
