<div class="form-group mb-4">
    <label for="{{ $id }}">
        {{ $label }} <strong class="text-danger">*</strong>
    </label>
    <textarea
        name="{{ $name }}"
        id="{{ $id }}"
        class="form-control @if ($errors->has($name)) is-invalid @endif"
        rows="{{ $row }}"
        placeholder="{{ $placeholder }}"
        spellcheck="{{ $spellcheck }}">{{ $value }}</textarea>
    @if ($errors->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>
