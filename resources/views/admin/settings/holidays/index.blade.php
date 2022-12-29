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
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Holidays</h4>

                        <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Creation Date</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($holidays as $holiday)
                                <tr>
                                    <td>{{ $holiday->day }}</td>
                                    <td>{{ $holiday->created_at->format("Y-m-d") }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="javascript:void(0);"
                                               onclick="document.getElementById('delete-form-{{ $holiday->id }}').submit()"
                                               class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash-alt"></i>
                                            </a>
                                        </div>
                                        <form action="{{ route('admin.holidays.destroy', $holiday->id) }}"
                                              method="post"
                                              id="delete-form-{{ $holiday->id }}"
                                              class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="4">No holidays added.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Add New</h4>
                        <form action="{{ route('admin.holidays.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="from">From (Day)</label>
                                <input type="date" name="from" id="from" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="to">To (Day)</label>
                                <input type="date" name="to" id="to" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Add" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Delete Subscription Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Are you sure to delete subscription category?</h4>
                    <p id="modal-warning-message"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="delete-btn" class="btn btn-danger">Delete</button>
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
