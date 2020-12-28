<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(
        $id = null,
        CategoryRepository $categoryRepository
    ) {
        $categories = $categoryRepository->getAllPaginated($id);

        return view('dashboard.categories.index', array(
            'id'            => $id,
            'categories'    => $categories
        ));
    }

    public function create(
        Request $request,
        CategoryRepository $categoryRepository
    ) {
        $categories = $categoryRepository->getByCategoryId();

        return view('dashboard.categories.form', array(
            'categories'    => $categories,
            'categoryId'    => $request->input('category_id')
        ));
    }
    public function show(
        $id,
        CategoryRepository $categoryRepository
    ) {
        $categories = $categoryRepository->getByCategoryId();
        $category = $categoryRepository->find($id);

        return view('dashboard.categories.form', array(
            'categories'    => $categories,
            'category'      => $category,
            'categoryId'    => $category->category_id
        ));
    }

    public function delete(
        $id,
        CategoryRepository $categoryRepository
    ) {
        $category = $categoryRepository->find($id);
        $category->delete();

        session()->flash('success', true);
        session()->flash('success_msg', 'Rekord usunięty!');

        return redirect('/dashboard/categories');
    }

    public function store(
        $id = null,
        Request $request,
        CategoryRepository $categoryRepository
    ) {
        $request->validate(array(
            'name'              => 'required|max:255',
            'description'       => 'max:2000'
        ));

        session()->flash('success', true);

        $data = array(
            'name'          => $request->input('name'),
            'description'   => $request->input('description'),
            'category_id'   => $request->input('category_id')
        );

        if ($id) {
            $categoryRepository->update($data, $id);

            session()->flash('success_msg', 'Rekord zaktualizowany!');
        } else {
            $categoryRepository->create($data);

            session()->flash('success_msg', 'Rekord dodany!');
        }

        return redirect('/dashboard/categories');
    }
}
