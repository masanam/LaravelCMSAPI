<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\GroupDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateGroupRequest;
use App\Http\Requests\Admin\UpdateGroupRequest;
use App\Repositories\GroupRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy
use Str;

class GroupController extends AppBaseController
{
    /** @var  GroupRepository */
    private $groupRepository;

    public function __construct(GroupRepository $groupRepo)
    {
        $this->middleware('auth');
        $this->groupRepository = $groupRepo;
    }

    /**
     * Display a listing of the Group.
     *
     * @param GroupDataTable $groupDataTable
     * @return Response
     */
    public function index(GroupDataTable $groupDataTable)
    {
        return $groupDataTable->render('admin.groups.index');
    }

    /**
     * Show the form for creating a new Group.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        $status = \App\Models\Status::get();


        // edited by dandisy
        // return view('admin.groups.create');
        return view('admin.groups.create')
        ->with('status', $status);

    }

    /**
     * Store a newly created Group in storage.
     *
     * @param CreateGroupRequest $request
     *
     * @return Response
     */
    public function store(CreateGroupRequest $request)
    {
        $seotitle = Str::slug($request->title, '-');
        
        $request->request->add([
            'created_by' => Auth::User()->id,
            'updated_by' => Auth::User()->id,
            'seotitle' => $seotitle
        ]);
        $input = $request->all();
        $group = $this->groupRepository->create($input);

        Flash::success('Group saved successfully.');

        return redirect(route('admin.groups.index'));
    }

    /**
     * Display the specified Group.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $group = $this->groupRepository->findWithoutFail($id);

        if (empty($group)) {
            Flash::error('Group not found');

            return redirect(route('admin.groups.index'));
        }

        return view('admin.groups.show')->with('group', $group);
    }

    /**
     * Show the form for editing the specified Group.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        
        $status = \App\Models\Status::get();

        $group = $this->groupRepository->findWithoutFail($id);

        if (empty($group)) {
            Flash::error('Group not found');

            return redirect(route('admin.groups.index'));
        }

        // edited by dandisy
        // return view('admin.groups.edit')->with('group', $group);
        return view('admin.groups.edit')
        ->with('status', $status)
            ->with('group', $group);        
    }

    /**
     * Update the specified Group in storage.
     *
     * @param  int              $id
     * @param UpdateGroupRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGroupRequest $request)
    {
        $group = $this->groupRepository->findWithoutFail($id);

        if (empty($group)) {
            Flash::error('Group not found');

            return redirect(route('admin.groups.index'));
        }
        $request->request->add([
             'updated_by' => Auth::User()->id
        ]);
        $group = $this->groupRepository->update($request->all(), $id);

        Flash::success('Group updated successfully.');

        return redirect(route('admin.groups.index'));
    }

    /**
     * Remove the specified Group from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $group = $this->groupRepository->findWithoutFail($id);

        if (empty($group)) {
            Flash::error('Group not found');

            return redirect(route('admin.groups.index'));
        }

        $this->groupRepository->delete($id);

        Flash::success('Group deleted successfully.');

        return redirect(route('admin.groups.index'));
    }

    /**
     * Store data Group from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $group = $this->groupRepository->create($item->toArray());
            });
        });

        Flash::success('Group saved successfully.');

        return redirect(route('admin.groups.index'));
    }
}
