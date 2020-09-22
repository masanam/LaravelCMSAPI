<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\BrandDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateBrandRequest;
use App\Http\Requests\Admin\UpdateBrandRequest;
use App\Repositories\BrandRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy
use Str;

class BrandController extends AppBaseController
{
    /** @var  BrandRepository */
    private $brandRepository;

    public function __construct(BrandRepository $brandRepo)
    {
        $this->middleware('auth');
        $this->brandRepository = $brandRepo;
    }

    /**
     * Display a listing of the Brand.
     *
     * @param BrandDataTable $brandDataTable
     * @return Response
     */
    public function index(BrandDataTable $brandDataTable)
    {
        return $brandDataTable->render('admin.brands.index');
    }

    /**
     * Show the form for creating a new Brand.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        $type = \App\Models\Type::orderby('title','asc')->get();


        // edited by dandisy
        // return view('admin.brands.create');
        return view('admin.brands.create')
            ->with('type', $type)
            ->with('status', $status);
    }

    /**
     * Store a newly created Brand in storage.
     *
     * @param CreateBrandRequest $request
     *
     * @return Response
     */
    public function store(CreateBrandRequest $request)
    {
        $seotitle = Str::slug($request->title, '-');

        $request->request->add([
            'created_by' => Auth::User()->id,
            'updated_by' => Auth::User()->id,
            'seotitle' => $seotitle

        ]);
        $input = $request->all();
        $brand = $this->brandRepository->create($input);

        Flash::success('Brand saved successfully.');

        return redirect(route('admin.brands.index'));
    }

    /**
     * Display the specified Brand.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $brand = $this->brandRepository->findWithoutFail($id);

        if (empty($brand)) {
            Flash::error('Brand not found');

            return redirect(route('admin.brands.index'));
        }

        return view('admin.brands.show')->with('brand', $brand);
    }

    /**
     * Show the form for editing the specified Brand.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        $type = \App\Models\Type::orderby('title','asc')->get();


        $brand = $this->brandRepository->findWithoutFail($id);

        if (empty($brand)) {
            Flash::error('Brand not found');

            return redirect(route('admin.brands.index'));
        }

        // edited by dandisy
        // return view('admin.brands.edit')->with('brand', $brand);
        return view('admin.brands.edit')
        ->with('type', $type)
            ->with('brand', $brand)
            ->with('status', $status);        
    }

    /**
     * Update the specified Brand in storage.
     *
     * @param  int              $id
     * @param UpdateBrandRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBrandRequest $request)
    {
        $brand = $this->brandRepository->findWithoutFail($id);

        if (empty($brand)) {
            Flash::error('Brand not found');

            return redirect(route('admin.brands.index'));
        }

        $request->request->add([
                        'updated_by' => Auth::User()->id
        ]);
        
        $brand = $this->brandRepository->update($request->all(), $id);

        Flash::success('Brand updated successfully.');

        return redirect(route('admin.brands.index'));
    }

    /**
     * Remove the specified Brand from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $brand = $this->brandRepository->findWithoutFail($id);

        if (empty($brand)) {
            Flash::error('Brand not found');

            return redirect(route('admin.brands.index'));
        }

        $this->brandRepository->delete($id);

        Flash::success('Brand deleted successfully.');

        return redirect(route('admin.brands.index'));
    }

    /**
     * Store data Brand from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $brand = $this->brandRepository->create($item->toArray());
            });
        });

        Flash::success('Brand saved successfully.');

        return redirect(route('admin.brands.index'));
    }
}
