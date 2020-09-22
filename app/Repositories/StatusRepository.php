<?php

namespace App\Repositories;

use App\Models\Status;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class StatusRepository
 * @package App\Repositories
 * @version June 17, 2020, 2:20 pm WIB
 *
 * @method Status findWithoutFail($id, $columns = ['*'])
 * @method Status find($id, $columns = ['*'])
 * @method Status first($columns = ['*'])
*/
class StatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Status::class;
    }
}
