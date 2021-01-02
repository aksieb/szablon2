@extends('app')

@section('stylesheets')
    <link rel='stylesheet' href={{ asset('/assets/css/shop-item.css') }} />
@endsection

@section('content')
    @include('front.components.navigation')

    <div class="container">
        <div class="row">
            @include('front.components.menu')

            <div class="col-lg-9">

                <div class="card card-outline-secondary my-4">
                    <div class="card-header">
                        Czym się zajmujemy
                    </div>
                    <div class="card-body">
                        <div>Nasza firma zajmuje się sprzedażą detaliczną oraz hurtową. Każdy nasz produkt to gwarancja
                            najlepszej jakości.
                            Nasz sklep prowadzny jest przez najlepszych specjalistów kończących renomowaną uczelnię.
                            To dzięki ich umiejętnością strona ta jest bardzo przejrzysta i przyjemna w użytkowaniu.
                            <img src="{{ url('/assets/img/r4.jpg') }}" class="img-fluid" alt="...">
                            <hr>
                            Zamówione produkty wysyłamy najpóźniej w kolejnym dniu roboczym.
                            Posiadamy system magazynowy dzięki któremu nie będzie sytuacji w której zapłacicie za produkt,
                            który nie zostanie do Was wysłany.

                            <hr>
                            Do każdego zamówienia dokładamy prezent niespodziankę która zachwyci każdego z Was.
                            Każdy klient jest przez nas traktowany indywidualnie przez co zakupy w naszym sklepie to czysta
                            przyjemność.
                            <hr>
                            Dzięki świetnej obsłudze, szybkiej wysyłce oraz doskonałym produktom zakupy w naszym sklepie
                            będą stanowiły codzinną rutyne każdego dnia.
                            <hr>
                            Kiedy choć raz zrobisz zakupy w naszym sklepie, już nigdy nie będziesz czekać w kolejce w
                            sklepie stacjonarnym.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
