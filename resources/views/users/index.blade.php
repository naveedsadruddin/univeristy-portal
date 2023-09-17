@extends('layouts.master')

@section('title', Str::title($entity))

@section('page-heading', Str::title($entity))

@push('extra-css')
<!-- DataTables -->
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<h2>{{$entity}}</h2>

<div class="container-fluid">
    <!-- Page Heading -->

    <x-add-new-button :entity="$entity" />
    <div class="card shadow mb-4">
        <x-records-count :total="$records->total()" />
        <div class="card-body">
            <table id="dataTable" class="table table-bordered table-sm" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Status</th>
                        @permission('users.edit|users.delete')
                        <th>Action</th>
                        @endpermission
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $key => $record)
                    <tr>
                        <td class="text-center">{{ $records->firstItem() + $key }}</td>
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->email }}</td>
                        <td style="width: 16.66%">
                            @foreach ($record->roles as $role)
                            <button type="button" class="m-1 btn btn-secondary btn-sm">{{ $role->name }}</button>
                            @endforeach
                        </td>
                        <x-list-status-column :status="$record->status" />
                        @permission('users.edit|users.destroy')
                        <td>
                            @if (auth()->user()->isAdmin() || $record->id !== auth()->user()->id)
                            <div class="btn-group">
                                @permission('users.edit')
                                <x-edit-button :id="$record->id" :entity="Str::singular($entity)" />
                                @endpermission
                                @permission('users.destroy')
                                <x-delete-button :id="$record->id" :entity="Str::singular($entity)" />
                                @endpermission
                            </div>
                            @endif
                        </td>
                        @endpermission
                    </tr>
                    @endforeach

                    <x-no-records :count="$records->count()" :colspan="$colspan ?? 10" />
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer bg-white">
            {{ $records->links() }}
        </div>
    </div>
    <!-- /.card -->

</div>
<x-toast title="Success" :message="Session::get('success')" type="success" />
<x-toast title="Error" :message="Session::get('error')" type="error" />

@endsection

@push('extra-scripts')
<!-- Page level plugins -->
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- page script -->
<script src="{{ asset('admin/scripts/init-advanced-datatable.js') }}"></script>
@endpush
