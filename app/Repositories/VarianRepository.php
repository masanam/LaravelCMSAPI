<?php

namespace App\Repositories;

use App\Models\Varian;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class VarianRepository
 * @package App\Repositories
 * @version July 3, 2020, 2:53 pm WIB
 *
 * @method Varian findWithoutFail($id, $columns = ['*'])
 * @method Varian find($id, $columns = ['*'])
 * @method Varian first($columns = ['*'])
*/
class VarianRepository extends BaseRepository
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
        return Varian::class;
    }
}
