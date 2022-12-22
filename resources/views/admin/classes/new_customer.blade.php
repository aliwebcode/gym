@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">
                            New Class Customer
                        </h4>

                        <form action="{{ route('admin.classes.new_customer_store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    <option value="" selected>Choose</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
{{--                                <input type="submit" value="Save" class="btn btn-success">--}}
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
