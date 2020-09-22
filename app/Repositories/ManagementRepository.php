<?php

namespace App\Repositories;

use App\Models\Management;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class ManagementRepository
 * @package App\Repositories
 * @version June 17, 2020, 2:31 pm WIB
 *
 * @method Management findWithoutFail($id, $columns = ['*'])
 * @method Management find($id, $columns = ['*'])
 * @method Management first($columns = ['*'])
*/
class ManagementRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'picture',
        'tipe',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Management::class;
    }
}
