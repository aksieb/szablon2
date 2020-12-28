@extends('dashboard/template')

@section('right_box')
    <div class='row'>
        <div class='col-sm-12'>
            <nav aria-label="breadcrumb mb-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ url('/dashboard') }}>Panel</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Zamówienia</li>
                </ol>
            </nav>

            @if (session('success'))
                <div class="alert alert-success mb-3">
                    {{ session('success_msg') }}
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Utworzono</th>
                        <th scope="col">Zaktualizowano</th>
                        <th scope="col">Zakończono</th>
                        <th scope="col">Anulowano</th>
                        <th scope="col">Akcje</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->id }}</th>
                            <td>{{ $order->created_at ? date('d.m.Y H:i', strtotime($order->created_at)) : 'Brak' }}</td>
                            <td>{{ $order->updated_at ? date('d.m.Y H:i', strtotime($order->updated_at)) : 'Brak' }}</td>
                            <td>{{ $order->finished_at ? date('d.m.Y H:i', strtotime($order->finished_at)) : 'Brak' }}</td>
                            <td>{{ $order->cancelled_at ? date('d.m.Y H:i', strtotime($order->cancelled_at)) : 'Brak' }}</td>
                            <td>
                                <a href={{ url('/dashboard/order/' . $order->id) }} class='btn btn-primary'>Pokaż</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th scope='row' colspan='6' class='text-center'>Brak rekordów</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $orders->appends([])->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
