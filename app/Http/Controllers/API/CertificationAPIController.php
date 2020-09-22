<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCertificationAPIRequest;
use App\Http\Requests\API\UpdateCertificationAPIRequest;
use App\Models\Certification;
use App\Repositories\CertificationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CertificationController
 * @package App\Http\Controllers\API
 */

class CertificationAPIController extends AppBaseController
{
    /** @var  CertificationRepository */
    private $certificationRepository;

    public function __construct(CertificationRepository $certificationRepo)
    {
        $this->middleware('auth:api');
        $this->certificationRepository = $certificationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/certifications",
     *      summary="Get a listing of the Certifications.",
     *      tags={"Certification"},
     *      description="Get all Certifications",
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
     *                  @SWG\Items(ref="#/definitions/Certification")
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
        $this->certificationRepository->pushCriteria(new RequestCriteria($request));
        $this->certificationRepository->pushCriteria(new LimitOffsetCriteria($request));
        $certifications = $this->certificationRepository->all();

        return $this->sendResponse($certifications->toArray(), 'Certifications retrieved successfully');
    }

    /**
     * @param CreateCertificationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/certifications",
     *      summary="Store a newly created Certification in storage",
     *      tags={"Certification"},
     *      description="Store Certification",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Certification that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Certification")
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
     *                  ref="#/definitions/Certification"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCertificationAPIRequest $request)
    {
        $input = $request->all();

        $certifications = $this->certificationRepository->create($input);

        return $this->sendResponse($certifications->toArray(), 'Certification saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/certifications/{id}",
     *      summary="Display the specified Certification",
     *      tags={"Certification"},
     *      description="Get Certification",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Certification",
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
     *                  ref="#/definitions/Certification"
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
        /** @var Certification $certification */
        $certification = $this->certificationRepository->findWithoutFail($id);

        if (empty($certification)) {
            return $this->sendError('Certification not found');
        }

        return $this->sendResponse($certification->toArray(), 'Certification retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCertificationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/certifications/{id}",
     *      summary="Update the specified Certification in storage",
     *      tags={"Certification"},
     *      description="Update Certification",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Certification",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Certification that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Certification")
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
     *                  ref="#/definitions/Certification"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCertificationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Certification $certification */
        $certification = $this->certificationRepository->findWithoutFail($id);

        if (empty($certification)) {
            return $this->sendError('Certification not found');
        }

        $certification = $this->certificationRepository->update($input, $id);

        return $this->sendResponse($certification->toArray(), 'Certification updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/certifications/{id}",
     *      summary="Remove the specified Certification from storage",
     *      tags={"Certification"},
     *      description="Delete Certification",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Certification",
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
        /** @var Certification $certification */
        $certification = $this->certificationRepository->findWithoutFail($id);

        if (empty($certification)) {
            return $this->sendError('Certification not found');
        }

        $certification->delete();

        return $this->sendResponse($id, 'Certification deleted successfully');
    }
}
