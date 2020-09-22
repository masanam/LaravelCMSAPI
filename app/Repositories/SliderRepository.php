<?php

namespace App\Repositories;

use App\Models\Slider;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class SliderRepository
 * @package App\Repositories
 * @version June 26, 2020, 10:03 am WIB
 *
 * @method Slider findWithoutFail($id, $columns = ['*'])
 * @method Slider find($id, $columns = ['*'])
 * @method Slider first($columns = ['*'])
*/
class SliderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Slider::class;
    }
}
