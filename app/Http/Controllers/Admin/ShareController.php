<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ShareDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateShareRequest;
use App\Http\Requests\Admin\UpdateShareRequest;
use App\Repositories\ShareRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class ShareController extends AppBaseController
{
    /** @var  ShareRepository */
    private $shareRepository;

    public function __construct(ShareRepository $shareRepo)
    {
        $this->middleware('auth');
        $this->shareRepository = $shareRepo;
    }

    /**
     * Display a listing of the Share.
     *
     * @param ShareDataTable $shareDataTable
     * @return Response
     */
    public function index(ShareDataTable $shareDataTable)
    {
        return $shareDataTable->render('admin.shares.index');
    }

    /**
     * Show the form for creating a new Share.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        // edited by dandisy
        // return view('admin.shares.create');
        return view('admin.shares.create')
            ->with('status', $status);
    }

    /**
     * Store a newly created Share in storage.
     *
     * @param CreateShareRequest $request
     *
     * @return Response
     */
    public function store(CreateShareRequest $request)
    {
        $input = $request->all();

        $share = $this->shareRepository->create($input);

        Flash::success('Share saved successfully.');

        return redirect(route('admin.shares.index'));
    }

    /**
     * Display the specified Share.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $share = $this->shareRepository->findWithoutFail($id);

        if (empty($share)) {
            Flash::error('Share not found');

            return redirect(route('admin.shares.index'));
        }

        return view('admin.shares.show')->with('share', $share);
    }

    /**
     * Show the form for editing the specified Share.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        $share = $this->shareRepository->findWithoutFail($id);

        if (empty($share)) {
            Flash::error('Share not found');

            return redirect(route('admin.shares.index'));
        }

        // edited by dandisy
        // return view('admin.shares.edit')->with('share', $share);
        return view('admin.shares.edit')
            ->with('share', $share)
            ->with('status', $status);        
    }

    /**
     * Update the specified Share in storage.
     *
     * @param  int              $id
     * @param UpdateShareRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateShareRequest $request)
    {
        $share = $this->shareRepository->findWithoutFail($id);

        if (empty($share)) {
            Flash::error('Share not found');

            return redirect(route('admin.shares.index'));
        }

        $share = $this->shareRepository->update($request->all(), $id);

        Flash::success('Share updated successfully.');

        return redirect(route('admin.shares.index'));
    }

    /**
     * Remove the specified Share from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $share = $this->shareRepository->findWithoutFail($id);

        if (empty($share)) {
            Flash::error('Share not found');

            return redirect(route('admin.shares.index'));
        }

        $this->shareRepository->delete($id);

        Flash::success('Share deleted successfully.');

        return redirect(route('admin.shares.index'));
    }

    /**
     * Store data Share from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $share = $this->shareRepository->create($item->toArray());
            });
        });

        Flash::success('Share saved successfully.');

        return redirect(route('admin.shares.index'));
    }
}
