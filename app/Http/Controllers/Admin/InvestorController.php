<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\InvestorDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateInvestorRequest;
use App\Http\Requests\Admin\UpdateInvestorRequest;
use App\Repositories\InvestorRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class InvestorController extends AppBaseController
{
    /** @var  InvestorRepository */
    private $investorRepository;

    public function __construct(InvestorRepository $investorRepo)
    {
        $this->middleware('auth');
        $this->investorRepository = $investorRepo;
    }

    /**
     * Display a listing of the Investor.
     *
     * @param InvestorDataTable $investorDataTable
     * @return Response
     */
    public function index(InvestorDataTable $investorDataTable)
    {
        return $investorDataTable->render('admin.investors.index');
    }

    /**
     * Show the form for creating a new Investor.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        
        $status = \App\Models\Status::get();

        // edited by dandisy
        // return view('admin.investors.create');
        return view('admin.investors.create')
        ->with('status', $status);
    }

    /**
     * Store a newly created Investor in storage.
     *
     * @param CreateInvestorRequest $request
     *
     * @return Response
     */
    public function store(CreateInvestorRequest $request)
    {
        $input = $request->all();

        $investor = $this->investorRepository->create($input);

        Flash::success('Investor saved successfully.');

        return redirect(route('admin.investors.index'));
    }

    /**
     * Display the specified Investor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $investor = $this->investorRepository->findWithoutFail($id);

        if (empty($investor)) {
            Flash::error('Investor not found');

            return redirect(route('admin.investors.index'));
        }

        return view('admin.investors.show')->with('investor', $investor);
    }

    /**
     * Show the form for editing the specified Investor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $investor = $this->investorRepository->findWithoutFail($id);
        $status = \App\Models\Status::get();

        if (empty($investor)) {
            Flash::error('Investor not found');

            return redirect(route('admin.investors.index'));
        }

        // edited by dandisy
        // return view('admin.investors.edit')->with('investor', $investor);
        return view('admin.investors.edit')
        ->with('status', $status)
            ->with('investor', $investor);        
    }

    /**
     * Update the specified Investor in storage.
     *
     * @param  int              $id
     * @param UpdateInvestorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInvestorRequest $request)
    {
        $investor = $this->investorRepository->findWithoutFail($id);

        if (empty($investor)) {
            Flash::error('Investor not found');

            return redirect(route('admin.investors.index'));
        }

        $investor = $this->investorRepository->update($request->all(), $id);

        Flash::success('Investor updated successfully.');

        return redirect(route('admin.investors.index'));
    }

    /**
     * Remove the specified Investor from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $investor = $this->investorRepository->findWithoutFail($id);

        if (empty($investor)) {
            Flash::error('Investor not found');

            return redirect(route('admin.investors.index'));
        }

        $this->investorRepository->delete($id);

        Flash::success('Investor deleted successfully.');

        return redirect(route('admin.investors.index'));
    }

    /**
     * Store data Investor from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $investor = $this->investorRepository->create($item->toArray());
            });
        });

        Flash::success('Investor saved successfully.');

        return redirect(route('admin.investors.index'));
    }
}
