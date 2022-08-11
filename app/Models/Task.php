<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Task",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
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
 *      ),
 *      @SWG\Property(
 *          property="task",
 *          description="task",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="milestone_number",
 *          description="milestone_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="responsible",
 *          description="responsible",
 *          type="string"
 *      )
 * )
 */
class Task extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'tasks';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'task',
        'milestone_number',
        'responsible',
        'client_viewable'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'milestone_number' => 'integer',
        'responsible' => 'string',
        'client_viewable' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'task' => 'required|string',
        'responsible' => 'required|string',
        'milestone_number' => 'required|integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function projects()
    {
        return $this->belongsToMany(\App\Models\Project::class);
    }
}
