<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatefoodAPIRequest;
use App\Http\Requests\API\UpdatefoodAPIRequest;
use App\Models\food;
use App\Repositories\foodRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class foodController
 * @package App\Http\Controllers\API
 */

class foodAPIController extends AppBaseController
{
    /** @var  foodRepository */
    private $foodRepository;

    public function __construct(foodRepository $foodRepo)
    {
        $this->foodRepository = $foodRepo;
    }

    /**
     * Display a listing of the food.
     * GET|HEAD /foods
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $foods = $this->foodRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($foods->toArray(), 'Foods retrieved successfully');
    }

    /**
     * Store a newly created food in storage.
     * POST /foods
     *
     * @param CreatefoodAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatefoodAPIRequest $request)
    {
        $input = $request->all();

        $food = $this->foodRepository->create($input);

        return $this->sendResponse($food->toArray(), 'Food saved successfully');
    }

    /**
     * Display the specified food.
     * GET|HEAD /foods/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var food $food */
        $food = $this->foodRepository->find($id);

        if (empty($food)) {
            return $this->sendError('Food not found');
        }

        return $this->sendResponse($food->toArray(), 'Food retrieved successfully');
    }

    /**
     * Update the specified food in storage.
     * PUT/PATCH /foods/{id}
     *
     * @param int $id
     * @param UpdatefoodAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatefoodAPIRequest $request)
    {
        $input = $request->all();

        /** @var food $food */
        $food = $this->foodRepository->find($id);

        if (empty($food)) {
            return $this->sendError('Food not found');
        }

        $food = $this->foodRepository->update($input, $id);

        return $this->sendResponse($food->toArray(), 'food updated successfully');
    }

    /**
     * Remove the specified food from storage.
     * DELETE /foods/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var food $food */
        $food = $this->foodRepository->find($id);

        if (empty($food)) {
            return $this->sendError('Food not found');
        }

        $food->delete();

        return $this->sendResponse($id, 'Food deleted successfully');
    }
}
