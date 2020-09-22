<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\JenisDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateJenisRequest;
use App\Http\Requests\Admin\UpdateJenisRequest;
use App\Repositories\JenisRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class JenisController extends AppBaseController
{
    /** @var  JenisRepository */
    private $jenisRepository;

    public function __construct(JenisRepository $jenisRepo)
    {
        $this->middleware('auth');
        $this->jenisRepository = $jenisRepo;
    }

    /**
     * Display a listing of the Jenis.
     *
     * @param JenisDataTable $jenisDataTable
     * @return Response
     */
    public function index(JenisDataTable $jenisDataTable)
    {
        return $jenisDataTable->render('admin.jenis.index');
    }

    /**
     * Show the form for creating a new Jenis.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('admin.jenis.create');
        return view('admin.jenis.create');
    }

    /**
     * Store a newly created Jenis in storage.
     *
     * @param CreateJenisRequest $request
     *
     * @return Response
     */
    public function store(CreateJenisRequest $request)
    {
        $input = $request->all();

        $jenis = $this->jenisRepository->create($input);

        Flash::success('Jenis saved successfully.');

        return redirect(route('admin.jenis.index'));
    }

    /**
     * Display the specified Jenis.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $jenis = $this->jenisRepository->findWithoutFail($id);

        if (empty($jenis)) {
            Flash::error('Jenis not found');

            return redirect(route('admin.jenis.index'));
        }

        return view('admin.jenis.show')->with('jenis', $jenis);
    }

    /**
     * Show the form for editing the specified Jenis.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $jenis = $this->jenisRepository->findWithoutFail($id);

        if (empty($jenis)) {
            Flash::error('Jenis not found');

            return redirect(route('admin.jenis.index'));
        }

        // edited by dandisy
        // return view('admin.jenis.edit')->with('jenis', $jenis);
        return view('admin.jenis.edit')
            ->with('jenis', $jenis);        
    }

    /**
     * Update the specified Jenis in storage.
     *
     * @param  int              $id
     * @param UpdateJenisRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJenisRequest $request)
    {
        $jenis = $this->jenisRepository->findWithoutFail($id);

        if (empty($jenis)) {
            Flash::error('Jenis not found');

            return redirect(route('admin.jenis.index'));
        }

        $jenis = $this->jenisRepository->update($request->all(), $id);

        Flash::success('Jenis updated successfully.');

        return redirect(route('admin.jenis.index'));
    }

    /**
     * Remove the specified Jenis from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $jenis = $this->jenisRepository->findWithoutFail($id);

        if (empty($jenis)) {
            Flash::error('Jenis not found');

            return redirect(route('admin.jenis.index'));
        }

        $this->jenisRepository->delete($id);

        Flash::success('Jenis deleted successfully.');

        return redirect(route('admin.jenis.index'));
    }

    /**
     * Store data Jenis from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $jenis = $this->jenisRepository->create($item->toArray());
            });
        });

        Flash::success('Jenis saved successfully.');

        return redirect(route('admin.jenis.index'));
    }
}
