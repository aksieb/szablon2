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
                <div class="carda">
                    <section class="text-center mb-4">
                        <div class="row wow fadeIn">
                            @foreach ($products as $product)
                                <div class="col-lg-3 col-md-6 mb-4 mt-4">
                                    <div class="card product-card">
                                        <div class='card-img-box'>
                                            @foreach ($product->files as $file)
                                                <img src={{ url($file->filename) }} class="card-img-top" alt="">
                                            @endforeach
                                        </div>

                                        <div class="card-body text-center">
                                            <a href={{ url('/product/' . $product->id) }} class="grey-text">
                                                <h5><strong>{{ $product->name }}</strong></h5>
                                            </a>

                                            <h5>
                                                <form method='POST' action={{ url('addToCart') }}>
                                                    @csrf

                                                    <input type='hidden' name='product_id' value={{ $product->id }} />
                                                    <input type='hidden' name='quantity' value='1' />

                                                    @if($product->existsInCart())
                                                        <small>Czeka w koszyku</small>
                                                    @else
                                                        <button type="submit" class="btn btn-secondary btn-sm">Do koszyka</button>
                                                    @endif
                                                </form>
                                            </h5>

                                            <h4 class="font-weight-bold blue-text">
                                                <strong>{{ $product->price() }}zł</strong>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>

                {{ $products->appends([])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    @endsection
