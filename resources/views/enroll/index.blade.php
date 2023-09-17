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
    <h2>{{"Enrollments"}}</h2>

    <x-add-new-button :entity="$entity" />
    <div class="card shadow mb-4">
        <x-records-count :total="$records->total()" />

        <div class="card-body">
            <table id="dataTable" class="table table-bordered table-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">S No.</th>
                        <th>Student Name</th>
                        <th>Course</th>
                        <th>date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $key => $record)
                    <tr>
                        <td class="text-center">{{ $records->firstItem() + $key }}</td>
                        <td>{{ $record->user->name }}</td>
                        <td>{{ $record->course->title }}</td>
                        <td>{{ $record->date ?? '--' }}</td>
                        @role('admin')
                        <td>
                            <form action="/deenroll/{{$record->id}}" method="post">
                                @csrf
                                @php
                                    $title = 'De enroll';
                                @endphp
                                <x-save-button :title='$title' />

                            </form>
                        </td>
                        @endrole

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
