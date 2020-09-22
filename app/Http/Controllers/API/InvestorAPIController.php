<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInvestorAPIRequest;
use App\Http\Requests\API\UpdateInvestorAPIRequest;
use App\Models\Investor;
use App\Repositories\InvestorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class InvestorController
 * @package App\Http\Controllers\API
 */

class InvestorAPIController extends AppBaseController
{
    /** @var  InvestorRepository */
    private $investorRepository;

    public function __construct(InvestorRepository $investorRepo)
    {
        $this->middleware('auth:api');
        $this->investorRepository = $investorRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/investors",
     *      summary="Get a listing of the Investors.",
     *      tags={"Investor"},
     *      description="Get all Investors",
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
     *                  @SWG\Items(ref="#/definitions/Investor")
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
        $this->investorRepository->pushCriteria(new RequestCriteria($request));
        $this->investorRepository->pushCriteria(new LimitOffsetCriteria($request));
        $investors = $this->investorRepository->all();

        return $this->sendResponse($investors->toArray(), 'Investors retrieved successfully');
    }

    /**
     * @param CreateInvestorAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/investors",
     *      summary="Store a newly created Investor in storage",
     *      tags={"Investor"},
     *      description="Store Investor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Investor that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Investor")
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
     *                  ref="#/definitions/Investor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateInvestorAPIRequest $request)
    {
        $input = $request->all();

        $investors = $this->investorRepository->create($input);

        return $this->sendResponse($investors->toArray(), 'Investor saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/investors/{id}",
     *      summary="Display the specified Investor",
     *      tags={"Investor"},
     *      description="Get Investor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Investor",
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
     *                  ref="#/definitions/Investor"
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
        /** @var Investor $investor */
        $investor = $this->investorRepository->findWithoutFail($id);

        if (empty($investor)) {
            return $this->sendError('Investor not found');
        }

        return $this->sendResponse($investor->toArray(), 'Investor retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateInvestorAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/investors/{id}",
     *      summary="Update the specified Investor in storage",
     *      tags={"Investor"},
     *      description="Update Investor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Investor",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Investor that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Investor")
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
     *                  ref="#/definitions/Investor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateInvestorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Investor $investor */
        $investor = $this->investorRepository->findWithoutFail($id);

        if (empty($investor)) {
            return $this->sendError('Investor not found');
        }

        $investor = $this->investorRepository->update($input, $id);

        return $this->sendResponse($investor->toArray(), 'Investor updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/investors/{id}",
     *      summary="Remove the specified Investor from storage",
     *      tags={"Investor"},
     *      description="Delete Investor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Investor",
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
        /** @var Investor $investor */
        $investor = $this->investorRepository->findWithoutFail($id);

        if (empty($investor)) {
            return $this->sendError('Investor not found');
        }

        $investor->delete();

        return $this->sendResponse($id, 'Investor deleted successfully');
    }
}
