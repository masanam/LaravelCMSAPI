<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PartDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreatePartRequest;
use App\Http\Requests\Admin\UpdatePartRequest;
use App\Repositories\PartRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class PartController extends AppBaseController
{
    /** @var  PartRepository */
    private $partRepository;

    public function __construct(PartRepository $partRepo)
    {
        $this->middleware('auth');
        $this->partRepository = $partRepo;
    }

    /**
     * Display a listing of the Part.
     *
     * @param PartDataTable $partDataTable
     * @return Response
     */
    public function index(PartDataTable $partDataTable)
    {
        return $partDataTable->render('admin.parts.index');
    }

    /**
     * Show the form for creating a new Part.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('admin.parts.create');
        return view('admin.parts.create');
    }

    /**
     * Store a newly created Part in storage.
     *
     * @param CreatePartRequest $request
     *
     * @return Response
     */
    public function store(CreatePartRequest $request)
    {
        $input = $request->all();

        $part = $this->partRepository->create($input);

        Flash::success('Part saved successfully.');

        return redirect(route('admin.parts.index'));
    }

    /**
     * Display the specified Part.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $part = $this->partRepository->findWithoutFail($id);

        if (empty($part)) {
            Flash::error('Part not found');

            return redirect(route('admin.parts.index'));
        }

        return view('admin.parts.show')->with('part', $part);
    }

    /**
     * Show the form for editing the specified Part.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $part = $this->partRepository->findWithoutFail($id);

        if (empty($part)) {
            Flash::error('Part not found');

            return redirect(route('admin.parts.index'));
        }

        // edited by dandisy
        // return view('admin.parts.edit')->with('part', $part);
        return view('admin.parts.edit')
            ->with('part', $part);        
    }

    /**
     * Update the specified Part in storage.
     *
     * @param  int              $id
     * @param UpdatePartRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePartRequest $request)
    {
        $part = $this->partRepository->findWithoutFail($id);

        if (empty($part)) {
            Flash::error('Part not found');

            return redirect(route('admin.parts.index'));
        }

        $part = $this->partRepository->update($request->all(), $id);

        Flash::success('Part updated successfully.');

        return redirect(route('admin.parts.index'));
    }

    /**
     * Remove the specified Part from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $part = $this->partRepository->findWithoutFail($id);

        if (empty($part)) {
            Flash::error('Part not found');

            return redirect(route('admin.parts.index'));
        }

        $this->partRepository->delete($id);

        Flash::success('Part deleted successfully.');

        return redirect(route('admin.parts.index'));
    }

    /**
     * Store data Part from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $part = $this->partRepository->create($item->toArray());
            });
        });

        Flash::success('Part saved successfully.');

        return redirect(route('admin.parts.index'));
    }
}
