@extends('dashboard/template')

@section('right_box')
    <div class='row'>
        <div class='col-sm-12'>
            <nav aria-label="breadcrumb mb-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ url('/dashboard') }}>Panel</a></li>
                    <li class="breadcrumb-item"><a href={{ url('/dashboard/products') }}>Produkty</a></li>
                    @isset($product)
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->id }}</li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">Dodaj</li>
                    @endisset
                </ol>
            </nav>

            @if($errors->any())
                <div class="alert alert-danger mt-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class='mt-4' method='post' enctype='multipart/form-data'>
                @csrf

                <div class='row'>
                    <div class='col-sm-6'>
                        <div class='form-group'>
                            <label for='name'>Nazwa produktu</label>
                            <input
                                type='text'
                                id='name'
                                name='name'
                                required='required'
                                class='form-control'
                                value="{{ isset($product) ? $product->name : "" }}"
                            />
                        </div>

                        <div class='form-group'>
                            <label for='description'>Opis produktu</label>
                            <textarea
                                class="form-control"
                                id="description"
                                name="description" rows="5"
                            >{{ isset($product) ? $product->description : "" }}</textarea>
                        </div>

                        <div class='form-group'>
                            <label for='name'>Dostępne</label>
                            <div class='d-flex'>
                                <input
                                    type='number'
                                    step="0.01"
                                    min="0"
                                    id='quantity'
                                    name='quantity'
                                    required='required'
                                    class='form-control'
                                    value="{{ isset($product) ? $product->quantity : "" }}"
                                />

                                <select
                                    id='unit'
                                    name='unit'
                                    required='required'
                                    class='form-control'
                                >
                                    @foreach($attributes as $attr)
                                        <option
                                            value={{ $attr->id }}
                                            @isset($product) @if($attr->id == $product->unit) selected='selected' @endif @endisset
                                        >{{ $attr->name }} ({{ $units[$attr->unit] }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='name'>Kategoria</label>
                            <select
                                id='category_id'
                                name='category_id'
                                required='required'
                                class='form-control'
                            >
                                <option>Wybierz</option>
                                @foreach($categories as $category)
                                    <option
                                        value={{ $category->id }}
                                        {{ (isset($product) && $product->category_id == $category->id) || $categoryId == $category->id ? "selected='selected'" : "" }}
                                    >{{ $category->name }}</option>
                                    @foreach($category->categories as $cat)
                                        <option
                                            value={{ $cat->id }}
                                            {{ (isset($product) && $product->category_id == $cat->id) || $categoryId == $cat->id ? "selected='selected'" : "" }}
                                        >&nbsp;&nbsp;&nbsp;&nbsp;{{ $cat->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>


                        <div class='form-group'>
                            <label for='files'>Pliki</label>
                            <input
                                type='file'
                                multiple="multiple"
                                accept="image/*"
                                id='files[]'
                                name='files[]'
                                class='form-control-file'
                            />

                            @isset($product)
                                <table class='table mt-4'>
                                    <thead>
                                        <tr>
                                            <th scope='col'>ID</th>
                                            <th scope='col'>Nazwa</th>
                                            <th scope='col'>Podgląd</th>
                                            <th scope='col'>Akcje</th>
                                        </tr>
                                    </thead>

                                    <tbody class='files'>
                                        @foreach($product->files as $key => $file)
                                            <tr class='file-row'>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $file->filename_original }}</td>
                                                <td>
                                                    <img
                                                        src={{ url($file->filename) }}
                                                        alt={{ $file->filename_original }}
                                                        width="120px"
                                                    />
                                                </td>
                                                <td>
                                                    <button
                                                        type='button'
                                                        class='btn btn-danger file-delete'
                                                        data-id={{ $file->id }}
                                                    >Usuń</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endisset
                        </div>
                    </div>

                    <div class='col-sm-6'>
                        <h6>Atrybuty</h6>
                        <small>Dodaj atrybuty produktu</small>

                        <div id="attributes" class='mt-2'>
                            <button id="add_attribute" type='button' class='btn btn-primary mb-2'>Dodaj</button>

                            @isset($product)
                                @foreach($product->productAttributes as $attribute)
                                    <div class='row m-1 attribute_row'>
                                        <div class='col-sm-4'>
                                            @include('dashboard.products.attribute')
                                        </div>

                                        <div class='col-sm-3'>
                                            <div class='form-group'>
                                                <label for='name'>Wartość</label>
                                                <input
                                                    type='text'
                                                    name="values[]"
                                                    class='form-control'
                                                    value={{ $attribute->value }}
                                                >
                                            </div>
                                        </div>

                                        <div class='col-sm-3'>
                                            <div class='form-group'>
                                                <label for='name'>Jednostka</label>
                                                <div class='unit'>{{ $units[$attribute->attribute->unit] }}</div>
                                            </div>
                                        </div>

                                        <div class='col-sm-1 d-flex'>
                                            <button
                                                type="button"
                                                class='btn btn-danger attribute_delete'
                                            >Usuń</button>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>

                        <template id="attribute_template">
                            <div class='row m-1 attribute_row'>
                                <div class='col-sm-4'>
                                    @include('dashboard.products.attribute')
                                </div>

                                <div class='col-sm-3'>
                                    <div class='form-group'>
                                        <label for='name'>Wartość</label>
                                        <input
                                            type='text'
                                            name="values[]"
                                            class='form-control'
                                        >
                                    </div>
                                </div>

                                <div class='col-sm-3'>
                                    <div class='form-group'>
                                        <label for='name'>Jednostka</label>
                                        <div class='unit'></div>
                                    </div>
                                </div>

                                <div class='col-sm-1 d-flex'>
                                    <button
                                        type="button"
                                        class='btn btn-danger attribute_delete'
                                    >Usuń</button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="d-flex flex-column justify-content-center text-center">
                    <button class="btn btn-primary mt-3 mx-auto" type="submit">Zapisz</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var units = @json($units);
        var attributes = @json($attributes);
        var defaultUnit = units[attributes[0].unit];

        $('#add_attribute').on('click', function() {
            if($('#attributes').children().length > attributes.length) {
                return;
            }

            var template = $('#attribute_template').clone();
            var node = template.prop('content');
            var unit = $(node).find('.unit');
            $(unit).html(defaultUnit);

            $('#attributes').append(template.html());
        });

        $(document).on('click', '.attribute-choose', function() {
            var unit = $(this).closest('.attribute_row').find('.unit');
            var id = $("option:selected", this).data('unit');

            console.log(unit);

            $(unit).html(units[id]);
        });

        $('.file-delete').on('click', function() {
            var id = $(this).data('id');

            fetch('/files', {
                method: 'DELETE',
                credentials: 'include',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id,
                    _token: '{{ csrf_token() }}'
                })
            })
            .then(response => response.json())
            .then(data => {
                $(this).closest('.file-row').remove();
            });
        });

        $(document).on('click', '.attribute_delete', function() {
            var row = $(this).closest('.attribute_row');
            $(row).remove();
        });

        $('.record-delete').on('click', function() {
            return confirm("Jesteś pewien? Usunięte zostaną wszystkie dane kursu!");
        });
    </script>
@endsection
