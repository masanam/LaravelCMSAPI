<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\HeaderDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateHeaderRequest;
use App\Http\Requests\Admin\UpdateHeaderRequest;
use App\Repositories\HeaderRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy
use Str;

class HeaderController extends AppBaseController
{
    /** @var  HeaderRepository */
    private $headerRepository;

    public function __construct(HeaderRepository $headerRepo)
    {
        $this->middleware('auth');
        $this->headerRepository = $headerRepo;
    }

    /**
     * Display a listing of the Header.
     *
     * @param HeaderDataTable $headerDataTable
     * @return Response
     */
    public function index(HeaderDataTable $headerDataTable)
    {
        return $headerDataTable->render('admin.headers.index');
    }

    /**
     * Show the form for creating a new Header.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        
        $menu = \App\Models\Menu::get();

        // edited by dandisy
        // return view('admin.headers.create');
        return view('admin.headers.create')
        ->with('menu', $menu);
    }

    /**
     * Store a newly created Header in storage.
     *
     * @param CreateHeaderRequest $request
     *
     * @return Response
     */
    public function store(CreateHeaderRequest $request)
    {
        $seotitle = Str::slug($request->title, '-');
        
        $request->request->add([
            'created_by' => Auth::User()->id,
            'updated_by' => Auth::User()->id,
            'slug' => $seotitle
        ]);
        $input = $request->all();

        $header = $this->headerRepository->create($input);

        Flash::success('Header saved successfully.');

        return redirect(route('admin.headers.index'));
    }

    /**
     * Display the specified Header.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $header = $this->headerRepository->findWithoutFail($id);

        if (empty($header)) {
            Flash::error('Header not found');

            return redirect(route('admin.headers.index'));
        }

        return view('admin.headers.show')->with('header', $header);
    }

    /**
     * Show the form for editing the specified Header.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        
        $menu = \App\Models\Menu::get();
        $header = $this->headerRepository->findWithoutFail($id);

        if (empty($header)) {
            Flash::error('Header not found');

            return redirect(route('admin.headers.index'));
        }

        // edited by dandisy
        // return view('admin.headers.edit')->with('header', $header);
        return view('admin.headers.edit')
            ->with('header', $header)
            ->with('menu', $menu);
    }

    /**
     * Update the specified Header in storage.
     *
     * @param  int              $id
     * @param UpdateHeaderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHeaderRequest $request)
    {
        $header = $this->headerRepository->findWithoutFail($id);

        if (empty($header)) {
            Flash::error('Header not found');

            return redirect(route('admin.headers.index'));
        }

        $request->request->add([
            'updated_by' => Auth::User()->id
        ]);

        $header = $this->headerRepository->update($request->all(), $id);

        Flash::success('Header updated successfully.');

        return redirect(route('admin.headers.index'));
    }

    /**
     * Remove the specified Header from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $header = $this->headerRepository->findWithoutFail($id);

        if (empty($header)) {
            Flash::error('Header not found');

            return redirect(route('admin.headers.index'));
        }

        $this->headerRepository->delete($id);

        Flash::success('Header deleted successfully.');

        return redirect(route('admin.headers.index'));
    }

    /**
     * Store data Header from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $header = $this->headerRepository->create($item->toArray());
            });
        });

        Flash::success('Header saved successfully.');

        return redirect(route('admin.headers.index'));
    }
}
