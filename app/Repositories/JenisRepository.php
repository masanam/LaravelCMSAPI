<?php

namespace App\Repositories;

use App\Models\Jenis;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class JenisRepository
 * @package App\Repositories
 * @version June 22, 2020, 5:38 pm WIB
 *
 * @method Jenis findWithoutFail($id, $columns = ['*'])
 * @method Jenis find($id, $columns = ['*'])
 * @method Jenis first($columns = ['*'])
*/
class JenisRepository extends BaseRepository
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
        return Jenis::class;
    }
}
