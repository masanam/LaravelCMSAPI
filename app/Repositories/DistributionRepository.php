<?php

namespace App\Repositories;

use App\Models\Distribution;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class DistributionRepository
 * @package App\Repositories
 * @version July 30, 2020, 10:07 am WIB
 *
 * @method Distribution findWithoutFail($id, $columns = ['*'])
 * @method Distribution find($id, $columns = ['*'])
 * @method Distribution first($columns = ['*'])
*/
class DistributionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'longitude',
        'latitude',
        'type',
        'color',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Distribution::class;
    }
}
