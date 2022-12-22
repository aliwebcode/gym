@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">
                            Edit Branch
                            <a href="{{ route('admin.branches.index') }}" class="btn btn-success btn-xs" style="margin-left: 5px">Back</a>
                        </h4>
                        <form action="{{ route('admin.branches.update', $branch->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="name">Name (EN)</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $branch->name }}">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
