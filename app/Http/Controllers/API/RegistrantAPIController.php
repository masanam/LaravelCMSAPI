<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRegistrantAPIRequest;
use App\Http\Requests\API\UpdateRegistrantAPIRequest;
use App\Models\Registrant;
use App\Repositories\RegistrantRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class RegistrantController
 * @package App\Http\Controllers\API
 */

class RegistrantAPIController extends AppBaseController
{
    /** @var  RegistrantRepository */
    private $registrantRepository;

    public function __construct(RegistrantRepository $registrantRepo)
    {
        $this->middleware('auth:api');
        $this->registrantRepository = $registrantRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/registrants",
     *      summary="Get a listing of the Registrants.",
     *      tags={"Registrant"},
     *      description="Get all Registrants",
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
     *                  @SWG\Items(ref="#/definitions/Registrant")
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
        $this->registrantRepository->pushCriteria(new RequestCriteria($request));
        $this->registrantRepository->pushCriteria(new LimitOffsetCriteria($request));
        $registrants = $this->registrantRepository->all();

        return $this->sendResponse($registrants->toArray(), 'Registrants retrieved successfully');
    }

    /**
     * @param CreateRegistrantAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/registrants",
     *      summary="Store a newly created Registrant in storage",
     *      tags={"Registrant"},
     *      description="Store Registrant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Registrant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Registrant")
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
     *                  ref="#/definitions/Registrant"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRegistrantAPIRequest $request)
    {
        $input = $request->all();

        $registrants = $this->registrantRepository->create($input);

        return $this->sendResponse($registrants->toArray(), 'Registrant saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/registrants/{id}",
     *      summary="Display the specified Registrant",
     *      tags={"Registrant"},
     *      description="Get Registrant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Registrant",
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
     *                  ref="#/definitions/Registrant"
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
        /** @var Registrant $registrant */
        $registrant = $this->registrantRepository->findWithoutFail($id);

        if (empty($registrant)) {
            return $this->sendError('Registrant not found');
        }

        return $this->sendResponse($registrant->toArray(), 'Registrant retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRegistrantAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/registrants/{id}",
     *      summary="Update the specified Registrant in storage",
     *      tags={"Registrant"},
     *      description="Update Registrant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Registrant",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Registrant that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Registrant")
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
     *                  ref="#/definitions/Registrant"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRegistrantAPIRequest $request)
    {
        $input = $request->all();

        /** @var Registrant $registrant */
        $registrant = $this->registrantRepository->findWithoutFail($id);

        if (empty($registrant)) {
            return $this->sendError('Registrant not found');
        }

        $registrant = $this->registrantRepository->update($input, $id);

        return $this->sendResponse($registrant->toArray(), 'Registrant updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/registrants/{id}",
     *      summary="Remove the specified Registrant from storage",
     *      tags={"Registrant"},
     *      description="Delete Registrant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Registrant",
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
        /** @var Registrant $registrant */
        $registrant = $this->registrantRepository->findWithoutFail($id);

        if (empty($registrant)) {
            return $this->sendError('Registrant not found');
        }

        $registrant->delete();

        return $this->sendResponse($id, 'Registrant deleted successfully');
    }
}
