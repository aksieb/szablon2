@extends('dashboard/template')

@section('right_box')
    <div class='row'>
        <div class='col-sm-12'>
            <nav aria-label="breadcrumb mb-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ url('/dashboard') }}>Panel</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Produkty</li>
                </ol>
            </nav>

            <a href={{ url('/dashboard/product') }} class='btn btn-primary mb-3'>Dodaj</a>

            @if(session('success'))
                <div class="alert alert-success mb-3">
                    {{ session('success_msg') }}
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Kategoria</th>
                        <th scope="col">Dostępna ilość</th>
                        <th scope="col">Akcje</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <th scope="row">{{ $product->id }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                                <a
                                    href={{ url('/dashboard/product/' . $product->id) }}
                                    class='btn btn-primary'
                                >Edytuj</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th scope='row' colspan='5' class='text-center'>Brak rekordów</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $products->appends(array(

            ))->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
