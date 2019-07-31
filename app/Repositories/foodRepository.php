<?php

namespace App\Repositories;

use App\Models\food;
use App\Repositories\BaseRepository;

/**
 * Class foodRepository
 * @package App\Repositories
 * @version July 6, 2019, 12:23 pm UTC
*/

class foodRepository extends BaseRepository
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
        return food::class;
    }
}
