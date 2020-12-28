<?php

namespace App\Http\Controllers;

use App\Contants\Main;
use App\Repositories\AttributeRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\FileRepository;
use App\Repositories\ProductRepository;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(
        Request $request,
        ProductRepository $productRepository
    ) {
        $categoryId = $request->input('category_id');

        if ($categoryId) {
            $products = $productRepository->getAllPaginated(true, $categoryId);
        } else {
            $products = $productRepository->getAllPaginated();
        }

        return view('dashboard.products.index', array(
            'products'  => $products
        ));
    }

    public function create(
        Request $request,
        CategoryRepository $categoryRepository,
        AttributeRepository $attributeRepository
    ) {
        $categories = $categoryRepository->getByCategoryId();
        $categoryId = $request->input('category_id');

        return view('dashboard.products.form', array(
            'categoryId'    => $categoryId,
            'categories'    => $categories,
            'units'         => Main::UNITS,
            'attributes'    => $attributeRepository->getAll()
        ));
    }

    public function show(
        $id,
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        AttributeRepository $attributeRepository
    ) {
        $product = $productRepository->find($id);
        $categories = $categoryRepository->getByCategoryId();

        return view('dashboard.products.form', array(
            'categoryId'    => null,
            'product'       => $product,
            'categories'    => $categories,
            'units'         => Main::UNITS,
            'attributes'    => $attributeRepository->getAll()
        ));
    }

    public function store(
        $id = null,
        Request $request,
        ProductRepository $productRepository,
        FileRepository $fileRepository
    ) {
        $request->validate(array(
            'name'          => 'required|max:255',
            'description'   => 'required',
            'quantity'      => 'required',
            'category_id'   => 'required',
            'unit'          => 'required'
        ));

        $data = array(
            'name'          => $request->input('name'),
            'description'   => $request->input('description'),
            'quantity'      => $request->input('quantity'),
            'unit'          => $request->input('unit'),
            'category_id'   => $request->input('category_id')
        );

        session()->flash('success', true);

        if ($id) {
            $productRepository->update($data, $id);
            session()->flash('success_msg', 'Rekord zaktualizowany!');
        } else {
            $id = $productRepository->create($data)->id;
            session()->flash('success_msg', 'Rekord dodany!');
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('files');

                $fileRepository->create(array(
                    'filename'              => $path,
                    'filename_original'     => $file->getClientOriginalName(),
                    'extension'             => $file->extension(),
                    'mime'                  => $file->getClientMimeType(),
                    'size'                  => $file->getSize(),
                    'md5'                   => md5_file($file->getRealPath()),
                    'relation'              => 'products',
                    'foreign_id'            => $id
                ));
            }
        }

        $attributeIds = $request->input('keys');
        $attributeValues = $request->input('values');
        $product = $productRepository->find($id);
        $sync = array();

        foreach ($attributeIds as $key => $attributeId) {
            $sync[$attributeId] = array(
                'value'         => $attributeValues[$key]
            );
        }

        $product->attributes()->sync($sync);

        return redirect('/dashboard/products');
    }
}
