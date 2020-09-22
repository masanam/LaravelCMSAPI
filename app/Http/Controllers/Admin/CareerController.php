<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CareerDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateCareerRequest;
use App\Http\Requests\Admin\UpdateCareerRequest;
use App\Repositories\CareerRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy
use Str;

class CareerController extends AppBaseController
{
    /** @var  CareerRepository */
    private $careerRepository;

    public function __construct(CareerRepository $careerRepo)
    {
        $this->middleware('auth');
        $this->careerRepository = $careerRepo;
    }

    /**
     * Display a listing of the Career.
     *
     * @param CareerDataTable $careerDataTable
     * @return Response
     */
    public function index(CareerDataTable $careerDataTable)
    {
        return $careerDataTable->render('admin.careers.index');
    }

    /**
     * Show the form for creating a new Career.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        $group = \App\Models\Group::get();

        // edited by dandisy
        // return view('admin.careers.create');
        return view('admin.careers.create')
            ->with('group', $group)
            ->with('status', $status);
    }

    /**
     * Store a newly created Career in storage.
     *
     * @param CreateCareerRequest $request
     *
     * @return Response
     */
    public function store(CreateCareerRequest $request)
    {
        $seotitle = Str::slug($request->title, '-');
        $home = $request->home == '1' ? '1' : '0';

        $request->request->add([
            'created_by' => Auth::User()->id,
            'updated_by' => Auth::User()->id,
            'home' => $home,
            'seotitle' => $seotitle
        ]);
        $input = $request->all();

        $career = $this->careerRepository->create($input);

        Flash::success('Career saved successfully.');

        return redirect(route('admin.careers.index'));
    }

    /**
     * Display the specified Career.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $career = $this->careerRepository->findWithoutFail($id);

        if (empty($career)) {
            Flash::error('Career not found');

            return redirect(route('admin.careers.index'));
        }

        return view('admin.careers.show')->with('career', $career);
    }

    /**
     * Show the form for editing the specified Career.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        $group = \App\Models\Group::get();

        $career = $this->careerRepository->findWithoutFail($id);

        if (empty($career)) {
            Flash::error('Career not found');

            return redirect(route('admin.careers.index'));
        }

        // edited by dandisy
        // return view('admin.careers.edit')->with('career', $career);
        return view('admin.careers.edit')
            ->with('group', $group)
            ->with('career', $career)
            ->with('status', $status);        
    }

    /**
     * Update the specified Career in storage.
     *
     * @param  int              $id
     * @param UpdateCareerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCareerRequest $request)
    {
        $career = $this->careerRepository->findWithoutFail($id);

        if (empty($career)) {
            Flash::error('Career not found');

            return redirect(route('admin.careers.index'));
        }

        $home = $request->home == '1' ? '1' : '0';
        $request->request->add([
            'updated_by' => Auth::User()->id,
            'home' => $home
        ]);


        $career = $this->careerRepository->update($request->all(), $id);

        Flash::success('Career updated successfully.');

        return redirect(route('admin.careers.index'));
    }

    /**
     * Remove the specified Career from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $career = $this->careerRepository->findWithoutFail($id);

        if (empty($career)) {
            Flash::error('Career not found');

            return redirect(route('admin.careers.index'));
        }

        $this->careerRepository->delete($id);

        Flash::success('Career deleted successfully.');

        return redirect(route('admin.careers.index'));
    }

    /**
     * Store data Career from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $career = $this->careerRepository->create($item->toArray());
            });
        });

        Flash::success('Career saved successfully.');

        return redirect(route('admin.careers.index'));
    }
}
