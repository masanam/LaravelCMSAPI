<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateJenisAPIRequest;
use App\Http\Requests\API\UpdateJenisAPIRequest;
use App\Models\Jenis;
use App\Repositories\JenisRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class JenisController
 * @package App\Http\Controllers\API
 */

class JenisAPIController extends AppBaseController
{
    /** @var  JenisRepository */
    private $jenisRepository;

    public function __construct(JenisRepository $jenisRepo)
    {
        $this->middleware('auth:api');
        $this->jenisRepository = $jenisRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/jenis",
     *      summary="Get a listing of the Jenis.",
     *      tags={"Jenis"},
     *      description="Get all Jenis",
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
     *                  @SWG\Items(ref="#/definitions/Jenis")
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
        $this->jenisRepository->pushCriteria(new RequestCriteria($request));
        $this->jenisRepository->pushCriteria(new LimitOffsetCriteria($request));
        $jenis = $this->jenisRepository->all();

        return $this->sendResponse($jenis->toArray(), 'Jenis retrieved successfully');
    }

    /**
     * @param CreateJenisAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/jenis",
     *      summary="Store a newly created Jenis in storage",
     *      tags={"Jenis"},
     *      description="Store Jenis",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Jenis that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Jenis")
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
     *                  ref="#/definitions/Jenis"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateJenisAPIRequest $request)
    {
        $input = $request->all();

        $jenis = $this->jenisRepository->create($input);

        return $this->sendResponse($jenis->toArray(), 'Jenis saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/jenis/{id}",
     *      summary="Display the specified Jenis",
     *      tags={"Jenis"},
     *      description="Get Jenis",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Jenis",
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
     *                  ref="#/definitions/Jenis"
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
        /** @var Jenis $jenis */
        $jenis = $this->jenisRepository->findWithoutFail($id);

        if (empty($jenis)) {
            return $this->sendError('Jenis not found');
        }

        return $this->sendResponse($jenis->toArray(), 'Jenis retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateJenisAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/jenis/{id}",
     *      summary="Update the specified Jenis in storage",
     *      tags={"Jenis"},
     *      description="Update Jenis",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Jenis",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Jenis that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Jenis")
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
     *                  ref="#/definitions/Jenis"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateJenisAPIRequest $request)
    {
        $input = $request->all();

        /** @var Jenis $jenis */
        $jenis = $this->jenisRepository->findWithoutFail($id);

        if (empty($jenis)) {
            return $this->sendError('Jenis not found');
        }

        $jenis = $this->jenisRepository->update($input, $id);

        return $this->sendResponse($jenis->toArray(), 'Jenis updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/jenis/{id}",
     *      summary="Remove the specified Jenis from storage",
     *      tags={"Jenis"},
     *      description="Delete Jenis",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Jenis",
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
        /** @var Jenis $jenis */
        $jenis = $this->jenisRepository->findWithoutFail($id);

        if (empty($jenis)) {
            return $this->sendError('Jenis not found');
        }

        $jenis->delete();

        return $this->sendResponse($id, 'Jenis deleted successfully');
    }
}
