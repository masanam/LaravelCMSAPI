<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PositionDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreatePositionRequest;
use App\Http\Requests\Admin\UpdatePositionRequest;
use App\Repositories\PositionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class PositionController extends AppBaseController
{
    /** @var  PositionRepository */
    private $positionRepository;

    public function __construct(PositionRepository $positionRepo)
    {
        $this->middleware('auth');
        $this->positionRepository = $positionRepo;
    }

    /**
     * Display a listing of the Position.
     *
     * @param PositionDataTable $positionDataTable
     * @return Response
     */
    public function index(PositionDataTable $positionDataTable)
    {
        return $positionDataTable->render('admin.positions.index');
    }

    /**
     * Show the form for creating a new Position.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        // edited by dandisy
        // return view('admin.positions.create');
        return view('admin.positions.create')
            ->with('status', $status);
    }

    /**
     * Store a newly created Position in storage.
     *
     * @param CreatePositionRequest $request
     *
     * @return Response
     */
    public function store(CreatePositionRequest $request)
    {
        $input = $request->all();

        $position = $this->positionRepository->create($input);

        Flash::success('Position saved successfully.');

        return redirect(route('admin.positions.index'));
    }

    /**
     * Display the specified Position.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $position = $this->positionRepository->findWithoutFail($id);

        if (empty($position)) {
            Flash::error('Position not found');

            return redirect(route('admin.positions.index'));
        }

        return view('admin.positions.show')->with('position', $position);
    }

    /**
     * Show the form for editing the specified Position.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        $position = $this->positionRepository->findWithoutFail($id);

        if (empty($position)) {
            Flash::error('Position not found');

            return redirect(route('admin.positions.index'));
        }

        // edited by dandisy
        // return view('admin.positions.edit')->with('position', $position);
        return view('admin.positions.edit')
            ->with('position', $position)
            ->with('status', $status);        
    }

    /**
     * Update the specified Position in storage.
     *
     * @param  int              $id
     * @param UpdatePositionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePositionRequest $request)
    {
        $position = $this->positionRepository->findWithoutFail($id);

        if (empty($position)) {
            Flash::error('Position not found');

            return redirect(route('admin.positions.index'));
        }

        $position = $this->positionRepository->update($request->all(), $id);

        Flash::success('Position updated successfully.');

        return redirect(route('admin.positions.index'));
    }

    /**
     * Remove the specified Position from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $position = $this->positionRepository->findWithoutFail($id);

        if (empty($position)) {
            Flash::error('Position not found');

            return redirect(route('admin.positions.index'));
        }

        $this->positionRepository->delete($id);

        Flash::success('Position deleted successfully.');

        return redirect(route('admin.positions.index'));
    }

    /**
     * Store data Position from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $position = $this->positionRepository->create($item->toArray());
            });
        });

        Flash::success('Position saved successfully.');

        return redirect(route('admin.positions.index'));
    }
}
