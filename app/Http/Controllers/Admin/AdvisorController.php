<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AdvisorDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateAdvisorRequest;
use App\Http\Requests\Admin\UpdateAdvisorRequest;
use App\Repositories\AdvisorRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class AdvisorController extends AppBaseController
{
    /** @var  AdvisorRepository */
    private $advisorRepository;

    public function __construct(AdvisorRepository $advisorRepo)
    {
        $this->middleware('auth');
        $this->advisorRepository = $advisorRepo;
    }

    /**
     * Display a listing of the Advisor.
     *
     * @param AdvisorDataTable $advisorDataTable
     * @return Response
     */
    public function index(AdvisorDataTable $advisorDataTable)
    {
        return $advisorDataTable->render('admin.advisors.index');
    }

    /**
     * Show the form for creating a new Advisor.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('admin.advisors.create');
        return view('admin.advisors.create');
    }

    /**
     * Store a newly created Advisor in storage.
     *
     * @param CreateAdvisorRequest $request
     *
     * @return Response
     */
    public function store(CreateAdvisorRequest $request)
    {
        $input = $request->all();

        $advisor = $this->advisorRepository->create($input);

        Flash::success('Advisor saved successfully.');

        return redirect(route('admin.advisors.index'));
    }

    /**
     * Display the specified Advisor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $advisor = $this->advisorRepository->findWithoutFail($id);

        if (empty($advisor)) {
            Flash::error('Advisor not found');

            return redirect(route('admin.advisors.index'));
        }

        return view('admin.advisors.show')->with('advisor', $advisor);
    }

    /**
     * Show the form for editing the specified Advisor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $advisor = $this->advisorRepository->findWithoutFail($id);

        if (empty($advisor)) {
            Flash::error('Advisor not found');

            return redirect(route('admin.advisors.index'));
        }

        // edited by dandisy
        // return view('admin.advisors.edit')->with('advisor', $advisor);
        return view('admin.advisors.edit')
            ->with('advisor', $advisor);        
    }

    /**
     * Update the specified Advisor in storage.
     *
     * @param  int              $id
     * @param UpdateAdvisorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdvisorRequest $request)
    {
        $advisor = $this->advisorRepository->findWithoutFail($id);

        if (empty($advisor)) {
            Flash::error('Advisor not found');

            return redirect(route('admin.advisors.index'));
        }

        $advisor = $this->advisorRepository->update($request->all(), $id);

        Flash::success('Advisor updated successfully.');

        return redirect(route('admin.advisors.index'));
    }

    /**
     * Remove the specified Advisor from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $advisor = $this->advisorRepository->findWithoutFail($id);

        if (empty($advisor)) {
            Flash::error('Advisor not found');

            return redirect(route('admin.advisors.index'));
        }

        $this->advisorRepository->delete($id);

        Flash::success('Advisor deleted successfully.');

        return redirect(route('admin.advisors.index'));
    }

    /**
     * Store data Advisor from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $advisor = $this->advisorRepository->create($item->toArray());
            });
        });

        Flash::success('Advisor saved successfully.');

        return redirect(route('admin.advisors.index'));
    }
}
