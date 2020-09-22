<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\DirectorDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateDirectorRequest;
use App\Http\Requests\Admin\UpdateDirectorRequest;
use App\Repositories\DirectorRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class DirectorController extends AppBaseController
{
    /** @var  DirectorRepository */
    private $directorRepository;

    public function __construct(DirectorRepository $directorRepo)
    {
        $this->middleware('auth');
        $this->directorRepository = $directorRepo;
    }

    /**
     * Display a listing of the Director.
     *
     * @param DirectorDataTable $directorDataTable
     * @return Response
     */
    public function index(DirectorDataTable $directorDataTable)
    {
        return $directorDataTable->render('admin.directors.index');
    }

    /**
     * Show the form for creating a new Director.
     *
     * @return Response
     */
    public function create()
    {
        $status = \App\Models\Status::get();
        $category = \App\Models\Management::get();

        // edited by dandisy
        // return view('admin.directors.create');
        return view('admin.directors.create')
        ->with('category', $category)
            ->with('status', $status);

    }

    /**
     * Store a newly created Director in storage.
     *
     * @param CreateDirectorRequest $request
     *
     * @return Response
     */
    public function store(CreateDirectorRequest $request)
    {
        $input = $request->all();

        $director = $this->directorRepository->create($input);

        Flash::success('Director saved successfully.');

        return redirect(route('admin.directors.index'));
    }

    /**
     * Display the specified Director.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $director = $this->directorRepository->findWithoutFail($id);

        if (empty($director)) {
            Flash::error('Director not found');

            return redirect(route('admin.directors.index'));
        }

        return view('admin.directors.show')->with('director', $director);
    }

    /**
     * Show the form for editing the specified Director.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $status = \App\Models\Status::get();
        

        $director = $this->directorRepository->findWithoutFail($id);
        $category = \App\Models\Management::get();

        if (empty($director)) {
            Flash::error('Director not found');

            return redirect(route('admin.directors.index'));
        }

        // edited by dandisy
        // return view('admin.directors.edit')->with('director', $director);
        return view('admin.directors.edit')
        ->with('category', $category)
            ->with('director', $director)
            ->with('status', $status); 
       
    }

    /**
     * Update the specified Director in storage.
     *
     * @param  int              $id
     * @param UpdateDirectorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDirectorRequest $request)
    {
        $director = $this->directorRepository->findWithoutFail($id);

        if (empty($director)) {
            Flash::error('Director not found');

            return redirect(route('admin.directors.index'));
        }

        $director = $this->directorRepository->update($request->all(), $id);

        Flash::success('Director updated successfully.');

        return redirect(route('admin.directors.index'));
    }

    /**
     * Remove the specified Director from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $director = $this->directorRepository->findWithoutFail($id);

        if (empty($director)) {
            Flash::error('Director not found');

            return redirect(route('admin.directors.index'));
        }

        $this->directorRepository->delete($id);

        Flash::success('Director deleted successfully.');

        return redirect(route('admin.directors.index'));
    }

    /**
     * Store data Director from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $director = $this->directorRepository->create($item->toArray());
            });
        });

        Flash::success('Director saved successfully.');

        return redirect(route('admin.directors.index'));
    }
}
