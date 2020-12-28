@extends('dashboard/template')

@section('right_box')
    <div class='row'>
        <div class='col-sm-12'>
            <nav aria-label="breadcrumb mb-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ url('/dashboard') }}>Panel</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href={{ url('/dashboard/attributes') }}>Atrybuty</a>
                    </li>

                    @isset($attribute)
                        <li class="breadcrumb-item active" aria-current="page">{{ $attribute->id }}</li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">Dodaj</li>
                    @endisset
                </ol>
            </nav>

            @if ($errors->any())
                <div class="alert alert-danger mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class='mt-4' method='post'>
                @csrf

                <div class='row'>
                    <div class='col-sm-6'>
                        <div class='form-group'>
                            <label for='name'>Klucz</label>
                            <input type='text' id='key' name='key' required='required' class='form-control'
                                value="{{ isset($attribute) ? $attribute->key : '' }}" />
                        </div>
                    </div>

                    <div class='col-sm-6'>
                        <div class='form-group'>
                            <label for='name'>Nazwa</label>
                            <input type='text' id='name' name='name' required='required' class='form-control'
                                value="{{ isset($attribute) ? $attribute->name : '' }}" />
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-sm-6'>
                        <div class='form-group'>
                            <label for='name'>Jednostka</label>
                            <select id='unit' name='unit' required='required' class='form-control'>
                                @foreach ($units as $key => $unit)
                                    <option value={{ $key }}>{{ $unit }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-center">
                    @isset($attribute)
                        <a href={{ url('/dashboard/attribute-products/' . $attribute->id) }}
                            class='btn btn-primary ml-1'>Produkty</a>
                    @endisset

                    <button class="btn btn-primary @isset($attribute) ml-1 @endisset" type="submit">Zapisz</button>

                    @isset($attribute)
                        <a href={{ url('/dashboard/attribute/' . $attribute->id . '/delete') }}
                            class='btn btn-danger ml-1 record-delete'>Usuń</a>
                    @endisset
                </div>
            </form>
        </div>
    </div>
@endsection
