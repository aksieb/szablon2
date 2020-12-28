@extends('dashboard/template')

@section('right_box')
    <div class='row'>
        <div class='col-sm-12'>
            <nav aria-label="breadcrumb mb-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ url('/dashboard') }}>Panel</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href={{ url('/dashboard/categories') }}>Kategorie</a>
                    </li>

                    @isset($categoryId)
                        <li class="breadcrumb-item" aria-current="page"><a
                                href={{ url('/dashboard/categories/' . $categoryId) }}>{{ $categoryId }}</a></li>
                    @endisset

                    @isset($category)
                        <li class="breadcrumb-item active" aria-current="page">{{ $category->id }}</li>
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
                            <label for='name'>Nazwa kategorii</label>
                            <input type='text' id='name' name='name' required='required' class='form-control'
                                value="{{ isset($category) ? $category->name : '' }}" />
                        </div>

                        <div class='form-group'>
                            <label for='description'>Opis kategorii</label>
                            <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                        </div>
                    </div>

                    <div class='col-sm-6'>
                        <div class='form-group'>
                            <label for='name'>Kategoria nadrzędna</label>
                            <select id='category_id' name='category_id' class='form-control'>
                                <option value="">Wybierz</option>
                                @foreach ($categories as $catm)
                                    <option value={{ $catm->id }}
                                        {{ isset($category) && $category->category_id == $catm->id ? "selected='selected'" : '' }}>
                                        {{ $catm->name }}
                                    </option>
                                    @foreach ($catm->categories as $cat)
                                        <option value={{ $cat->id }}
                                            {{ isset($category) && $category->category_id == $cat->id ? "selected='selected'" : '' }}>
                                            &nbsp;&nbsp;&nbsp;&nbsp;{{ $cat->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-center">
                    @isset($category)
                        <a href={{ url('/dashboard/category-products/' . $category->id) }}
                            class='btn btn-primary ml-1'>Produkty</a>
                    @endisset

                    <button class="btn btn-primary @isset($category) ml-1 @endisset" type="submit">Zapisz</button>

                    @isset($category)
                        <a href={{ url('/dashboard/category/' . $category->id . '/delete') }}
                            class='btn btn-danger ml-1 record-delete'>Usuń</a>
                    @endisset
                </div>
            </form>
        </div>
    </div>
@endsection
