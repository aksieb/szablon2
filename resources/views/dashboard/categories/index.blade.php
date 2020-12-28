@extends('dashboard/template')

@section('right_box')
    <div class='row'>
        <div class='col-sm-12'>
            <nav aria-label="breadcrumb mb-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ url('/dashboard') }}>Panel</a></li>
                    @isset($id)
                        <li class="breadcrumb-item" aria-current="page"><a href={{ url('/dashboard/categories') }}>Kategorie</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $id }}</li>
                    @else
                        <li class="breadcrumb-item active">Kategorie</li>
                    @endisset
                </ol>
            </nav>

            @isset($id)
                <a href={{ url('/dashboard/category?category_id=' . $id) }} class='btn btn-primary mb-3'>Dodaj</a>
            @else
                <a href={{ url('/dashboard/category') }} class='btn btn-primary mb-3'>Dodaj</a>
            @endisset

            @if (session('success'))
                <div class="alert alert-success mb-3">
                    {{ session('success_msg') }}
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Akcje</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href={{ url('/dashboard/category/' . $category->id) }} class='btn btn-primary'>Edytuj</a>

                            @empty($id)
                                <a href={{ url('/dashboard/categories/' . $category->id) }}
                                    class='btn btn-primary'>Podkategorie</a>
                            @endempty

                            <a href={{ url('/dashboard/products?category_id=' . $category->id) }}
                                class='btn btn-primary'>Produkty</a>

                            <a href={{ url('/dashboard/product?category_id=' . $category->id) }}
                                class='btn btn-primary'>Dodaj produkt</a>

                            <a href={{ url('/dashboard/category/' . $category->id . '/delete') }}
                                class='btn btn-danger record-delete'>Usuń</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th scope='row' colspan='6' class='text-center'>Brak rekordów</th>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $categories->appends([])->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection

@section('scripts')
<script>
$('.record-delete').on('click', function() {
    return confirm("Jesteś pewien? Usunięte zostaną wszystkie kategorie!");
});

</script>
@endsection
