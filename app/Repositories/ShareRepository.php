<?php

namespace App\Repositories;

use App\Models\Share;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class ShareRepository
 * @package App\Repositories
 * @version July 9, 2020, 2:01 pm WIB
 *
 * @method Share findWithoutFail($id, $columns = ['*'])
 * @method Share find($id, $columns = ['*'])
 * @method Share first($columns = ['*'])
*/
class ShareRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tanggal',
        'price',
        'share',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Share::class;
    }
}
