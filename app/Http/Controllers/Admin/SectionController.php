<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SectionDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateSectionRequest;
use App\Http\Requests\Admin\UpdateSectionRequest;
use App\Repositories\SectionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy
use Str;

class SectionController extends AppBaseController
{
    /** @var  SectionRepository */
    private $sectionRepository;

    public function __construct(SectionRepository $sectionRepo)
    {
        $this->middleware('auth');
        $this->sectionRepository = $sectionRepo;
    }

    /**
     * Display a listing of the Section.
     *
     * @param SectionDataTable $sectionDataTable
     * @return Response
     */
    public function index(SectionDataTable $sectionDataTable)
    {
        return $sectionDataTable->render('admin.sections.index');
    }

    /**
     * Show the form for creating a new Section.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        
        $type = \App\Models\Part::get();

        // edited by dandisy
        // return view('admin.sections.create');
        return view('admin.sections.create')
        ->with('type', $type);
    }

    /**
     * Store a newly created Section in storage.
     *
     * @param CreateSectionRequest $request
     *
     * @return Response
     */
    public function store(CreateSectionRequest $request)
    {
        $seotitle = Str::slug($request->title, '-');

        $request->request->add([
            'created_by' => Auth::User()->id,
            'updated_by' => Auth::User()->id,
            'slug' => $seotitle
        ]);
        $input = $request->all();

        $section = $this->sectionRepository->create($input);

        Flash::success('Section saved successfully.');

        return redirect(route('admin.sections.index'));
    }

    /**
     * Display the specified Section.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $section = $this->sectionRepository->findWithoutFail($id);

        if (empty($section)) {
            Flash::error('Section not found');

            return redirect(route('admin.sections.index'));
        }

        return view('admin.sections.show')->with('section', $section);
    }

    /**
     * Show the form for editing the specified Section.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        
        $type = \App\Models\Part::get();
        $section = $this->sectionRepository->findWithoutFail($id);

        if (empty($section)) {
            Flash::error('Section not found');

            return redirect(route('admin.sections.index'));
        }

        // edited by dandisy
        // return view('admin.sections.edit')->with('section', $section);
        return view('admin.sections.edit')
            ->with('section', $section)
            ->with('type', $type);
        }

    /**
     * Update the specified Section in storage.
     *
     * @param  int              $id
     * @param UpdateSectionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSectionRequest $request)
    {
        $section = $this->sectionRepository->findWithoutFail($id);

        if (empty($section)) {
            Flash::error('Section not found');

            return redirect(route('admin.sections.index'));
        }

        $request->request->add([
            'updated_by' => Auth::User()->id
        ]);

        $section = $this->sectionRepository->update($request->all(), $id);

        Flash::success('Section updated successfully.');

        return redirect(route('admin.sections.index'));
    }

    /**
     * Remove the specified Section from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $section = $this->sectionRepository->findWithoutFail($id);

        if (empty($section)) {
            Flash::error('Section not found');

            return redirect(route('admin.sections.index'));
        }

        $this->sectionRepository->delete($id);

        Flash::success('Section deleted successfully.');

        return redirect(route('admin.sections.index'));
    }

    /**
     * Store data Section from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $section = $this->sectionRepository->create($item->toArray());
            });
        });

        Flash::success('Section saved successfully.');

        return redirect(route('admin.sections.index'));
    }
}
