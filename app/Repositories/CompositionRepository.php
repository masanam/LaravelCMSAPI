<?php

namespace App\Repositories;

use App\Models\Composition;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class CompositionRepository
 * @package App\Repositories
 * @version July 21, 2020, 4:30 pm WIB
 *
 * @method Composition findWithoutFail($id, $columns = ['*'])
 * @method Composition find($id, $columns = ['*'])
 * @method Composition first($columns = ['*'])
*/
class CompositionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'jumlah',
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
        return Composition::class;
    }
}
