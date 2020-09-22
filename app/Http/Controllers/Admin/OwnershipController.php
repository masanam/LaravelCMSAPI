<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\OwnershipDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateOwnershipRequest;
use App\Http\Requests\Admin\UpdateOwnershipRequest;
use App\Repositories\OwnershipRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class OwnershipController extends AppBaseController
{
    /** @var  OwnershipRepository */
    private $ownershipRepository;

    public function __construct(OwnershipRepository $ownershipRepo)
    {
        $this->middleware('auth');
        $this->ownershipRepository = $ownershipRepo;
    }

    /**
     * Display a listing of the Ownership.
     *
     * @param OwnershipDataTable $ownershipDataTable
     * @return Response
     */
    public function index(OwnershipDataTable $ownershipDataTable)
    {
        return $ownershipDataTable->render('admin.ownerships.index');
    }

    /**
     * Show the form for creating a new Ownership.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        // edited by dandisy
        // return view('admin.ownerships.create');
        return view('admin.ownerships.create')
            ->with('status', $status);
    }

    /**
     * Store a newly created Ownership in storage.
     *
     * @param CreateOwnershipRequest $request
     *
     * @return Response
     */
    public function store(CreateOwnershipRequest $request)
    {
        $input = $request->all();

        $ownership = $this->ownershipRepository->create($input);

        Flash::success('Ownership saved successfully.');

        return redirect(route('admin.ownerships.index'));
    }

    /**
     * Display the specified Ownership.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ownership = $this->ownershipRepository->findWithoutFail($id);

        if (empty($ownership)) {
            Flash::error('Ownership not found');

            return redirect(route('admin.ownerships.index'));
        }

        return view('admin.ownerships.show')->with('ownership', $ownership);
    }

    /**
     * Show the form for editing the specified Ownership.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        $ownership = $this->ownershipRepository->findWithoutFail($id);

        if (empty($ownership)) {
            Flash::error('Ownership not found');

            return redirect(route('admin.ownerships.index'));
        }

        // edited by dandisy
        // return view('admin.ownerships.edit')->with('ownership', $ownership);
        return view('admin.ownerships.edit')
            ->with('ownership', $ownership)
            ->with('status', $status);        
    }

    /**
     * Update the specified Ownership in storage.
     *
     * @param  int              $id
     * @param UpdateOwnershipRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOwnershipRequest $request)
    {
        $ownership = $this->ownershipRepository->findWithoutFail($id);

        if (empty($ownership)) {
            Flash::error('Ownership not found');

            return redirect(route('admin.ownerships.index'));
        }

        $ownership = $this->ownershipRepository->update($request->all(), $id);

        Flash::success('Ownership updated successfully.');

        return redirect(route('admin.ownerships.index'));
    }

    /**
     * Remove the specified Ownership from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ownership = $this->ownershipRepository->findWithoutFail($id);

        if (empty($ownership)) {
            Flash::error('Ownership not found');

            return redirect(route('admin.ownerships.index'));
        }

        $this->ownershipRepository->delete($id);

        Flash::success('Ownership deleted successfully.');

        return redirect(route('admin.ownerships.index'));
    }

    /**
     * Store data Ownership from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $ownership = $this->ownershipRepository->create($item->toArray());
            });
        });

        Flash::success('Ownership saved successfully.');

        return redirect(route('admin.ownerships.index'));
    }
}
