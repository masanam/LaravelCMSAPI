<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ContentDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateContentRequest;
use App\Http\Requests\Admin\UpdateContentRequest;
use App\Repositories\ContentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy
use Str;

class ContentController extends AppBaseController
{
    /** @var  ContentRepository */
    private $contentRepository;

    public function __construct(ContentRepository $contentRepo)
    {
        $this->middleware('auth');
        $this->contentRepository = $contentRepo;
    }

    /**
     * Display a listing of the Content.
     *
     * @param ContentDataTable $contentDataTable
     * @return Response
     */
    public function index(ContentDataTable $contentDataTable)
    {
        return $contentDataTable->render('admin.contents.index');
    }

    /**
     * Show the form for creating a new Content.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        $category = \App\Models\Category::get();

        
        // edited by dandisy
        // return view('admin.contents.create');
        return view('admin.contents.create')
            ->with('category', $category)
            ->with('status', $status);
    }

    /**
     * Store a newly created Content in storage.
     *
     * @param CreateContentRequest $request
     *
     * @return Response
     */
    public function store(CreateContentRequest $request)
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

        $content = $this->contentRepository->create($input);

        Flash::success('Content saved successfully.');

        return redirect(route('admin.contents.index'));
    }

    /**
     * Display the specified Content.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            Flash::error('Content not found');

            return redirect(route('admin.contents.index'));
        }

        return view('admin.contents.show')->with('content', $content);
    }

    /**
     * Show the form for editing the specified Content.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        $category = \App\Models\Category::get();


        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            Flash::error('Content not found');

            return redirect(route('admin.contents.index'));
        }

        // edited by dandisy
        // return view('admin.contents.edit')->with('content', $content);
        return view('admin.contents.edit')
            ->with('content', $content)
            ->with('category', $category)
            ->with('status', $status);        
    }

    /**
     * Update the specified Content in storage.
     *
     * @param  int              $id
     * @param UpdateContentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContentRequest $request)
    {
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            Flash::error('Content not found');

            return redirect(route('admin.contents.index'));
        }

        $headline = $request->headline == '1' ? '1' : '0';
        $request->request->add([
            'updated_by' => Auth::User()->id,
            'headline' => $headline
        ]);

        $content = $this->contentRepository->update($request->all(), $id);

        Flash::success('Content updated successfully.');

        return redirect(route('admin.contents.index'));
    }

    /**
     * Remove the specified Content from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            Flash::error('Content not found');

            return redirect(route('admin.contents.index'));
        }

        $this->contentRepository->delete($id);

        Flash::success('Content deleted successfully.');

        return redirect(route('admin.contents.index'));
    }

    /**
     * Store data Content from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $content = $this->contentRepository->create($item->toArray());
            });
        });

        Flash::success('Content saved successfully.');

        return redirect(route('admin.contents.index'));
    }
}
