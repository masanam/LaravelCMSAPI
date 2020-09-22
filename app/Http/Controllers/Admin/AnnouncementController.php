<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AnnouncementDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateAnnouncementRequest;
use App\Http\Requests\Admin\UpdateAnnouncementRequest;
use App\Repositories\AnnouncementRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy
use Str;

class AnnouncementController extends AppBaseController
{
    /** @var  AnnouncementRepository */
    private $announcementRepository;

    public function __construct(AnnouncementRepository $announcementRepo)
    {
        $this->middleware('auth');
        $this->announcementRepository = $announcementRepo;
    }

    /**
     * Display a listing of the Announcement.
     *
     * @param AnnouncementDataTable $announcementDataTable
     * @return Response
     */
    public function index(AnnouncementDataTable $announcementDataTable)
    {
        return $announcementDataTable->render('admin.announcements.index');
    }

    /**
     * Show the form for creating a new Announcement.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        // edited by dandisy
        // return view('admin.announcements.create');
        return view('admin.announcements.create')
            ->with('status', $status);
    }

    /**
     * Store a newly created Announcement in storage.
     *
     * @param CreateAnnouncementRequest $request
     *
     * @return Response
     */
    public function store(CreateAnnouncementRequest $request)
    {

        $seotitle = Str::slug($request->title, '-');
        
        $request->request->add([
            'created_by' => Auth::User()->id,
            'updated_by' => Auth::User()->id,
            'seotitle' => $seotitle
        ]);
        $input = $request->all();

        $announcement = $this->announcementRepository->create($input);

        Flash::success('Announcement saved successfully.');

        return redirect(route('admin.announcements.index'));
    }

    /**
     * Display the specified Announcement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $announcement = $this->announcementRepository->findWithoutFail($id);

        if (empty($announcement)) {
            Flash::error('Announcement not found');

            return redirect(route('admin.announcements.index'));
        }

        return view('admin.announcements.show')->with('announcement', $announcement);
    }

    /**
     * Show the form for editing the specified Announcement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        $announcement = $this->announcementRepository->findWithoutFail($id);

        if (empty($announcement)) {
            Flash::error('Announcement not found');

            return redirect(route('admin.announcements.index'));
        }

        // edited by dandisy
        // return view('admin.announcements.edit')->with('announcement', $announcement);
        return view('admin.announcements.edit')
            ->with('announcement', $announcement)
            ->with('status', $status);        
    }

    /**
     * Update the specified Announcement in storage.
     *
     * @param  int              $id
     * @param UpdateAnnouncementRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAnnouncementRequest $request)
    {
        $announcement = $this->announcementRepository->findWithoutFail($id);

        if (empty($announcement)) {
            Flash::error('Announcement not found');

            return redirect(route('admin.announcements.index'));
        }

        $request->request->add([
            'updated_by' => Auth::User()->id
        ]);

        $announcement = $this->announcementRepository->update($request->all(), $id);

        Flash::success('Announcement updated successfully.');

        return redirect(route('admin.announcements.index'));
    }

    /**
     * Remove the specified Announcement from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $announcement = $this->announcementRepository->findWithoutFail($id);

        if (empty($announcement)) {
            Flash::error('Announcement not found');

            return redirect(route('admin.announcements.index'));
        }

        $this->announcementRepository->delete($id);

        Flash::success('Announcement deleted successfully.');

        return redirect(route('admin.announcements.index'));
    }

    /**
     * Store data Announcement from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $announcement = $this->announcementRepository->create($item->toArray());
            });
        });

        Flash::success('Announcement saved successfully.');

        return redirect(route('admin.announcements.index'));
    }
}
