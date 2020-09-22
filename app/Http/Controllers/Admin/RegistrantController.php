<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\RegistrantDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateRegistrantRequest;
use App\Http\Requests\Admin\UpdateRegistrantRequest;
use App\Repositories\RegistrantRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class RegistrantController extends AppBaseController
{
    /** @var  RegistrantRepository */
    private $registrantRepository;

    public function __construct(RegistrantRepository $registrantRepo)
    {
        $this->middleware('auth');
        $this->registrantRepository = $registrantRepo;
    }

    /**
     * Display a listing of the Registrant.
     *
     * @param RegistrantDataTable $registrantDataTable
     * @return Response
     */
    public function index(RegistrantDataTable $registrantDataTable)
    {
        return $registrantDataTable->render('admin.registrants.index');
    }

    /**
     * Show the form for creating a new Registrant.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        // edited by dandisy
        // return view('admin.registrants.create');
        return view('admin.registrants.create')
            ->with('status', $status);
    }

    /**
     * Store a newly created Registrant in storage.
     *
     * @param CreateRegistrantRequest $request
     *
     * @return Response
     */
    public function store(CreateRegistrantRequest $request)
    {
        $input = $request->all();

        $registrant = $this->registrantRepository->create($input);

        Flash::success('Registrant saved successfully.');

        return redirect(route('admin.registrants.index'));
    }

    /**
     * Display the specified Registrant.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $registrant = $this->registrantRepository->findWithoutFail($id);

        if (empty($registrant)) {
            Flash::error('Registrant not found');

            return redirect(route('admin.registrants.index'));
        }

        return view('admin.registrants.show')->with('registrant', $registrant);
    }

    /**
     * Show the form for editing the specified Registrant.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        $registrant = $this->registrantRepository->findWithoutFail($id);

        if (empty($registrant)) {
            Flash::error('Registrant not found');

            return redirect(route('admin.registrants.index'));
        }

        // edited by dandisy
        // return view('admin.registrants.edit')->with('registrant', $registrant);
        return view('admin.registrants.edit')
            ->with('registrant', $registrant)
            ->with('status', $status);        
    }

    /**
     * Update the specified Registrant in storage.
     *
     * @param  int              $id
     * @param UpdateRegistrantRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRegistrantRequest $request)
    {
        $registrant = $this->registrantRepository->findWithoutFail($id);

        if (empty($registrant)) {
            Flash::error('Registrant not found');

            return redirect(route('admin.registrants.index'));
        }

        $registrant = $this->registrantRepository->update($request->all(), $id);

        Flash::success('Registrant updated successfully.');

        return redirect(route('admin.registrants.index'));
    }

    /**
     * Remove the specified Registrant from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $registrant = $this->registrantRepository->findWithoutFail($id);

        if (empty($registrant)) {
            Flash::error('Registrant not found');

            return redirect(route('admin.registrants.index'));
        }

        $this->registrantRepository->delete($id);

        Flash::success('Registrant deleted successfully.');

        return redirect(route('admin.registrants.index'));
    }

    /**
     * Store data Registrant from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $registrant = $this->registrantRepository->create($item->toArray());
            });
        });

        Flash::success('Registrant saved successfully.');

        return redirect(route('admin.registrants.index'));
    }
}
