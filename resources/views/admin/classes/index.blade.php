@extends('admin.layouts.app')
@push('style')
    <link href="{{ asset('assets/admin/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">
                            Classes
                            <a href="{{ route('admin.classes.create') }}" class="btn btn-success btn-xs" style="margin-left: 5px">New</a>
{{--                            <a href="{{ route('admin.classes.new_customer') }}" class="btn btn-info btn-xs" style="margin-left: 5px">New Class Customer</a>--}}
                        </h4>

                        <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name (AR)</th>
                                <th>Name (EN)</th>
                                <th>Price</th>
                                <th>Coach</th>
                                <th>Capacity</th>
                                <th>Status</th>
                                <th>Creation Date</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($classes as $class)
                                <tr>
                                    <td>
                                        <img src="{{ '/' . $class->image }}" width="80" height="80">
                                    </td>
                                    <td>{{ $class->name_ar }}</td>
                                    <td>{{ $class->name_en }}</td>
                                    <td>{{ $class->price }}$</td>
                                    <td>{{ $class->coach->full_name }}</td>
                                    <td>{{ $class->capacity }}</td>
                                    <td>{!! $class->statusWithLabel() !!}</td>
                                    <td>{{ $class->created_at->format("Y-m-d") }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.classes.edit', $class->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0);" onclick="if (confirm('Are you sure to delete this record?')) { document.getElementById('delete-form-{{ $class->id }}').submit(); } else { return false; }" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash-alt"></i>
                                            </a>
                                        </div>
                                        <form action="{{ route('admin.classes.destroy', $class->id) }}"
                                              method="post"
                                              id="delete-form-{{ $class->id }}"
                                              class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="8">No classes added.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- third party js -->
    <script src="{{ asset('assets/admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script src="{{ asset('assets/admin/js/pages/datatables.init.js') }}"></script>
@endpush
