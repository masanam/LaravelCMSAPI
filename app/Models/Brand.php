<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Brand",
 *      required={"category_id", "picture"},
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
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="seotitle",
 *          description="seotitle",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="content",
 *          description="content",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="picture",
 *          description="picture",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="picture_description",
 *          description="picture_description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="tag",
 *          description="tag",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="headline",
 *          description="headline",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="hits",
 *          description="hits",
 *          type="integer",
 *          format="int32"
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
class Brand extends Model
{
    use SoftDeletes;

    public $table = 'brands';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'category_id',
        'title',
        'seotitle',
        'summary',
        'content',
        'tagline',
        'title_en',
        'content_en',
        'tagline_en',
        'picture',
        'facebook',
        'instagram',
        'youtube',
        'orderid',
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'category_id' => 'integer',
        'title' => 'string',
        'seotitle' => 'string',
        'summary' => 'string',
        'content' => 'string',
        'tagline' => 'string',
        'title_en' => 'string',
        'content_en' => 'string',
        'tagline_en' => 'string',
        'picture' => 'string',
        'facebook' => 'string',
        'instagram' => 'string',
        'youtube' => 'string',
        'orderid' => 'integer',
        'picture_description' => 'string',
        'tag' => 'string',
        'active' => 'string',
        'headline' => 'integer',
        'hits' => 'integer',
        'status' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'category_id' => 'required',
        'title' => 'required',
        'picture' => 'required'
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
    public function type()
    {
        return $this->belongsTo(\App\Models\Type::class, 'category_id', 'id');
    }

    protected $with = ['product'];

    public function product() {
        return $this->hasMany(\App\Models\Product::class, 'brand_id')->orderBy('orderid');

     }

}
