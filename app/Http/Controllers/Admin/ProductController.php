<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ProductDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Repositories\ProductRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy
use Str;

class ProductController extends AppBaseController
{
    /** @var  ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->middleware('auth');
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the Product.
     *
     * @param ProductDataTable $productDataTable
     * @return Response
     */
    public function index(ProductDataTable $productDataTable)
    {
        return $productDataTable->render('admin.products.index');
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy        $type = \App\Models\Type::orderby('title','asc')->get();

        $brand = \App\Models\Brand::orderby('title','asc')->get();
        $status = \App\Models\Status::get();
        
        // edited by dandisy
        // return view('admin.products.create');
        return view('admin.products.create')
            ->with('brand', $brand)
            ->with('status', $status);
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param CreateProductRequest $request
     *
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
        $latest = $request->latest == '1' ? '1' : '0';
        $seotitle = Str::slug($request->title, '-');

        $request->request->add([
            'created_by' => Auth::User()->id,
            'updated_by' => Auth::User()->id,
            'seotitle' => $seotitle,
            'latest' => $latest
        ]);
        $input = $request->all();

        $product = $this->productRepository->create($input);

        Flash::success('Product saved successfully.');

        return redirect(route('admin.products.index'));
    }

    /**
     * Display the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('admin.products.index'));
        }

        return view('admin.products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        $brand = \App\Models\Brand::orderby('title','asc')->get();
        $status = \App\Models\Status::get();
        

        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('admin.products.index'));
        }

        // edited by dandisy
        // return view('admin.products.edit')->with('product', $product);
        return view('admin.products.edit')
            ->with('product', $product)
            ->with('brand', $brand)
            ->with('status', $status);        
    }

    /**
     * Update the specified Product in storage.
     *
     * @param  int              $id
     * @param UpdateProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('admin.products.index'));
        }

        $latest = $request->latest == '1' ? '1' : '0';

        $request->request->add([
            'updated_by' => Auth::User()->id,
            'latest' => $latest
        ]);
        
        $product = $this->productRepository->update($request->all(), $id);

        Flash::success('Product updated successfully.');

        return redirect(route('admin.products.index'));
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('admin.products.index'));
        }

        $this->productRepository->delete($id);

        Flash::success('Product deleted successfully.');

        return redirect(route('admin.products.index'));
    }

    /**
     * Store data Product from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $product = $this->productRepository->create($item->toArray());
            });
        });

        Flash::success('Product saved successfully.');

        return redirect(route('admin.products.index'));
    }
}
