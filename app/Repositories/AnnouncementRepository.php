<?php

namespace App\Repositories;

use App\Models\Announcement;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class AnnouncementRepository
 * @package App\Repositories
 * @version June 17, 2020, 3:06 pm WIB
 *
 * @method Announcement findWithoutFail($id, $columns = ['*'])
 * @method Announcement find($id, $columns = ['*'])
 * @method Announcement first($columns = ['*'])
*/
class AnnouncementRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'title',
        'seotitle',
        'picture_description',
        'tag',
        'active',
        'headline',
        'hits',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Announcement::class;
    }
}
