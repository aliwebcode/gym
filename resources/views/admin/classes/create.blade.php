@extends('admin.layouts.app')
@push('style')
    <link href="{{ asset('assets/admin/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">
                            Add New Class
                            <a href="{{ route('admin.classes.index') }}" class="btn btn-success btn-xs" style="margin-left: 5px">Back</a>
                        </h4>
                        <form action="{{ route('admin.classes.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group">
                                    <label for="training">Training</label>
                                    <select name="training_id" id="training" class="form-control">
                                        <option value="" disabled selected>Choose</option>
                                        @foreach($trainings as $training)
                                            <option value="{{ $training->id }}" {{ (old('training_id') == $training->id ? "selected" : "") }}>
                                                {{ $training->name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="coach">Coach</label>
                                    <select name="coach_id" id="coach" class="form-control">
                                        <option value="" disabled selected>Choose</option>
                                        @foreach($trainers as $trainer)
                                            <option value="{{ $trainer->id }}" {{ (old('coach_id') == $trainer->id ? "selected" : "") }}>
                                                {{ $trainer->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="branches">Branches</label>
                                    <select name="branch_id" id="branches" class="form-control">
                                        <option value="" disabled selected>Choose</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}" {{ (old('branch_id') == $branch->id ? "selected" : "") }}>
                                                {{ $branch->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name_en">Name (EN)</label>
                                        <input type="text" id="name_en" name="name_en" class="form-control" value="{{ old('name_en') }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name_ar">Name (AR)</label>
                                        <input type="text" id="name_ar" name="name_ar" class="form-control" value="{{ old('name_ar') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description_en">Description (EN)</label>
                                <textarea class="form-control" name="description_en" id="description_en" cols="30" rows="10">{{ old('description_en') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="description_ar">Description (AR)</label>
                                <textarea class="form-control" name="description_ar" id="description_ar" cols="30" rows="10">{{ old('description_ar') }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="capacity">Capacity</label>
                                        <input type="number" min="1" name="capacity" id="capacity" class="form-control" value="{{ old('capacity') }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" min="1" name="price" id="price" class="form-control" value="{{ old('price') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="duration">Duration (minute)</label>
                                <input type="number" min="1" name="duration" id="duration" class="form-control" value="{{ old('duration') }}">
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">End Date</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="start_time">Start Time</label>
                                        <input type="time" name="start_time" id="start_time" class="form-control" value="{{ old('start_time') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image" class="d-block">Image</label>
                                <input type="file" name="image" id="image">
                            </div>
                            <div class="form-group">
                                <label for="classes">Subscriptions</label>
                                <select multiple="multiple" class="multi-select" id="classes" name="allowed_classes[]" data-plugin="multiselect">
                                    @foreach($subscriptions as $cl)
                                        <option value="{{ $cl->id }}">{{ $cl->name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="is_active">Status</label>
                                <select name="status" id="is_active" class="form-control">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                @if($trainings->count() > 0)
                                    <input type="submit" class="btn btn-success" value="Add">
                                @else
                                    <div class="alert alert-info">
                                        Please add training first.
                                        <a href="{{ route('admin.trainings.create') }}" class="btn btn-primary btn-xs">Add Now</a>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/admin/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/mohithg-switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/jquery-mockjax/jquery.mockjax.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/devbridge-autocomplete/jquery.autocomplete.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/form-advanced.init.js') }}"></script>
@endpush
