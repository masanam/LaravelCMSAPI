<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\MilestoneDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateMilestoneRequest;
use App\Http\Requests\Admin\UpdateMilestoneRequest;
use App\Repositories\MilestoneRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy
use Str;

class MilestoneController extends AppBaseController
{
    /** @var  MilestoneRepository */
    private $milestoneRepository;

    public function __construct(MilestoneRepository $milestoneRepo)
    {
        $this->middleware('auth');
        $this->milestoneRepository = $milestoneRepo;
    }

    /**
     * Display a listing of the Milestone.
     *
     * @param MilestoneDataTable $milestoneDataTable
     * @return Response
     */
    public function index(MilestoneDataTable $milestoneDataTable)
    {
        return $milestoneDataTable->render('admin.milestones.index');
    }

    /**
     * Show the form for creating a new Milestone.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('admin.milestones.create');
        return view('admin.milestones.create');
    }

    /**
     * Store a newly created Milestone in storage.
     *
     * @param CreateMilestoneRequest $request
     *
     * @return Response
     */
    public function store(CreateMilestoneRequest $request)
    {
        $seotitle = Str::slug($request->year, '-');

        $request->request->add([
            'created_by' => Auth::User()->id,
            'updated_by' => Auth::User()->id,
            'slug' => $seotitle
        ]);
        $input = $request->all();

        $milestone = $this->milestoneRepository->create($input);

        Flash::success('Milestone saved successfully.');

        return redirect(route('admin.milestones.index'));
    }

    /**
     * Display the specified Milestone.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $milestone = $this->milestoneRepository->findWithoutFail($id);

        if (empty($milestone)) {
            Flash::error('Milestone not found');

            return redirect(route('admin.milestones.index'));
        }

        return view('admin.milestones.show')->with('milestone', $milestone);
    }

    /**
     * Show the form for editing the specified Milestone.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $milestone = $this->milestoneRepository->findWithoutFail($id);

        if (empty($milestone)) {
            Flash::error('Milestone not found');

            return redirect(route('admin.milestones.index'));
        }

        // edited by dandisy
        // return view('admin.milestones.edit')->with('milestone', $milestone);
        return view('admin.milestones.edit')
            ->with('milestone', $milestone);        
    }

    /**
     * Update the specified Milestone in storage.
     *
     * @param  int              $id
     * @param UpdateMilestoneRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMilestoneRequest $request)
    {
        $milestone = $this->milestoneRepository->findWithoutFail($id);

        if (empty($milestone)) {
            Flash::error('Milestone not found');

            return redirect(route('admin.milestones.index'));
        }

        $request->request->add([
            'updated_by' => Auth::User()->id
        ]);

        $milestone = $this->milestoneRepository->update($request->all(), $id);

        Flash::success('Milestone updated successfully.');

        return redirect(route('admin.milestones.index'));
    }

    /**
     * Remove the specified Milestone from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $milestone = $this->milestoneRepository->findWithoutFail($id);

        if (empty($milestone)) {
            Flash::error('Milestone not found');

            return redirect(route('admin.milestones.index'));
        }

        $this->milestoneRepository->delete($id);

        Flash::success('Milestone deleted successfully.');

        return redirect(route('admin.milestones.index'));
    }

    /**
     * Store data Milestone from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $milestone = $this->milestoneRepository->create($item->toArray());
            });
        });

        Flash::success('Milestone saved successfully.');

        return redirect(route('admin.milestones.index'));
    }
}
