<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CompositionDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateCompositionRequest;
use App\Http\Requests\Admin\UpdateCompositionRequest;
use App\Repositories\CompositionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class CompositionController extends AppBaseController
{
    /** @var  CompositionRepository */
    private $compositionRepository;

    public function __construct(CompositionRepository $compositionRepo)
    {
        $this->middleware('auth');
        $this->compositionRepository = $compositionRepo;
    }

    /**
     * Display a listing of the Composition.
     *
     * @param CompositionDataTable $compositionDataTable
     * @return Response
     */
    public function index(CompositionDataTable $compositionDataTable)
    {
        return $compositionDataTable->render('admin.compositions.index');
    }

    /**
     * Show the form for creating a new Composition.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        // edited by dandisy
        // return view('admin.compositions.create');
        return view('admin.compositions.create')
            ->with('status', $status);
    }

    /**
     * Store a newly created Composition in storage.
     *
     * @param CreateCompositionRequest $request
     *
     * @return Response
     */
    public function store(CreateCompositionRequest $request)
    {
        $input = $request->all();

        $composition = $this->compositionRepository->create($input);

        Flash::success('Composition saved successfully.');

        return redirect(route('admin.compositions.index'));
    }

    /**
     * Display the specified Composition.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $composition = $this->compositionRepository->findWithoutFail($id);

        if (empty($composition)) {
            Flash::error('Composition not found');

            return redirect(route('admin.compositions.index'));
        }

        return view('admin.compositions.show')->with('composition', $composition);
    }

    /**
     * Show the form for editing the specified Composition.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        $composition = $this->compositionRepository->findWithoutFail($id);

        if (empty($composition)) {
            Flash::error('Composition not found');

            return redirect(route('admin.compositions.index'));
        }

        // edited by dandisy
        // return view('admin.compositions.edit')->with('composition', $composition);
        return view('admin.compositions.edit')
            ->with('composition', $composition)
            ->with('status', $status);        
    }

    /**
     * Update the specified Composition in storage.
     *
     * @param  int              $id
     * @param UpdateCompositionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompositionRequest $request)
    {
        $composition = $this->compositionRepository->findWithoutFail($id);

        if (empty($composition)) {
            Flash::error('Composition not found');

            return redirect(route('admin.compositions.index'));
        }

        $composition = $this->compositionRepository->update($request->all(), $id);

        Flash::success('Composition updated successfully.');

        return redirect(route('admin.compositions.index'));
    }

    /**
     * Remove the specified Composition from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $composition = $this->compositionRepository->findWithoutFail($id);

        if (empty($composition)) {
            Flash::error('Composition not found');

            return redirect(route('admin.compositions.index'));
        }

        $this->compositionRepository->delete($id);

        Flash::success('Composition deleted successfully.');

        return redirect(route('admin.compositions.index'));
    }

    /**
     * Store data Composition from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $composition = $this->compositionRepository->create($item->toArray());
            });
        });

        Flash::success('Composition saved successfully.');

        return redirect(route('admin.compositions.index'));
    }
}
