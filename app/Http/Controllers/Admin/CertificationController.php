<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CertificationDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateCertificationRequest;
use App\Http\Requests\Admin\UpdateCertificationRequest;
use App\Repositories\CertificationRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy
use Str;

class CertificationController extends AppBaseController
{
    /** @var  CertificationRepository */
    private $certificationRepository;

    public function __construct(CertificationRepository $certificationRepo)
    {
        $this->middleware('auth');
        $this->certificationRepository = $certificationRepo;
    }

    /**
     * Display a listing of the Certification.
     *
     * @param CertificationDataTable $certificationDataTable
     * @return Response
     */
    public function index(CertificationDataTable $certificationDataTable)
    {
        return $certificationDataTable->render('admin.certifications.index');
    }

    /**
     * Show the form for creating a new Certification.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        // edited by dandisy
        // return view('admin.certifications.create');
        return view('admin.certifications.create')
            ->with('status', $status);
    }

    /**
     * Store a newly created Certification in storage.
     *
     * @param CreateCertificationRequest $request
     *
     * @return Response
     */
    public function store(CreateCertificationRequest $request)
    {
        $seotitle = Str::slug($request->title, '-');
        
        $request->request->add([
            'created_by' => Auth::User()->id,
            'updated_by' => Auth::User()->id,
            'seotitle' => $seotitle
        ]);
        $input = $request->all();
        $certification = $this->certificationRepository->create($input);

        Flash::success('Certification saved successfully.');

        return redirect(route('admin.certifications.index'));
    }

    /**
     * Display the specified Certification.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $certification = $this->certificationRepository->findWithoutFail($id);

        if (empty($certification)) {
            Flash::error('Certification not found');

            return redirect(route('admin.certifications.index'));
        }

        return view('admin.certifications.show')->with('certification', $certification);
    }

    /**
     * Show the form for editing the specified Certification.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        $certification = $this->certificationRepository->findWithoutFail($id);

        if (empty($certification)) {
            Flash::error('Certification not found');

            return redirect(route('admin.certifications.index'));
        }

        // edited by dandisy
        // return view('admin.certifications.edit')->with('certification', $certification);
        return view('admin.certifications.edit')
            ->with('certification', $certification)
            ->with('status', $status);        
    }

    /**
     * Update the specified Certification in storage.
     *
     * @param  int              $id
     * @param UpdateCertificationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCertificationRequest $request)
    {
        $certification = $this->certificationRepository->findWithoutFail($id);

        if (empty($certification)) {
            Flash::error('Certification not found');

            return redirect(route('admin.certifications.index'));
        }

        $request->request->add([
                        'updated_by' => Auth::User()->id
        ]);

        $certification = $this->certificationRepository->update($request->all(), $id);

        Flash::success('Certification updated successfully.');

        return redirect(route('admin.certifications.index'));
    }

    /**
     * Remove the specified Certification from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $certification = $this->certificationRepository->findWithoutFail($id);

        if (empty($certification)) {
            Flash::error('Certification not found');

            return redirect(route('admin.certifications.index'));
        }

        $this->certificationRepository->delete($id);

        Flash::success('Certification deleted successfully.');

        return redirect(route('admin.certifications.index'));
    }

    /**
     * Store data Certification from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $certification = $this->certificationRepository->create($item->toArray());
            });
        });

        Flash::success('Certification saved successfully.');

        return redirect(route('admin.certifications.index'));
    }
}
