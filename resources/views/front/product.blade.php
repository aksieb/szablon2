@extends('app')

@section('stylesheets')
    <link rel='stylesheet' href={{ asset('/assets/css/shop-item.css') }} />
@endsection

@section('content')
    @include('front.components.navigation')

    <div class="container">
        <div class="row">
            @include('front.components.menu')

            <div class="col-lg-9 mt-5">
                <section class="mb-5">
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <div id="carouselControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($product->files as $key => $file)
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src={{ url($file->filename) }} alt="Zdjęcie produktu">
                                        </div>
                                    @endforeach
                                </div>

                                <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Poprzedni</span>
                                </a>

                                <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Następny</span>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="opis">

                                <h5><strong>{{ $product->name }}</strong></h5>
                                <p class="mb-2 text-muted text-uppercase small">{{ $product->category->name }}</p>

                                <p><span class="mr-1"><strong>{{ $product->price() }} zł</strong></span></p>
                                <p class="pt-1">{{ $product->description }}</p>
                                <div class="table-responsive">
                                    <table class="table table-sm table-borderless mb-0">
                                        <tbody>
                                            @foreach($product->attributes as $attribute)
                                                @if($attribute->key != 'price')
                                                    <tr>
                                                        <th class="pl-0 w-25" scope="row"><strong>{{ $attribute->name }}</strong></th>
                                                        <td>{{ $attribute->pivot->value }} {{ $units[$attribute->unit] }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <hr>

                                <form method='POST' action={{ url('addToCart') }}>
                                    @csrf

                                    <input type='hidden' name='product_id' value={{ $product->id }} />

                                    <div class="table-responsive mb-2">
                                        <table class="table table-sm table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="pl-0 pb-0 w-25"><strong>ILOŚĆ</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0">
                                                        <div class="def-number-input number-input safari_only mb-0">
                                                            <button
                                                                type='button'
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                                            >-</button>
                                                            <input class="quantity" min="0" name='quantity' value="1"
                                                                type="number">
                                                            <button
                                                                type='button'
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                                            >+</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    @if($product->existsInCart())
                                        Czeka w koszyku
                                    @else
                                        <button type="submit" class="btn btn-light btn-md mr-1 mb-2">
                                            <i class="fas fa-shopping-cart pr-2"></i>Dodaj do koszyka
                                        </button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>
@endsection
