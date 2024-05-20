<div class="form-group mb-4">
    <label for="{{ $id }}">
        {{ $label }} <strong class="text-danger">*</strong>
    </label>
    <select
        class="form-select @if ($errors->has($name)) is-invalid @endif"
        id="{{ $id }}"
        name="{{ $name }}"
    >
        <option value="">Lựa chọn</option>
        @foreach ($dataSelect as $item)
        <option
            @selected($value != '' && $item['case']->value == $value)
            value="{{ $item['case'] }}"
        >
            {{ $item['description'] }}
        </option>
        @endforeach
    </select>
    @if ($errors->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>
