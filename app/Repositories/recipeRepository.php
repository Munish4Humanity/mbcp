<?php

namespace App\Repositories;

use App\Models\recipe;
use App\Repositories\BaseRepository;

/**
 * Class recipeRepository
 * @package App\Repositories
 * @version July 6, 2019, 12:21 pm UTC
*/

class recipeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'desc'
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
        return recipe::class;
    }
}
