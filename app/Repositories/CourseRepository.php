<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Course;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\Eloquent\Builder;

class CourseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $exactFilters = [
    ];

    /**
     * @var array
     */
    protected $allowedIncludes = [
        'subCategory.category',
        'ratings.user',
        'sections.enrollments', 
        'user',
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [];

    /**
        * OrderRepository constructor.
        *
        * @param Order $model
        */
    public function __construct(Course $model)
    {
        parent::__construct($model);
        //$this->allowedFilters[] = AllowedFilter::exact('language');
        $this->allowedFilters[] = AllowedFilter::scope('price_less_than');
        $this->allowedFilters[] = AllowedFilter::scope('in_category');
        $this->allowedFilters[] = AllowedFilter::scope('section_count');
    }

    /**
     * Override new query
     *
     * @return Builder
     */
    public function newQuery(): Builder
    {
        return parent::newQuery()->withCount('sections');
    }
}