<div class="form-group mb-4">
    <label for="{{ $id }}">
        {{ $label }} <strong class="text-danger">*</strong>
    </label>
    <input
        id="{{ $id }}"
        class="form-control @if ($errors->has($name)) is-invalid @endif"
        name="{{ $name }}"
        type="{{ $type }}"
        placeholder="{{ $placeholder }}"
        value="{{ $value }}"
        spellcheck="{{ $spellcheck }}"
    >
    @if ($errors->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>
