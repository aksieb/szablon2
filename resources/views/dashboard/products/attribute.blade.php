<div class='form-group'>
    <label for='name'>Klucz</label>
    <select
        name="keys[]"
        class='form-control attribute-choose'
    >
        @foreach($attributes as $attr)
            <option
                value={{ $attr->id }}
                data-unit={{ $attr->unit }}
                @isset($attribute) @if($attr->id == $attribute->attribute_id) selected='selected' @endif @endisset
            >{{ $attr->name }}</option>
        @endforeach
    </select>
</div>
