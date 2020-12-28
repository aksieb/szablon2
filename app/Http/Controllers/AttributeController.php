<?php

namespace App\Http\Controllers;

use App\Contants\Main;
use App\Repositories\AttributeRepository;

use Illuminate\Http\Request;

class AttributeController extends Controller
{

    public function index(
        AttributeRepository $attributeRepository
    ) {
        $attributes = $attributeRepository->getAllPaginated();

        return view('dashboard.attributes.index', array(
            'attributes'  => $attributes,
            'units'       => Main::UNITS
        ));
    }

    public function create()
    {
        return view('dashboard.attributes.form', array(
            'units'    => Main::UNITS
        ));
    }

    public function show(
        $id,
        AttributeRepository $attributeRepository
    ) {
        $attribute = $attributeRepository->find($id);

        return view('dashboard.attributes.form', array(
            'attribute'     => $attribute,
            'units'         => Main::UNITS
        ));
    }

    public function store(
        $id = null,
        Request $request,
        AttributeRepository $attributeRepository
    ) {
        $request->validate(array(
            'key'   => 'required|max:255|unique:attributes',
            'name'  => 'required|max:255',
            'unit'  => 'required'
        ));

        $data = array(
            'name'  => $request->input('name'),
            'key'   => $request->input('key'),
            'unit'  => $request->input('unit'),
        );

        session()->flash('success', true);

        if ($id) {
            $attributeRepository->update($data, $id);
            session()->flash('success_msg', 'Rekord zaktualizowany!');
        } else {
            $attributeRepository->create($data);
            session()->flash('success_msg', 'Rekord dodany!');
        }

        return redirect('/dashboard/attributes');
    }
}
