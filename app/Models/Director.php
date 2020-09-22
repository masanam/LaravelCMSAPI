<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Director",
 *      required={"picture"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="category_id",
 *          description="category_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="fullname",
 *          description="fullname",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="position",
 *          description="position",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="picture",
 *          description="picture",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="citizen",
 *          description="citizen",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="age",
 *          description="age",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="education",
 *          description="education",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="legal",
 *          description="legal",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="experience",
 *          description="experience",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="concurrent",
 *          description="concurrent",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="affiliate",
 *          description="affiliate",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_by",
 *          description="created_by",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="updated_by",
 *          description="updated_by",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Director extends Model
{
    use SoftDeletes;

    public $table = 'directors';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'category_id',
        'fullname',
        'position',
        'title',
        'picture',
        'citizen',
        'age',
        'education',
        'legal',
        'experience',
        'concurrent',
        'affiliate',
        'description',
        'noted',
        'citizen_en',
        'position_en',
        'age_en',
        'education_en',
        'legal_en',
        'experience_en',
        'concurrent_en',
        'affiliate_en',
        'description_en',
        'noted_en',
        'status',
        'created_by',
        'updated_by',
        'sortby'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'category_id' => 'integer',
        'fullname' => 'string',
        'position' => 'string',
        'title' => 'integer',
        'picture' => 'string',
        'citizen' => 'string',
        'age' => 'string',
        'education' => 'string',
        'legal' => 'string',
        'experience' => 'string',
        'concurrent' => 'string',
        'affiliate' => 'string',
        'description' => 'string',
        'noted' => 'string',
        'citizen_en' => 'string',
        'position_en' => 'string',
        'age_en' => 'string',
        'education_en' => 'string',
        'legal_en' => 'string',
        'experience_en' => 'string',
        'concurrent_en' => 'string',
        'affiliate_en' => 'string',
        'description_en' => 'string',
        'noted_en' => 'string',
        'status' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'sortby' => 'integer'

        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fullname' => 'required',
        'position' => 'required'

    ];

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function status()
    {
        return $this->belongsTo(\App\Models\Status::class, 'status', 'id');
    }

        /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function category()
    {
        return $this->belongsTo(\App\Models\Management::class, 'category_id', 'id');
    }

}
