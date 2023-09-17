@extends('layouts.master')

@section('title', Str::title($entity))

@push('extra-css')
<!-- DataTables -->
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="col-12">
    <div class="card shadow mb-4">
        <form method="POST" action="{{ route($entity.'.store') }}">
            @csrf
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create</h6>
            </div>
            <div class="card-body">

                <div class="row">

                    <div class="form-group col-md-4 required">
                        <label for="name">Name</label>
                        <input
                            type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror"
                            id="name" placeholder="Name" value="{{ old('name') }}" required />
                        <x-form-error key="name" />
                    </div>

                    <div class="form-group col-md-4 required">
                        <label for="slug">Slug</label>
                        <input
                            type="text" name="slug" class="form-control form-control-sm @error('slug') is-invalid @enderror"
                            id="slug" placeholder="Slug" value="{{ old('slug') }}" required />
                        <x-form-error key="slug" />
                    </div>

                    <div class="form-group col-md-4">
                        <label for="description">Description</label>
                        <textarea
                            type="text" name="description" class="form-control form-control-sm @error('description') is-invalid @enderror"
                            id="description" placeholder="Description" rows="1">{{ old('description') }}</textarea>
                        <x-form-error key="description" />
                    </div>

                </div>
                <x-status-field :value="Request::old('status') ?? 1" />

                <div class="row">

                    <div class="form-group col-md-12 table-responsive table-sm table-hover">
                        <h6>Permissions</h6>
                        <hr />
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Permission</th>
                                    <th class="text-center">Allowed</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $item)
                                <tr>
                                    <td width="50%">{{ $item->name }}</td>
                                    <td class="text-center"><input type="checkbox" name="permissions[]" value="{{ $item->id }}" /></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <x-form-error key="permissions" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <x-save-button />
            </div>
        </form>
    </div>
    <x-toast title="Success" :message="Session::get('success')" type="success" />
    <x-toast title="Error" :message="Session::get('error')" type="error" />
</div>

@endsection

@push('extra-scripts')
<!-- Page level plugins -->
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- page script -->
<script src="{{ asset('admin/scripts/init-advanced-datatable.js') }}"></script>
@endpush
