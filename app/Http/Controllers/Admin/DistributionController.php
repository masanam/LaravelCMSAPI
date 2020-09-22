<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\DistributionDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateDistributionRequest;
use App\Http\Requests\Admin\UpdateDistributionRequest;
use App\Repositories\DistributionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class DistributionController extends AppBaseController
{
    /** @var  DistributionRepository */
    private $distributionRepository;

    public function __construct(DistributionRepository $distributionRepo)
    {
        $this->middleware('auth');
        $this->distributionRepository = $distributionRepo;
    }

    /**
     * Display a listing of the Distribution.
     *
     * @param DistributionDataTable $distributionDataTable
     * @return Response
     */
    public function index(DistributionDataTable $distributionDataTable)
    {
        return $distributionDataTable->render('admin.distributions.index');
    }

    /**
     * Show the form for creating a new Distribution.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('admin.distributions.create');
        return view('admin.distributions.create');
    }

    /**
     * Store a newly created Distribution in storage.
     *
     * @param CreateDistributionRequest $request
     *
     * @return Response
     */
    public function store(CreateDistributionRequest $request)
    {
        $input = $request->all();

        $distribution = $this->distributionRepository->create($input);

        Flash::success('Distribution saved successfully.');

        return redirect(route('admin.distributions.index'));
    }

    /**
     * Display the specified Distribution.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $distribution = $this->distributionRepository->findWithoutFail($id);

        if (empty($distribution)) {
            Flash::error('Distribution not found');

            return redirect(route('admin.distributions.index'));
        }

        return view('admin.distributions.show')->with('distribution', $distribution);
    }

    /**
     * Show the form for editing the specified Distribution.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $distribution = $this->distributionRepository->findWithoutFail($id);

        if (empty($distribution)) {
            Flash::error('Distribution not found');

            return redirect(route('admin.distributions.index'));
        }

        // edited by dandisy
        // return view('admin.distributions.edit')->with('distribution', $distribution);
        return view('admin.distributions.edit')
            ->with('distribution', $distribution);        
    }

    /**
     * Update the specified Distribution in storage.
     *
     * @param  int              $id
     * @param UpdateDistributionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDistributionRequest $request)
    {
        $distribution = $this->distributionRepository->findWithoutFail($id);

        if (empty($distribution)) {
            Flash::error('Distribution not found');

            return redirect(route('admin.distributions.index'));
        }

        $distribution = $this->distributionRepository->update($request->all(), $id);

        Flash::success('Distribution updated successfully.');

        return redirect(route('admin.distributions.index'));
    }

    /**
     * Remove the specified Distribution from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $distribution = $this->distributionRepository->findWithoutFail($id);

        if (empty($distribution)) {
            Flash::error('Distribution not found');

            return redirect(route('admin.distributions.index'));
        }

        $this->distributionRepository->delete($id);

        Flash::success('Distribution deleted successfully.');

        return redirect(route('admin.distributions.index'));
    }

    /**
     * Store data Distribution from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $distribution = $this->distributionRepository->create($item->toArray());
            });
        });

        Flash::success('Distribution saved successfully.');

        return redirect(route('admin.distributions.index'));
    }
}
