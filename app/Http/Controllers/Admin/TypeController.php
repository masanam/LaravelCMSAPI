<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\TypeDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateTypeRequest;
use App\Http\Requests\Admin\UpdateTypeRequest;
use App\Repositories\TypeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy
use Str;

class TypeController extends AppBaseController
{
    /** @var  TypeRepository */
    private $typeRepository;

    public function __construct(TypeRepository $typeRepo)
    {
        $this->middleware('auth');
        $this->typeRepository = $typeRepo;
    }

    /**
     * Display a listing of the Type.
     *
     * @param TypeDataTable $typeDataTable
     * @return Response
     */
    public function index(TypeDataTable $typeDataTable)
    {
        return $typeDataTable->render('admin.types.index');
    }

    /**
     * Show the form for creating a new Type.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('admin.types.create');
        return view('admin.types.create');
    }

    /**
     * Store a newly created Type in storage.
     *
     * @param CreateTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateTypeRequest $request)
    {
        $seotitle = Str::slug($request->title, '-');
        
        $request->request->add([
            'created_by' => Auth::User()->id,
            'updated_by' => Auth::User()->id,
            'slug' => $seotitle
        ]);

        $input = $request->all();

        $type = $this->typeRepository->create($input);

        Flash::success('Type saved successfully.');

        return redirect(route('admin.types.index'));
    }

    /**
     * Display the specified Type.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $type = $this->typeRepository->findWithoutFail($id);

        if (empty($type)) {
            Flash::error('Type not found');

            return redirect(route('admin.types.index'));
        }

        return view('admin.types.show')->with('type', $type);
    }

    /**
     * Show the form for editing the specified Type.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $type = $this->typeRepository->findWithoutFail($id);

        if (empty($type)) {
            Flash::error('Type not found');

            return redirect(route('admin.types.index'));
        }

        // edited by dandisy
        // return view('admin.types.edit')->with('type', $type);
        return view('admin.types.edit')
            ->with('type', $type);        
    }

    /**
     * Update the specified Type in storage.
     *
     * @param  int              $id
     * @param UpdateTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTypeRequest $request)
    {
        $type = $this->typeRepository->findWithoutFail($id);

        if (empty($type)) {
            Flash::error('Type not found');

            return redirect(route('admin.types.index'));
        }

        $request->request->add([
             'updated_by' => Auth::User()->id
        ]);

        $type = $this->typeRepository->update($request->all(), $id);

        Flash::success('Type updated successfully.');

        return redirect(route('admin.types.index'));
    }

    /**
     * Remove the specified Type from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $type = $this->typeRepository->findWithoutFail($id);

        if (empty($type)) {
            Flash::error('Type not found');

            return redirect(route('admin.types.index'));
        }

        $this->typeRepository->delete($id);

        Flash::success('Type deleted successfully.');

        return redirect(route('admin.types.index'));
    }

    /**
     * Store data Type from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $type = $this->typeRepository->create($item->toArray());
            });
        });

        Flash::success('Type saved successfully.');

        return redirect(route('admin.types.index'));
    }
}
