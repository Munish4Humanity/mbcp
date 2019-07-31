<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreaterecipeAPIRequest;
use App\Http\Requests\API\UpdaterecipeAPIRequest;
use App\Models\recipe;
use App\Repositories\recipeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class recipeController
 * @package App\Http\Controllers\API
 */

class recipeAPIController extends AppBaseController
{
    /** @var  recipeRepository */
    private $recipeRepository;

    public function __construct(recipeRepository $recipeRepo)
    {
        $this->recipeRepository = $recipeRepo;
    }

    /**
     * Display a listing of the recipe.
     * GET|HEAD /recipes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $recipes = $this->recipeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($recipes->toArray(), 'Recipes retrieved successfully');
    }

    /**
     * Store a newly created recipe in storage.
     * POST /recipes
     *
     * @param CreaterecipeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreaterecipeAPIRequest $request)
    {
        $input = $request->all();

        $recipe = $this->recipeRepository->create($input);

        return $this->sendResponse($recipe->toArray(), 'Recipe saved successfully');
    }

    /**
     * Display the specified recipe.
     * GET|HEAD /recipes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var recipe $recipe */
        $recipe = $this->recipeRepository->find($id);

        if (empty($recipe)) {
            return $this->sendError('Recipe not found');
        }

        return $this->sendResponse($recipe->toArray(), 'Recipe retrieved successfully');
    }

    /**
     * Update the specified recipe in storage.
     * PUT/PATCH /recipes/{id}
     *
     * @param int $id
     * @param UpdaterecipeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdaterecipeAPIRequest $request)
    {
        $input = $request->all();

        /** @var recipe $recipe */
        $recipe = $this->recipeRepository->find($id);

        if (empty($recipe)) {
            return $this->sendError('Recipe not found');
        }

        $recipe = $this->recipeRepository->update($input, $id);

        return $this->sendResponse($recipe->toArray(), 'recipe updated successfully');
    }

    /**
     * Remove the specified recipe from storage.
     * DELETE /recipes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var recipe $recipe */
        $recipe = $this->recipeRepository->find($id);

        if (empty($recipe)) {
            return $this->sendError('Recipe not found');
        }

        $recipe->delete();

        return $this->sendResponse($id, 'Recipe deleted successfully');
    }
}
