@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" style="text-align: left">
                        <h4 style="text-align: left">My Profile</h4>
                        <div>
                            @if($user->image)
                                <img src="{{ $user->image }}" class="rounded-circle avatar-xl img-thumbnail mb-3">
                            @else
                                <img src="{{ asset('assets/admin/images/user.png') }}" class="rounded-circle avatar-xl img-thumbnail mb-3">
                            @endif

                            <form action="{{ route('admin.profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="old_image" value="{{ $user->image }}">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="full_name">Full Name</label>
                                            <input type="text" class="form-control" name="full_name" id="full_name" value="{{ $user->full_name }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="birthday">Birthday</label>
                                            <input type="date" class="form-control" name="birthday" id="birthday" value="{{ $user->birthday }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="image" class="d-block">Profile Image</label>
                                            <input type="file" name="image" id="image">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success" value="Update">
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
