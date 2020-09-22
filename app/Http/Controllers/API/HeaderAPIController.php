<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHeaderAPIRequest;
use App\Http\Requests\API\UpdateHeaderAPIRequest;
use App\Models\Header;
use App\Repositories\HeaderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class HeaderController
 * @package App\Http\Controllers\API
 */

class HeaderAPIController extends AppBaseController
{
    /** @var  HeaderRepository */
    private $headerRepository;

    public function __construct(HeaderRepository $headerRepo)
    {
        $this->middleware('auth:api');
        $this->headerRepository = $headerRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/headers",
     *      summary="Get a listing of the Headers.",
     *      tags={"Header"},
     *      description="Get all Headers",
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
     *                  @SWG\Items(ref="#/definitions/Header")
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
        $this->headerRepository->pushCriteria(new RequestCriteria($request));
        $this->headerRepository->pushCriteria(new LimitOffsetCriteria($request));
        $headers = $this->headerRepository->all();

        return $this->sendResponse($headers->toArray(), 'Headers retrieved successfully');
    }

    /**
     * @param CreateHeaderAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/headers",
     *      summary="Store a newly created Header in storage",
     *      tags={"Header"},
     *      description="Store Header",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Header that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Header")
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
     *                  ref="#/definitions/Header"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateHeaderAPIRequest $request)
    {
        $input = $request->all();

        $headers = $this->headerRepository->create($input);

        return $this->sendResponse($headers->toArray(), 'Header saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/headers/{id}",
     *      summary="Display the specified Header",
     *      tags={"Header"},
     *      description="Get Header",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Header",
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
     *                  ref="#/definitions/Header"
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
        /** @var Header $header */
        $header = $this->headerRepository->findWithoutFail($id);

        if (empty($header)) {
            return $this->sendError('Header not found');
        }

        return $this->sendResponse($header->toArray(), 'Header retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateHeaderAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/headers/{id}",
     *      summary="Update the specified Header in storage",
     *      tags={"Header"},
     *      description="Update Header",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Header",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Header that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Header")
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
     *                  ref="#/definitions/Header"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateHeaderAPIRequest $request)
    {
        $input = $request->all();

        /** @var Header $header */
        $header = $this->headerRepository->findWithoutFail($id);

        if (empty($header)) {
            return $this->sendError('Header not found');
        }

        $header = $this->headerRepository->update($input, $id);

        return $this->sendResponse($header->toArray(), 'Header updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/headers/{id}",
     *      summary="Remove the specified Header from storage",
     *      tags={"Header"},
     *      description="Delete Header",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Header",
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
        /** @var Header $header */
        $header = $this->headerRepository->findWithoutFail($id);

        if (empty($header)) {
            return $this->sendError('Header not found');
        }

        $header->delete();

        return $this->sendResponse($id, 'Header deleted successfully');
    }
}
