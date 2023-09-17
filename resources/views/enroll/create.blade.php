@extends('layouts.master')

@section('title', Str::title($entity))

@section('page-heading', Str::title($entity))

@push('extra-css')
<!-- DataTables -->
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
<h2>{{"Enroll yourself in course"}}</h2>
    <x-add-new-button :entity="$entity" />
    <div class="card shadow mb-4">
        <x-records-count :total="$records->total()" />
        <div class="card-body">
            <table id="dataTable" class="table table-bordered table-sm" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Instructor Name</th>
                        @permission('users.edit|users.delete')
                        <th>Action</th>
                        @endpermission
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $key => $record)
                    <tr>
                        <td class="text-center">{{ $records->firstItem() + $key }}</td>
                        <td>{{ $record->title }}</td>
                        <td>{{ $record->description }}</td>
                        <td >
                            {{ $record->start_date }}
                        </td>
                        <td >
                            {{ $record->end_date }}
                        </td>
                        <td >
                            {{ $record->user->name }}
                        </td>

                        <td>
                           <form action="/enroll/{{$record->id}}" method="post">
                            @csrf
                            @php
                                    $title = 'enroll';
                                @endphp
                                <x-save-button :title='$title' />

                            </form>
                        </td>
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

