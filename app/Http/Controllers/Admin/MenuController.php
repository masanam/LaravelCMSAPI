<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\MenuDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateMenuRequest;
use App\Http\Requests\Admin\UpdateMenuRequest;
use App\Repositories\MenuRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy
use Str;

class MenuController extends AppBaseController
{
    /** @var  MenuRepository */
    private $menuRepository;

    public function __construct(MenuRepository $menuRepo)
    {
        $this->middleware('auth');
        $this->menuRepository = $menuRepo;
    }

    /**
     * Display a listing of the Menu.
     *
     * @param MenuDataTable $menuDataTable
     * @return Response
     */
    public function index(MenuDataTable $menuDataTable)
    {
        return $menuDataTable->render('admin.menus.index');
    }

    /**
     * Show the form for creating a new Menu.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        
        $status = \App\Models\Status::get();
        $menus = \App\Models\Menu::orderby('title','asc')->get();

        // edited by dandisy
        // return view('admin.menus.create');
        return view('admin.menus.create')
        ->with('menus', $menus)    
        ->with('status', $status);        

    }

    /**
     * Store a newly created Menu in storage.
     *
     * @param CreateMenuRequest $request
     *
     * @return Response
     */
    public function store(CreateMenuRequest $request)
    {        

        $link = Str::slug($request->title, '-');

        $request->request->add([
            'link' => $link,
            'created_by' => Auth::User()->id,
            'updated_by' => Auth::User()->id
        ]);
        $input = $request->all();

        $menu = $this->menuRepository->create($input);

        Flash::success('Menu saved successfully.');

        return redirect(route('admin.menus.index'));
    }

    /**
     * Display the specified Menu.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $menu = $this->menuRepository->findWithoutFail($id);

        if (empty($menu)) {
            Flash::error('Menu not found');

            return redirect(route('admin.menus.index'));
        }

        return view('admin.menus.show')->with('menu', $menu);
    }

    /**
     * Show the form for editing the specified Menu.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $menu = $this->menuRepository->findWithoutFail($id);
        $status = \App\Models\Status::get();
        $menus = \App\Models\Menu::orderby('title','asc')->get();

        if (empty($menu)) {
            Flash::error('Menu not found');

            return redirect(route('admin.menus.index'));
        }

        // edited by dandisy
        // return view('admin.menus.edit')->with('menu', $menu);
        return view('admin.menus.edit')
                ->with('status', $status)
                ->with('menu', $menu)
                ->with('menus', $menus);

                    
    }

    /**
     * Update the specified Menu in storage.
     *
     * @param  int              $id
     * @param UpdateMenuRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMenuRequest $request)
    {
        $menu = $this->menuRepository->findWithoutFail($id);

        if (empty($menu)) {
            Flash::error('Menu not found');

            return redirect(route('admin.menus.index'));
        }

        $request->request->add([
            'updated_by' => Auth::User()->id
        ]);

        $menu = $this->menuRepository->update($request->all(), $id);

        Flash::success('Menu updated successfully.');

        return redirect(route('admin.menus.index'));
    }

    /**
     * Remove the specified Menu from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $menu = $this->menuRepository->findWithoutFail($id);

        if (empty($menu)) {
            Flash::error('Menu not found');

            return redirect(route('admin.menus.index'));
        }

        $this->menuRepository->delete($id);

        Flash::success('Menu deleted successfully.');

        return redirect(route('admin.menus.index'));
    }

    /**
     * Store data Menu from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $menu = $this->menuRepository->create($item->toArray());
            });
        });

        Flash::success('Menu saved successfully.');

        return redirect(route('admin.menus.index'));
    }
}
