<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SliderDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateSliderRequest;
use App\Http\Requests\Admin\UpdateSliderRequest;
use App\Repositories\SliderRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class SliderController extends AppBaseController
{
    /** @var  SliderRepository */
    private $sliderRepository;

    public function __construct(SliderRepository $sliderRepo)
    {
        $this->middleware('auth');
        $this->sliderRepository = $sliderRepo;
    }

    /**
     * Display a listing of the Slider.
     *
     * @param SliderDataTable $sliderDataTable
     * @return Response
     */
    public function index(SliderDataTable $sliderDataTable)
    {
        return $sliderDataTable->render('admin.sliders.index');
    }

    /**
     * Show the form for creating a new Slider.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        // edited by dandisy
        // return view('admin.sliders.create');
        return view('admin.sliders.create')
            ->with('status', $status);
    }

    /**
     * Store a newly created Slider in storage.
     *
     * @param CreateSliderRequest $request
     *
     * @return Response
     */
    public function store(CreateSliderRequest $request)
    {
        $input = $request->all();

        $slider = $this->sliderRepository->create($input);

        Flash::success('Slider saved successfully.');

        return redirect(route('admin.sliders.index'));
    }

    /**
     * Display the specified Slider.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $slider = $this->sliderRepository->findWithoutFail($id);

        if (empty($slider)) {
            Flash::error('Slider not found');

            return redirect(route('admin.sliders.index'));
        }

        return view('admin.sliders.show')->with('slider', $slider);
    }

    /**
     * Show the form for editing the specified Slider.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        $status = \App\Models\Status::get();
        

        $slider = $this->sliderRepository->findWithoutFail($id);

        if (empty($slider)) {
            Flash::error('Slider not found');

            return redirect(route('admin.sliders.index'));
        }

        // edited by dandisy
        // return view('admin.sliders.edit')->with('slider', $slider);
        return view('admin.sliders.edit')
            ->with('slider', $slider)
            ->with('status', $status);        
    }

    /**
     * Update the specified Slider in storage.
     *
     * @param  int              $id
     * @param UpdateSliderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSliderRequest $request)
    {
        $slider = $this->sliderRepository->findWithoutFail($id);

        if (empty($slider)) {
            Flash::error('Slider not found');

            return redirect(route('admin.sliders.index'));
        }

        $slider = $this->sliderRepository->update($request->all(), $id);

        Flash::success('Slider updated successfully.');

        return redirect(route('admin.sliders.index'));
    }

    /**
     * Remove the specified Slider from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $slider = $this->sliderRepository->findWithoutFail($id);

        if (empty($slider)) {
            Flash::error('Slider not found');

            return redirect(route('admin.sliders.index'));
        }

        $this->sliderRepository->delete($id);

        Flash::success('Slider deleted successfully.');

        return redirect(route('admin.sliders.index'));
    }

    /**
     * Store data Slider from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $slider = $this->sliderRepository->create($item->toArray());
            });
        });

        Flash::success('Slider saved successfully.');

        return redirect(route('admin.sliders.index'));
    }
}
