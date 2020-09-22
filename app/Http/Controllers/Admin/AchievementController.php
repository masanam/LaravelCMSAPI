<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AchievementDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateAchievementRequest;
use App\Http\Requests\Admin\UpdateAchievementRequest;
use App\Repositories\AchievementRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy
use Str;

class AchievementController extends AppBaseController
{
    /** @var  AchievementRepository */
    private $achievementRepository;

    public function __construct(AchievementRepository $achievementRepo)
    {
        $this->middleware('auth');
        $this->achievementRepository = $achievementRepo;
    }

    /**
     * Display a listing of the Achievement.
     *
     * @param AchievementDataTable $achievementDataTable
     * @return Response
     */
    public function index(AchievementDataTable $achievementDataTable)
    {
        return $achievementDataTable->render('admin.achievements.index');
    }

    /**
     * Show the form for creating a new Achievement.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        // edited by dandisy
        // return view('admin.achievements.create');
        return view('admin.achievements.create')
            ->with('status', $status);
    }

    /**
     * Store a newly created Achievement in storage.
     *
     * @param CreateAchievementRequest $request
     *
     * @return Response
     */
    public function store(CreateAchievementRequest $request)
    {
        $seotitle = Str::slug($request->title, '-');
        
        $request->request->add([
            'created_by' => Auth::User()->id,
            'updated_by' => Auth::User()->id,
            'seotitle' => $seotitle
        ]);
        $input = $request->all();
        $achievement = $this->achievementRepository->create($input);

        Flash::success('Achievement saved successfully.');

        return redirect(route('admin.achievements.index'));
    }

    /**
     * Display the specified Achievement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $achievement = $this->achievementRepository->findWithoutFail($id);

        if (empty($achievement)) {
            Flash::error('Achievement not found');

            return redirect(route('admin.achievements.index'));
        }

        return view('admin.achievements.show')->with('achievement', $achievement);
    }

    /**
     * Show the form for editing the specified Achievement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        $achievement = $this->achievementRepository->findWithoutFail($id);

        if (empty($achievement)) {
            Flash::error('Achievement not found');

            return redirect(route('admin.achievements.index'));
        }

        // edited by dandisy
        // return view('admin.achievements.edit')->with('achievement', $achievement);
        return view('admin.achievements.edit')
            ->with('achievement', $achievement)
            ->with('status', $status);        
    }

    /**
     * Update the specified Achievement in storage.
     *
     * @param  int              $id
     * @param UpdateAchievementRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAchievementRequest $request)
    {
        $achievement = $this->achievementRepository->findWithoutFail($id);

        if (empty($achievement)) {
            Flash::error('Achievement not found');

            return redirect(route('admin.achievements.index'));
        }
        $request->request->add([
            'updated_by' => Auth::User()->id
        ]);
        $achievement = $this->achievementRepository->update($request->all(), $id);

        Flash::success('Achievement updated successfully.');

        return redirect(route('admin.achievements.index'));
    }

    /**
     * Remove the specified Achievement from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $achievement = $this->achievementRepository->findWithoutFail($id);

        if (empty($achievement)) {
            Flash::error('Achievement not found');

            return redirect(route('admin.achievements.index'));
        }

        $this->achievementRepository->delete($id);

        Flash::success('Achievement deleted successfully.');

        return redirect(route('admin.achievements.index'));
    }

    /**
     * Store data Achievement from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $achievement = $this->achievementRepository->create($item->toArray());
            });
        });

        Flash::success('Achievement saved successfully.');

        return redirect(route('admin.achievements.index'));
    }
}
