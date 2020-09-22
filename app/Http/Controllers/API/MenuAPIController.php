<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMenuAPIRequest;
use App\Http\Requests\API\UpdateMenuAPIRequest;
use App\Models\Menu;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MenuController
 * @package App\Http\Controllers\API
 */

class MenuAPIController extends AppBaseController
{
    /** @var  MenuRepository */
    private $menuRepository;

    public function __construct(MenuRepository $menuRepo)
    {
        $this->middleware('auth:api');
        $this->menuRepository = $menuRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/menus",
     *      summary="Get a listing of the Menus.",
     *      tags={"Menu"},
     *      description="Get all Menus",
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
     *                  @SWG\Items(ref="#/definitions/Menu")
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
        $this->menuRepository->pushCriteria(new RequestCriteria($request));
        $this->menuRepository->pushCriteria(new LimitOffsetCriteria($request));
        $menus = $this->menuRepository->all();

        return $this->sendResponse($menus->toArray(), 'Menus retrieved successfully');
    }

    /**
     * @param CreateMenuAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/menus",
     *      summary="Store a newly created Menu in storage",
     *      tags={"Menu"},
     *      description="Store Menu",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Menu that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Menu")
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
     *                  ref="#/definitions/Menu"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMenuAPIRequest $request)
    {
        $input = $request->all();

        $menus = $this->menuRepository->create($input);

        return $this->sendResponse($menus->toArray(), 'Menu saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/menus/{id}",
     *      summary="Display the specified Menu",
     *      tags={"Menu"},
     *      description="Get Menu",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Menu",
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
     *                  ref="#/definitions/Menu"
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
        /** @var Menu $menu */
        $menu = $this->menuRepository->findWithoutFail($id);

        if (empty($menu)) {
            return $this->sendError('Menu not found');
        }

        return $this->sendResponse($menu->toArray(), 'Menu retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMenuAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/menus/{id}",
     *      summary="Update the specified Menu in storage",
     *      tags={"Menu"},
     *      description="Update Menu",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Menu",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Menu that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Menu")
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
     *                  ref="#/definitions/Menu"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMenuAPIRequest $request)
    {
        $input = $request->all();

        /** @var Menu $menu */
        $menu = $this->menuRepository->findWithoutFail($id);

        if (empty($menu)) {
            return $this->sendError('Menu not found');
        }

        $menu = $this->menuRepository->update($input, $id);

        return $this->sendResponse($menu->toArray(), 'Menu updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/menus/{id}",
     *      summary="Remove the specified Menu from storage",
     *      tags={"Menu"},
     *      description="Delete Menu",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Menu",
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
        /** @var Menu $menu */
        $menu = $this->menuRepository->findWithoutFail($id);

        if (empty($menu)) {
            return $this->sendError('Menu not found');
        }

        $menu->delete();

        return $this->sendResponse($id, 'Menu deleted successfully');
    }
}
