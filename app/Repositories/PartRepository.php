<?php

namespace App\Repositories;

use App\Models\Part;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class PartRepository
 * @package App\Repositories
 * @version July 10, 2020, 5:24 pm WIB
 *
 * @method Part findWithoutFail($id, $columns = ['*'])
 * @method Part find($id, $columns = ['*'])
 * @method Part first($columns = ['*'])
*/
class PartRepository extends BaseRepository
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
        return Part::class;
    }
}
