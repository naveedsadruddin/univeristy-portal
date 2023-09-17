@error($key)
<span class="invalid-feedback d-block {{ $classes ?? '' }}" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
