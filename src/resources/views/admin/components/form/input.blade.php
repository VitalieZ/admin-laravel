<div class="form-group row">
    @isset($labelText)
    <label class="col-sm-2 control-label @if(isset($required)) asterisk @endif d-flex justify-content-center" for="{{ $attributes['id'] ?? $attributes['name'] }}">{{ $labelText }}</label>
    @endisset
    <div class="input-group mb-2 col-sm-10">
        @isset($iconGroupPrepend)
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="{{ $iconGroupPrepend }}"></i></div>
        </div>
        @endisset
        <input {{ $attributes->merge([
            "type" => "text",
            ]) }} class="form-control @error($attributes['name']) is-invalid @enderror " .$classs @isset($value) value="{{ $value }}" @endisset {{ $required }} />
        @error($attributes['name'])
        <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>