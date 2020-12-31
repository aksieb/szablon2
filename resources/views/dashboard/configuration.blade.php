@extends('dashboard/template')

@section('right_box')
    <div class='row'>
        <div class='col-sm-12'>
            <h4>Konfiguracja</h4>

            <form method="POST" enctype="multipart/form-data">
                @csrf

                <div class='form-group'>
                    <label>Logo</label>
                    <input
                        type='file'
                        name='logo'
                        class='form-control-file'
                    />
                </div>

                <button type='submit' class='btn btn-primary'>Zapisz</button>
            </form>

            @isset($logo)
                <div class='row mt-4'>
                    <div class='col-sm-6'>
                        <h5>Aktualne logo</h5>
                        <img src={{ url($logo->filename) }} width="300px" alt="Logo" />
                    </div>
                </div>
            @endisset
        </div>
    </div>
@endsection
