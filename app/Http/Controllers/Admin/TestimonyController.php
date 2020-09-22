<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\TestimonyDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateTestimonyRequest;
use App\Http\Requests\Admin\UpdateTestimonyRequest;
use App\Repositories\TestimonyRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy
use Str;

class TestimonyController extends AppBaseController
{
    /** @var  TestimonyRepository */
    private $testimonyRepository;

    public function __construct(TestimonyRepository $testimonyRepo)
    {
        $this->middleware('auth');
        $this->testimonyRepository = $testimonyRepo;
    }

    /**
     * Display a listing of the Testimony.
     *
     * @param TestimonyDataTable $testimonyDataTable
     * @return Response
     */
    public function index(TestimonyDataTable $testimonyDataTable)
    {
        return $testimonyDataTable->render('admin.testimonies.index');
    }

    /**
     * Show the form for creating a new Testimony.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        // edited by dandisy
        // return view('admin.testimonies.create');
        return view('admin.testimonies.create')
            ->with('status', $status);
    }

    /**
     * Store a newly created Testimony in storage.
     *
     * @param CreateTestimonyRequest $request
     *
     * @return Response
     */
    public function store(CreateTestimonyRequest $request)
    {
        $seotitle = Str::slug($request->title, '-');
        
        $request->request->add([
            'created_by' => Auth::User()->id,
            'updated_by' => Auth::User()->id,
            'seotitle' => $seotitle
        ]);

        $input = $request->all();
        $testimony = $this->testimonyRepository->create($input);

        Flash::success('Testimony saved successfully.');

        return redirect(route('admin.testimonies.index'));
    }

    /**
     * Display the specified Testimony.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $testimony = $this->testimonyRepository->findWithoutFail($id);

        if (empty($testimony)) {
            Flash::error('Testimony not found');

            return redirect(route('admin.testimonies.index'));
        }

        return view('admin.testimonies.show')->with('testimony', $testimony);
    }

    /**
     * Show the form for editing the specified Testimony.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        $testimony = $this->testimonyRepository->findWithoutFail($id);

        if (empty($testimony)) {
            Flash::error('Testimony not found');

            return redirect(route('admin.testimonies.index'));
        }

        // edited by dandisy
        // return view('admin.testimonies.edit')->with('testimony', $testimony);
        return view('admin.testimonies.edit')
            ->with('testimony', $testimony)
            ->with('status', $status);        
    }

    /**
     * Update the specified Testimony in storage.
     *
     * @param  int              $id
     * @param UpdateTestimonyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTestimonyRequest $request)
    {
        $testimony = $this->testimonyRepository->findWithoutFail($id);

        if (empty($testimony)) {
            Flash::error('Testimony not found');

            return redirect(route('admin.testimonies.index'));
        }

        $request->request->add([
             'updated_by' => Auth::User()->id
        ]);

        $testimony = $this->testimonyRepository->update($request->all(), $id);

        Flash::success('Testimony updated successfully.');

        return redirect(route('admin.testimonies.index'));
    }

    /**
     * Remove the specified Testimony from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $testimony = $this->testimonyRepository->findWithoutFail($id);

        if (empty($testimony)) {
            Flash::error('Testimony not found');

            return redirect(route('admin.testimonies.index'));
        }

        $this->testimonyRepository->delete($id);

        Flash::success('Testimony deleted successfully.');

        return redirect(route('admin.testimonies.index'));
    }

    /**
     * Store data Testimony from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $testimony = $this->testimonyRepository->create($item->toArray());
            });
        });

        Flash::success('Testimony saved successfully.');

        return redirect(route('admin.testimonies.index'));
    }
}
