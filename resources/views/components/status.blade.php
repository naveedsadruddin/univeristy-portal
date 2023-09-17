<div class="row">
    <div class="form-group offset-{{ $offset ?? 3 }} col-lg-{{ $column ?? 6 }} {{ $padding ?? '' }} required">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control" required>
            <option value="1" {{ $value == 1 ? 'selected' : null }}>Active</option>
            <option value="0" {{ $value == 0 ? 'selected' : null }}>In-Active</option>
        </select>
        @include('components.form-error', ['key' => 'status'])
    </div>
</div>