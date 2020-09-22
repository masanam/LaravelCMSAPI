<?php

namespace App\Repositories;

use App\Models\Milestone;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class MilestoneRepository
 * @package App\Repositories
 * @version July 2, 2020, 10:59 am WIB
 *
 * @method Milestone findWithoutFail($id, $columns = ['*'])
 * @method Milestone find($id, $columns = ['*'])
 * @method Milestone first($columns = ['*'])
*/
class MilestoneRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'year',
        'slug',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Milestone::class;
    }
}
