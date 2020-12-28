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
                <form method="POST">
                    @csrf

                    <h5 class="mb-2">Dane klienta</h5>
                    <div class='row'>
                        <div class='col-sm-6'>
                            <div class='form-group'>
                                <label>Imię</label>
                                <input
                                    type='text'
                                    name='first_name'
                                    class='form-control'
                                    required='required'
                                />
                            </div>
                        </div>

                        <div class='col-sm-6'>
                            <div class='form-group'>
                                <label>Nazwisko</label>
                                <input
                                    type='text'
                                    name='last_name'
                                    class='form-control'
                                    required='required'
                                />
                            </div>
                        </div>
                    </div>

                    <h5 class="mb-2">Adres dostawy</h5>
                    <div class='row'>
                        <div class='col-sm-6'>
                            <div class='form-group'>
                                <label>Ulica</label>
                                <input
                                    type='text'
                                    name='street'
                                    class='form-control'
                                />
                            </div>
                        </div>

                        <div class='col-sm-3'>
                            <div class='form-group'>
                                <label>Nr budynku</label>
                                <input
                                    type='text'
                                    name='house_number'
                                    class='form-control'
                                    required='required'
                                />
                            </div>
                        </div>

                        <div class='col-sm-3'>
                            <div class='form-group'>
                                <label>Nr mieszkania</label>
                                <input
                                    type='text'
                                    name='apartment_number'
                                    class='form-control'
                                />
                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-sm-3'>
                            <div class='form-group'>
                                <label>Kod pocztowy</label>
                                <input
                                    type='text'
                                    name='zipcode'
                                    class='form-control'
                                    required='required'
                                />
                            </div>
                        </div>

                        <div class='col-sm-4'>
                            <div class='form-group'>
                                <label>Miejscowość</label>
                                <input
                                    type='text'
                                    name='city'
                                    class='form-control'
                                    required='required'
                                />
                            </div>
                        </div>

                        <div class='col-sm-4'>
                            <div class='form-group'>
                                <label>Kraj</label>
                                <input
                                    type='text'
                                    name='country'
                                    class='form-control'
                                    value='Polska'
                                />
                            </div>
                        </div>
                    </div>

                    <h5 class="mb-2">Dane kontaktowe</h5>
                    <div class='row'>
                        <div class='col-sm-6'>
                            <div class='form-group'>
                                <label>Telefon</label>
                                <input
                                    type='text'
                                    name='phone'
                                    required='required'
                                    class='form-control'
                                />
                            </div>
                        </div>

                        <div class='col-sm-6'>
                            <div class='form-group'>
                                <label>E-mail</label>
                                <input
                                    type='email'
                                    name='email'
                                    class='form-control'
                                />
                            </div>
                        </div>
                    </div>

                    <div class='row mt-3 mb-3'>
                        <div class='col-sm-3'>
                            <button type='submit' class='btn btn-primary'>ZAMAWIAM!</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
