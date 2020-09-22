<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\DividenDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateDividenRequest;
use App\Http\Requests\Admin\UpdateDividenRequest;
use App\Repositories\DividenRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class DividenController extends AppBaseController
{
    /** @var  DividenRepository */
    private $dividenRepository;

    public function __construct(DividenRepository $dividenRepo)
    {
        $this->middleware('auth');
        $this->dividenRepository = $dividenRepo;
    }

    /**
     * Display a listing of the Dividen.
     *
     * @param DividenDataTable $dividenDataTable
     * @return Response
     */
    public function index(DividenDataTable $dividenDataTable)
    {
        return $dividenDataTable->render('admin.dividens.index');
    }

    /**
     * Show the form for creating a new Dividen.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        // edited by dandisy
        // return view('admin.dividens.create');
        return view('admin.dividens.create')
            ->with('status', $status);
    }

    /**
     * Store a newly created Dividen in storage.
     *
     * @param CreateDividenRequest $request
     *
     * @return Response
     */
    public function store(CreateDividenRequest $request)
    {
        $input = $request->all();

        $dividen = $this->dividenRepository->create($input);

        Flash::success('Dividen saved successfully.');

        return redirect(route('admin.dividens.index'));
    }

    /**
     * Display the specified Dividen.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $dividen = $this->dividenRepository->findWithoutFail($id);

        if (empty($dividen)) {
            Flash::error('Dividen not found');

            return redirect(route('admin.dividens.index'));
        }

        return view('admin.dividens.show')->with('dividen', $dividen);
    }

    /**
     * Show the form for editing the specified Dividen.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        $dividen = $this->dividenRepository->findWithoutFail($id);

        if (empty($dividen)) {
            Flash::error('Dividen not found');

            return redirect(route('admin.dividens.index'));
        }

        // edited by dandisy
        // return view('admin.dividens.edit')->with('dividen', $dividen);
        return view('admin.dividens.edit')
            ->with('dividen', $dividen)
            ->with('status', $status);        
    }

    /**
     * Update the specified Dividen in storage.
     *
     * @param  int              $id
     * @param UpdateDividenRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDividenRequest $request)
    {
        $dividen = $this->dividenRepository->findWithoutFail($id);

        if (empty($dividen)) {
            Flash::error('Dividen not found');

            return redirect(route('admin.dividens.index'));
        }

        $dividen = $this->dividenRepository->update($request->all(), $id);

        Flash::success('Dividen updated successfully.');

        return redirect(route('admin.dividens.index'));
    }

    /**
     * Remove the specified Dividen from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $dividen = $this->dividenRepository->findWithoutFail($id);

        if (empty($dividen)) {
            Flash::error('Dividen not found');

            return redirect(route('admin.dividens.index'));
        }

        $this->dividenRepository->delete($id);

        Flash::success('Dividen deleted successfully.');

        return redirect(route('admin.dividens.index'));
    }

    /**
     * Store data Dividen from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $dividen = $this->dividenRepository->create($item->toArray());
            });
        });

        Flash::success('Dividen saved successfully.');

        return redirect(route('admin.dividens.index'));
    }
}
