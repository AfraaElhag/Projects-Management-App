<?php

namespace App\Repositories;

use App\Models\ProjectStatus;
use App\Repositories\BaseRepository;

/**
 * Class ProjectStatusRepository
 * @package App\Repositories
 * @version February 26, 2022, 4:03 pm UTC
*/

class ProjectStatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'milestone',
        'status'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectStatus::class;
    }
}
