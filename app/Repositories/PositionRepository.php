<?php

namespace App\Repositories;

use App\Models\Position;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class PositionRepository
 * @package App\Repositories
 * @version July 21, 2020, 4:28 pm WIB
 *
 * @method Position findWithoutFail($id, $columns = ['*'])
 * @method Position find($id, $columns = ['*'])
 * @method Position first($columns = ['*'])
*/
class PositionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'position',
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
        return Position::class;
    }
}
