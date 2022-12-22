@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">
                            Settings
                        </h4>

                        <form action="{{ route('admin.settings.update') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="version">Application Version</label>
                                <input type="text" name="version" id="version" class="form-control" value="{{ $settings->version ?? '' }}">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Save" class="btn btn-success">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
