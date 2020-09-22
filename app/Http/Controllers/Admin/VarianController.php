<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\VarianDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateVarianRequest;
use App\Http\Requests\Admin\UpdateVarianRequest;
use App\Repositories\VarianRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class VarianController extends AppBaseController
{
    /** @var  VarianRepository */
    private $varianRepository;

    public function __construct(VarianRepository $varianRepo)
    {
        $this->middleware('auth');
        $this->varianRepository = $varianRepo;
    }

    /**
     * Display a listing of the Varian.
     *
     * @param VarianDataTable $varianDataTable
     * @return Response
     */
    public function index(VarianDataTable $varianDataTable)
    {
        return $varianDataTable->render('admin.varians.index');
    }

    /**
     * Show the form for creating a new Varian.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('admin.varians.create');
        return view('admin.varians.create');
    }

    /**
     * Store a newly created Varian in storage.
     *
     * @param CreateVarianRequest $request
     *
     * @return Response
     */
    public function store(CreateVarianRequest $request)
    {
        $input = $request->all();

        $varian = $this->varianRepository->create($input);

        Flash::success('Varian saved successfully.');

        return redirect(route('admin.varians.index'));
    }

    /**
     * Display the specified Varian.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $varian = $this->varianRepository->findWithoutFail($id);

        if (empty($varian)) {
            Flash::error('Varian not found');

            return redirect(route('admin.varians.index'));
        }

        return view('admin.varians.show')->with('varian', $varian);
    }

    /**
     * Show the form for editing the specified Varian.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $varian = $this->varianRepository->findWithoutFail($id);

        if (empty($varian)) {
            Flash::error('Varian not found');

            return redirect(route('admin.varians.index'));
        }

        // edited by dandisy
        // return view('admin.varians.edit')->with('varian', $varian);
        return view('admin.varians.edit')
            ->with('varian', $varian);        
    }

    /**
     * Update the specified Varian in storage.
     *
     * @param  int              $id
     * @param UpdateVarianRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVarianRequest $request)
    {
        $varian = $this->varianRepository->findWithoutFail($id);

        if (empty($varian)) {
            Flash::error('Varian not found');

            return redirect(route('admin.varians.index'));
        }

        $varian = $this->varianRepository->update($request->all(), $id);

        Flash::success('Varian updated successfully.');

        return redirect(route('admin.varians.index'));
    }

    /**
     * Remove the specified Varian from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $varian = $this->varianRepository->findWithoutFail($id);

        if (empty($varian)) {
            Flash::error('Varian not found');

            return redirect(route('admin.varians.index'));
        }

        $this->varianRepository->delete($id);

        Flash::success('Varian deleted successfully.');

        return redirect(route('admin.varians.index'));
    }

    /**
     * Store data Varian from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $varian = $this->varianRepository->create($item->toArray());
            });
        });

        Flash::success('Varian saved successfully.');

        return redirect(route('admin.varians.index'));
    }
}
