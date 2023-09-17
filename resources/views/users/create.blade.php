@extends('layouts.master')

@section('title', Str::title($entity))

@push('extra-css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('admin/vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
<h2>{{$entity}}</h2>

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
                        <input type="name" name="name" class="form-control form-control-sm  @error('name') is-invalid @enderror"
                            id="name" placeholder="Enter Name" value="{{ old('name') }}" required>
                        <x-form-error key="name" />
                    </div>

                    <div class="form-group col-md-4 required">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror"
                            id="email" placeholder="Enter email" value="{{ old('email') }}" required>
                        <x-form-error key="email" />
                    </div>

                    <div class="form-group col-md-4 required">
                        <label for="password">Password</label>
                        <input type="password" name="password"
                            class="form-control form-control-sm @error('password') is-invalid @enderror" id="password"
                            placeholder="Password" required>
                        <x-form-error key="password" />
                    </div>

                    <div class="form-group col-md-4">
                        <label for="roles">Roles</label>
                        <select name="roles[]" class="form-control form-control-sm select2bs4 @error('roles') is-invalid @enderror"
                            multiple data-placeholder='Roles'>
                            @foreach ($roles as $key => $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <x-form-error key="roles" />
                    </div>
                    <x-status-field :value="Request::old('status') ?? 1" />
                </div>

            </div>
            <div class="card-footer">
                <x-save-button />
            </div>
        </form>
        <x-toast title="Success" :message="Session::get('success')" type="success" />
<x-toast title="Error" :message="Session::get('error')" type="error" />
    </div>
</div>

@endsection

@push('extra-scripts')
<!-- Select2 -->
<script src="{{ asset('admin/vendor/select2/js/select2.full.min.js') }}"></script>
<!-- page script -->
<script src="{{ asset('admin/scripts/init-select2-multple-drpdwn.js') }}"></script>
@endpush
