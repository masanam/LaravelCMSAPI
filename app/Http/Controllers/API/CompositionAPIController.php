<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCompositionAPIRequest;
use App\Http\Requests\API\UpdateCompositionAPIRequest;
use App\Models\Composition;
use App\Repositories\CompositionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CompositionController
 * @package App\Http\Controllers\API
 */

class CompositionAPIController extends AppBaseController
{
    /** @var  CompositionRepository */
    private $compositionRepository;

    public function __construct(CompositionRepository $compositionRepo)
    {
        $this->middleware('auth:api');
        $this->compositionRepository = $compositionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/compositions",
     *      summary="Get a listing of the Compositions.",
     *      tags={"Composition"},
     *      description="Get all Compositions",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Composition")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->compositionRepository->pushCriteria(new RequestCriteria($request));
        $this->compositionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $compositions = $this->compositionRepository->all();

        return $this->sendResponse($compositions->toArray(), 'Compositions retrieved successfully');
    }

    /**
     * @param CreateCompositionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/compositions",
     *      summary="Store a newly created Composition in storage",
     *      tags={"Composition"},
     *      description="Store Composition",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Composition that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Composition")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Composition"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCompositionAPIRequest $request)
    {
        $input = $request->all();

        $compositions = $this->compositionRepository->create($input);

        return $this->sendResponse($compositions->toArray(), 'Composition saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/compositions/{id}",
     *      summary="Display the specified Composition",
     *      tags={"Composition"},
     *      description="Get Composition",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Composition",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Composition"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Composition $composition */
        $composition = $this->compositionRepository->findWithoutFail($id);

        if (empty($composition)) {
            return $this->sendError('Composition not found');
        }

        return $this->sendResponse($composition->toArray(), 'Composition retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCompositionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/compositions/{id}",
     *      summary="Update the specified Composition in storage",
     *      tags={"Composition"},
     *      description="Update Composition",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Composition",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Composition that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Composition")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Composition"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCompositionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Composition $composition */
        $composition = $this->compositionRepository->findWithoutFail($id);

        if (empty($composition)) {
            return $this->sendError('Composition not found');
        }

        $composition = $this->compositionRepository->update($input, $id);

        return $this->sendResponse($composition->toArray(), 'Composition updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/compositions/{id}",
     *      summary="Remove the specified Composition from storage",
     *      tags={"Composition"},
     *      description="Delete Composition",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Composition",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Composition $composition */
        $composition = $this->compositionRepository->findWithoutFail($id);

        if (empty($composition)) {
            return $this->sendError('Composition not found');
        }

        $composition->delete();

        return $this->sendResponse($id, 'Composition deleted successfully');
    }
}
