<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\CourseFile;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\Eloquent\Builder;

class CourseFileRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $exactFilters = [];

    /**
     * @var array
     */
    protected $allowedIncludes = [];

    /**
     * @var array
     */
    protected $allowedFilters = [];

    /**
        * OrderRepository constructor.
        *
        * @param Order $model
        */
    public function __construct(CourseFile $model)
    {
            parent::__construct($model);
    }
}