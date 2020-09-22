<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ReleaseDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateReleaseRequest;
use App\Http\Requests\Admin\UpdateReleaseRequest;
use App\Repositories\ReleaseRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy
use Str;

class ReleaseController extends AppBaseController
{
    /** @var  ReleaseRepository */
    private $releaseRepository;

    public function __construct(ReleaseRepository $releaseRepo)
    {
        $this->middleware('auth');
        $this->releaseRepository = $releaseRepo;
    }

    /**
     * Display a listing of the Release.
     *
     * @param ReleaseDataTable $releaseDataTable
     * @return Response
     */
    public function index(ReleaseDataTable $releaseDataTable)
    {
        return $releaseDataTable->render('admin.releases.index');
    }

    /**
     * Show the form for creating a new Release.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        $varian = \App\Models\Varian::get();
        
        // edited by dandisy
        // return view('admin.releases.create');
        return view('admin.releases.create')
            ->with('varian', $varian)
            ->with('status', $status);
    }

    /**
     * Store a newly created Release in storage.
     *
     * @param CreateReleaseRequest $request
     *
     * @return Response
     */
    public function store(CreateReleaseRequest $request)
    {

        $seotitle = Str::slug($request->title, '-');
        $tags = explode(",", $request->tags);
        
        $headline = $request->headline == '1' ? '1' : '0';
        $request->request->add([
            'created_by' => Auth::User()->id,
            'updated_by' => Auth::User()->id,
            'seotitle' => $seotitle,
            'headline' => $headline
        ]);
        $input = $request->all();

        $release = $this->releaseRepository->create($input);

        Flash::success('Release saved successfully.');

        return redirect(route('admin.releases.index'));
    }

    /**
     * Display the specified Release.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $release = $this->releaseRepository->findWithoutFail($id);

        if (empty($release)) {
            Flash::error('Release not found');

            return redirect(route('admin.releases.index'));
        }

        return view('admin.releases.show')->with('release', $release);
    }

    /**
     * Show the form for editing the specified Release.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        $varian = \App\Models\Varian::get();

        $release = $this->releaseRepository->findWithoutFail($id);

        if (empty($release)) {
            Flash::error('Release not found');

            return redirect(route('admin.releases.index'));
        }

        // edited by dandisy
        // return view('admin.releases.edit')->with('release', $release);
        return view('admin.releases.edit')
            ->with('varian', $varian)
            ->with('release', $release)
            ->with('status', $status);        
    }

    /**
     * Update the specified Release in storage.
     *
     * @param  int              $id
     * @param UpdateReleaseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReleaseRequest $request)
    {
        $release = $this->releaseRepository->findWithoutFail($id);

        if (empty($release)) {
            Flash::error('Release not found');

            return redirect(route('admin.releases.index'));
        }

        $headline = $request->headline == '1' ? '1' : '0';
        $request->request->add([
            'updated_by' => Auth::User()->id,
            'headline' => $headline
        ]);


        $release = $this->releaseRepository->update($request->all(), $id);

        Flash::success('Release updated successfully.');

        return redirect(route('admin.releases.index'));
    }

    /**
     * Remove the specified Release from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $release = $this->releaseRepository->findWithoutFail($id);

        if (empty($release)) {
            Flash::error('Release not found');

            return redirect(route('admin.releases.index'));
        }

        $this->releaseRepository->delete($id);

        Flash::success('Release deleted successfully.');

        return redirect(route('admin.releases.index'));
    }

    /**
     * Store data Release from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $release = $this->releaseRepository->create($item->toArray());
            });
        });

        Flash::success('Release saved successfully.');

        return redirect(route('admin.releases.index'));
    }
}
