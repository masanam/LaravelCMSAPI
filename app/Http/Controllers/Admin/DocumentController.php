<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\DocumentDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateDocumentRequest;
use App\Http\Requests\Admin\UpdateDocumentRequest;
use App\Repositories\DocumentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy
use Str;

class DocumentController extends AppBaseController
{
    /** @var  DocumentRepository */
    private $documentRepository;

    public function __construct(DocumentRepository $documentRepo)
    {
        $this->middleware('auth');
        $this->documentRepository = $documentRepo;
    }

    /**
     * Display a listing of the Document.
     *
     * @param DocumentDataTable $documentDataTable
     * @return Response
     */
    public function index(DocumentDataTable $documentDataTable)
    {
        return $documentDataTable->render('admin.documents.index');
    }

    /**
     * Show the form for creating a new Document.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        $jenis = \App\Models\Jenis::get();
        $status = \App\Models\Status::get();
        

        // edited by dandisy
        // return view('admin.documents.create');
        return view('admin.documents.create')
            ->with('jenis', $jenis)
            ->with('status', $status);
    }

    /**
     * Store a newly created Document in storage.
     *
     * @param CreateDocumentRequest $request
     *
     * @return Response
     */
    public function store(CreateDocumentRequest $request)
    {
        $seotitle = Str::slug($request->title, '-');
        
        $request->request->add([
            'created_by' => Auth::User()->id,
            'updated_by' => Auth::User()->id,
            'seotitle' => $seotitle
        ]);
        $input = $request->all();
        $document = $this->documentRepository->create($input);

        Flash::success('Document saved successfully.');

        return redirect(route('admin.documents.index'));
    }

    /**
     * Display the specified Document.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $document = $this->documentRepository->findWithoutFail($id);

        if (empty($document)) {
            Flash::error('Document not found');

            return redirect(route('admin.documents.index'));
        }

        return view('admin.documents.show')->with('document', $document);
    }

    /**
     * Show the form for editing the specified Document.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        $jenis = \App\Models\Jenis::get();
        $status = \App\Models\Status::get();
        

        $document = $this->documentRepository->findWithoutFail($id);

        if (empty($document)) {
            Flash::error('Document not found');

            return redirect(route('admin.documents.index'));
        }

        // edited by dandisy
        // return view('admin.documents.edit')->with('document', $document);
        return view('admin.documents.edit')
            ->with('document', $document)
            ->with('jenis', $jenis)
            ->with('status', $status);        
    }

    /**
     * Update the specified Document in storage.
     *
     * @param  int              $id
     * @param UpdateDocumentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDocumentRequest $request)
    {
        $document = $this->documentRepository->findWithoutFail($id);

        if (empty($document)) {
            Flash::error('Document not found');

            return redirect(route('admin.documents.index'));
        }

        $request->request->add([
                        'updated_by' => Auth::User()->id
        ]);
        
        $document = $this->documentRepository->update($request->all(), $id);

        Flash::success('Document updated successfully.');

        return redirect(route('admin.documents.index'));
    }

    /**
     * Remove the specified Document from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $document = $this->documentRepository->findWithoutFail($id);

        if (empty($document)) {
            Flash::error('Document not found');

            return redirect(route('admin.documents.index'));
        }

        $this->documentRepository->delete($id);

        Flash::success('Document deleted successfully.');

        return redirect(route('admin.documents.index'));
    }

    /**
     * Store data Document from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $document = $this->documentRepository->create($item->toArray());
            });
        });

        Flash::success('Document saved successfully.');

        return redirect(route('admin.documents.index'));
    }
}
