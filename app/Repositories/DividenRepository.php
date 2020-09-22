<?php

namespace App\Repositories;

use App\Models\Dividen;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class DividenRepository
 * @package App\Repositories
 * @version June 23, 2020, 1:44 pm WIB
 *
 * @method Dividen findWithoutFail($id, $columns = ['*'])
 * @method Dividen find($id, $columns = ['*'])
 * @method Dividen first($columns = ['*'])
*/
class DividenRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'year',
        'total',
        'share',
        'payment_date',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Dividen::class;
    }
}
