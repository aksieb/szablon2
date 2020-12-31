@extends('dashboard/template')

@section('right_box')
    <div class='row'>
        <div class='col-sm-12'>
            <nav aria-label="breadcrumb mb-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ url('/dashboard') }}>Panel</a></li>
                    <li class="breadcrumb-item"><a href={{ url('/dashboard/orders') }}>Zamówienia</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $order->id }}</li>
                </ol>
            </nav>

            <div class='row'>
                <div class='col-sm-6'>
                    <h2>Daty</h2>
                    <p>
                        <b>Utworzono:</b> {{ $order->created_at ? date('d.m.Y H:i', strtotime($order->created_at)) : 'Brak' }}
                    </p>
                    <p>
                        <b>Zaktualizowano:</b> {{ $order->updated_at ? date('d.m.Y H:i', strtotime($order->updated_at)) : 'Brak' }}
                    </p>
                    <p>
                        <b>Zakończono:</b> {{ $order->finished_at ? date('d.m.Y H:i', strtotime($order->finished_at)) : 'Brak' }}
                    </p>
                    <p>
                        <b>Anulowano:</b> {{ $order->cancelled_at ? date('d.m.Y H:i', strtotime($order->cancelled_at)) : 'Brak' }}
                    </p>
                </div>

                <div class='col-sm-6'>
                    <h2>Klient</h2>
                    <p>
                        <b>Imię:</b> {{ $order->data->first_name }}
                    </p>
                    <p>
                        <b>Nazwisko:</b> {{ $order->data->last_name }}
                    </p>
                    <p>
                        <b>Telefon:</b> {{ $order->data->phone }}
                    </p>
                    <p>
                        <b>Email:</b> {{ $order->data->email }}
                    </p>
                    <p>
                        <b>Adres:</b><br />
                        {{ $order->data->street }} {{ $order->data->house_number }}{{ $order->data->apartment_number ? '/' . $order->data->apartment_number : '' }}<br />
                        {{ $order->data->zipcode }} {{ $order->data->city }}<br />
                        {{ $order->data->country }}
                    </p>
                </div>
            </div>

            <div class='row'>
                <div class='col-sm-12'>
                    <h2>Produkty</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nazwa</th>
                                <th scope="col">Kategoria</th>
                                <th scope="col">Ilość</th>
                                <th scope="col">Cena jednostkowa</th>
                                <th scope="col">Cena</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $total = 0; @endphp

                            @forelse($order->products as $product)
                                @php
                                    $price = $product->price();
                                    $multiply = $product->pivot->quantity * $price;
                                    $total += $multiply;
                                @endphp

                                <tr>
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <td>{{ $price }} zł</td>
                                    <td>{{ $multiply }} zł</td>
                                </tr>
                            @empty
                                <tr>
                                    <th scope='row' colspan='5' class='text-center'>Brak rekordów</th>
                                </tr>
                            @endforelse

                            <tr>
                                <th scope='row' colspan='5' class='text-right'>Razem:</th>
                                <td>{{ $total }} zł</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
