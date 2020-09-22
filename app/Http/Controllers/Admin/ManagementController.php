<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ManagementDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateManagementRequest;
use App\Http\Requests\Admin\UpdateManagementRequest;
use App\Repositories\ManagementRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class ManagementController extends AppBaseController
{
    /** @var  ManagementRepository */
    private $managementRepository;

    public function __construct(ManagementRepository $managementRepo)
    {
        $this->middleware('auth');
        $this->managementRepository = $managementRepo;
    }

    /**
     * Display a listing of the Management.
     *
     * @param ManagementDataTable $managementDataTable
     * @return Response
     */
    public function index(ManagementDataTable $managementDataTable)
    {
        return $managementDataTable->render('admin.managements.index');
    }

    /**
     * Show the form for creating a new Management.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('admin.managements.create');
        return view('admin.managements.create');
    }

    /**
     * Store a newly created Management in storage.
     *
     * @param CreateManagementRequest $request
     *
     * @return Response
     */
    public function store(CreateManagementRequest $request)
    {
        $input = $request->all();

        $management = $this->managementRepository->create($input);

        Flash::success('Management saved successfully.');

        return redirect(route('admin.managements.index'));
    }

    /**
     * Display the specified Management.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $management = $this->managementRepository->findWithoutFail($id);

        if (empty($management)) {
            Flash::error('Management not found');

            return redirect(route('admin.managements.index'));
        }

        return view('admin.managements.show')->with('management', $management);
    }

    /**
     * Show the form for editing the specified Management.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $management = $this->managementRepository->findWithoutFail($id);

        if (empty($management)) {
            Flash::error('Management not found');

            return redirect(route('admin.managements.index'));
        }

        // edited by dandisy
        // return view('admin.managements.edit')->with('management', $management);
        return view('admin.managements.edit')
            ->with('management', $management);        
    }

    /**
     * Update the specified Management in storage.
     *
     * @param  int              $id
     * @param UpdateManagementRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateManagementRequest $request)
    {
        $management = $this->managementRepository->findWithoutFail($id);

        if (empty($management)) {
            Flash::error('Management not found');

            return redirect(route('admin.managements.index'));
        }

        $management = $this->managementRepository->update($request->all(), $id);

        Flash::success('Management updated successfully.');

        return redirect(route('admin.managements.index'));
    }

    /**
     * Remove the specified Management from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $management = $this->managementRepository->findWithoutFail($id);

        if (empty($management)) {
            Flash::error('Management not found');

            return redirect(route('admin.managements.index'));
        }

        $this->managementRepository->delete($id);

        Flash::success('Management deleted successfully.');

        return redirect(route('admin.managements.index'));
    }

    /**
     * Store data Management from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $management = $this->managementRepository->create($item->toArray());
            });
        });

        Flash::success('Management saved successfully.');

        return redirect(route('admin.managements.index'));
    }
}
