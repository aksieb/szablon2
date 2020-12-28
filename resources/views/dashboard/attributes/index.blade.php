@extends('dashboard/template')

@section('right_box')
    <div class='row'>
        <div class='col-sm-12'>
            <nav aria-label="breadcrumb mb-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ url('/dashboard') }}>Panel</a></li>
                    <li class="breadcrumb-item active">Atrybuty</li>
                </ol>
            </nav>

            <a href={{ url('/dashboard/attribute') }} class='btn btn-primary mb-3'>Dodaj</a>

            @if (session('success'))
                <div class="alert alert-success mb-3">
                    {{ session('success_msg') }}
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Klucz</th>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Jednostka</th>
                        <th scope="col">Akcje</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($attributes as $attribute)
                        <tr>
                            <th scope="row">{{ $attribute->id }}</th>
                            <td>{{ $attribute->key }}</td>
                            <td>{{ $attribute->name }}</td>
                            <td>{{ $units[$attribute->unit] }}</td>
                            <td>
                                <a href={{ url('/dashboard/attribute/' . $attribute->id) }} class='btn btn-primary'>Edytuj</a>

                                <a href={{ url('/dashboard/attribute/' . $attribute->id . '/delete') }}
                                    class='btn btn-danger record-delete'>Usuń</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th scope='row' colspan='5' class='text-center'>Brak rekordów</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $attributes->appends([])->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $('.record-delete').on('click', function() {
        return confirm("Jesteś pewien?");
    });

</script>
@endsection
