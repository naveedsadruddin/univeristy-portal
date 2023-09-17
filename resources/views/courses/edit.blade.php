@extends('layouts.master')

@section('title', Str::title($entity))

@push('extra-css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('admin/vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')

<div class="col-md-12">
<h2>{{$entity}}</h2>

    <div class="card shadow mb-4">
        <form method="POST" action="{{ route($entity.'.update', [Str::singular($entity) => $record->id]) }}">
            @csrf
            @method('PUT')

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
            </div>
            <div class="card-body">
                <div class="form-group col-md-4 required">
                    <label for="name">Title</label>
                    <input type="title" name="title" class="form-control form-control-sm  @error('title') is-invalid @enderror"
                        id="title" placeholder="Enter title"  required value="{{ old('title') ?? $record->title }}">
                    <x-form-error key="title" />
                </div>

                <div class="form-group col-md-4 required">
                    <label for="description">Description</label>
                    <textarea type="description" name="description" class="form-control form-control-sm @error('description') is-invalid @enderror"
                        id="description" placeholder="Enter description" required >{{ old('description') ?? $record->description }}</textarea>
                    <x-form-error key="description" />
                </div>

                <div class="form-group col-md-4 required">
                    <label for="start_date">start date</label>
                    <input type="date" name="start_date"
                        class="form-control form-control-sm @error('start_date') is-invalid @enderror" id="start_date"
                        placeholder="start_date" required value="{{ old('start_date') ?? $record->start_date }}">
                    <x-form-error key="start_date" />
                </div>
                <div class="form-group col-md-4 required">
                    <label for="end_date">end date</label>
                    <input type="date" name="end_date"
                        class="form-control form-control-sm @error('end_date') is-invalid @enderror" id="end_date"
                        placeholder="end_date" value="{{ old('end_date') ?? $record->end_date }}" required>
                    <x-form-error key="end_date" />
                </div>

                <div class="form-group col-md-4">
                    <label for="user">Instructor</label>
                    <select name="user_id" class="form-control form-control-sm select2bs4 @error('user_id') is-invalid @enderror"
                        multiple data-placeholder='user'>
                        @foreach ($users as $key => $user)
                        <option value="{{ $user->id }}" {{$record->user->id == $user->id ? 'selected':''}}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <x-form-error key="user_id" />
                </div>
            </div>
            <div class="card-footer">
                <x-save-button />
            </div>
        </form>
    </div>
    <!-- /.card -->

</div>

@endsection

@push('extra-scripts')
<!-- Select2 -->
<script src="{{ asset('admin/vendor/select2/js/select2.full.min.js') }}"></script>
<!-- page script -->
<script src="{{ asset('admin/scripts/init-select2-multple-drpdwn.js') }}"></script>
@endpush
