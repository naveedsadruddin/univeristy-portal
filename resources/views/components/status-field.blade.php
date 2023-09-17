<div class="offset-2 form-group col-lg-{{ !isset($column) ? 8 : $column }} required">
    <label for="status">Status</label>
    @php
        $allowed = auth()->user()->hasPermission(str_replace(array('.edit', '.create'), array('.status', '.status'), Route::currentRouteName()));
    @endphp
    <select name="{{ $allowed ? 'status' : null}}" id="status" class="form-control form-control-sm" required {{ !$allowed ? 'disabled' : null }}>
        <option value="1" {{ $value == 1 ? 'selected' : null }}>Active</option>
        <option value="0" {{ $value == 0 ? 'selected' : null }}>In-Active</option>
    </select>
    @if (!$allowed)
        <input type="hidden" name="status" value="{{ $value }}" />
        <p class="text-muted p-1">* You don't have permission to change status.</p>
    @endif
    @if (isset($message))
        <small class="text-danger">{{ $message }}</small>
    @endif
</div>
