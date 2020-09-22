<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDividenAPIRequest;
use App\Http\Requests\API\UpdateDividenAPIRequest;
use App\Models\Dividen;
use App\Repositories\DividenRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DividenController
 * @package App\Http\Controllers\API
 */

class DividenAPIController extends AppBaseController
{
    /** @var  DividenRepository */
    private $dividenRepository;

    public function __construct(DividenRepository $dividenRepo)
    {
        $this->middleware('auth:api');
        $this->dividenRepository = $dividenRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/dividens",
     *      summary="Get a listing of the Dividens.",
     *      tags={"Dividen"},
     *      description="Get all Dividens",
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
     *                  @SWG\Items(ref="#/definitions/Dividen")
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
        $this->dividenRepository->pushCriteria(new RequestCriteria($request));
        $this->dividenRepository->pushCriteria(new LimitOffsetCriteria($request));
        $dividens = $this->dividenRepository->all();

        return $this->sendResponse($dividens->toArray(), 'Dividens retrieved successfully');
    }

    /**
     * @param CreateDividenAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/dividens",
     *      summary="Store a newly created Dividen in storage",
     *      tags={"Dividen"},
     *      description="Store Dividen",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Dividen that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Dividen")
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
     *                  ref="#/definitions/Dividen"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateDividenAPIRequest $request)
    {
        $input = $request->all();

        $dividens = $this->dividenRepository->create($input);

        return $this->sendResponse($dividens->toArray(), 'Dividen saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/dividens/{id}",
     *      summary="Display the specified Dividen",
     *      tags={"Dividen"},
     *      description="Get Dividen",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Dividen",
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
     *                  ref="#/definitions/Dividen"
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
        /** @var Dividen $dividen */
        $dividen = $this->dividenRepository->findWithoutFail($id);

        if (empty($dividen)) {
            return $this->sendError('Dividen not found');
        }

        return $this->sendResponse($dividen->toArray(), 'Dividen retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateDividenAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/dividens/{id}",
     *      summary="Update the specified Dividen in storage",
     *      tags={"Dividen"},
     *      description="Update Dividen",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Dividen",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Dividen that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Dividen")
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
     *                  ref="#/definitions/Dividen"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateDividenAPIRequest $request)
    {
        $input = $request->all();

        /** @var Dividen $dividen */
        $dividen = $this->dividenRepository->findWithoutFail($id);

        if (empty($dividen)) {
            return $this->sendError('Dividen not found');
        }

        $dividen = $this->dividenRepository->update($input, $id);

        return $this->sendResponse($dividen->toArray(), 'Dividen updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/dividens/{id}",
     *      summary="Remove the specified Dividen from storage",
     *      tags={"Dividen"},
     *      description="Delete Dividen",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Dividen",
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
        /** @var Dividen $dividen */
        $dividen = $this->dividenRepository->findWithoutFail($id);

        if (empty($dividen)) {
            return $this->sendError('Dividen not found');
        }

        $dividen->delete();

        return $this->sendResponse($id, 'Dividen deleted successfully');
    }
}
