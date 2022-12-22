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
                <div class="mb-2">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-success btn-sm"><i class="fa fa-arrow-left"></i></a>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                </div>
                <div class="card">
                    <div class="text-center card-body">
                        <h4 style="text-align: left">User Info</h4>
                        <div>
                            @if($user->image)
                                <img src="{{ '/' . $user->image }}" class="rounded-circle avatar-xl img-thumbnail mb-3">
                            @else
                                <img src="{{ asset('assets/admin/images/user.png') }}" class="rounded-circle avatar-xl img-thumbnail mb-3">
                            @endif

                            <div class="row" style="text-align: left">
                                <div class="col-12 col-md-6">
                                    <p class="text-muted font-13"><strong>Full Name :</strong> <span class="ms-2">{{ $user->full_name }}</span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p class="text-muted font-13"><strong>Email :</strong> <span class="ms-2">{{ $user->email }}</span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p class="text-muted font-13"><strong>Phone :</strong> <span class="ms-2">{{ $user->phone }}</span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p class="text-muted font-13"><strong>Role :</strong> <span class="ms-2">{{ $user->role->name }}</span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p class="text-muted font-13"><strong>Birthday :</strong> <span class="ms-2">{{ $user->birthday ?? '-' }}</span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p class="text-muted font-13"><strong>Status :</strong> <span class="ms-2">{!! $user->statusWithLabel() !!}</span></p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="text-center card-body">
                        <h4 style="text-align: left;margin-bottom: 20px">User Subscription</h4>
                        <div class="row" style="text-align: left">
                            @if($user->subscription && $user->subscription->count() > 0)
                                <div class="col-12">
                                    <p class="text-muted font-13">
                                        <strong>Subscription :</strong> <span class="ms-2">{{ $user->subscription->subscription->name_en }}</span>
                                    </p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p class="text-muted font-13">
                                        <strong>Start Date :</strong> <span class="ms-2">{{ $user->subscription->start_date }}</span>
                                    </p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p class="text-muted font-13">
                                        <strong>End Date :</strong> <span class="ms-2">{{ $user->subscription->end_date }}</span>
                                    </p>
                                </div>
                            @else
                                <p class="text-center">No Subscriptions found.</p>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="text-center card-body">
                        <h4 style="text-align: left;margin-bottom: 20px">User Classes</h4>
                        <div class="row" style="text-align: left">
                            @if($user->classes && $user->classes->count() > 0)
                                @foreach($user->classes as $cl)
                                    <div class="col-12 col-md-6">
                                        <p class="text-muted font-13">
                                            <strong>Class :</strong> <span class="ms-2">{{ $cl->gym_class->name_en }}</span>
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <p class="text-muted font-13">
                                            <strong>Class Date :</strong> <span class="ms-2">{{ $cl->class_date }}</span>
                                        </p>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-center">No Classes found.</p>
                            @endif
                        </div>

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
