@extends('admin.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/libs/summernote/summernote-bs4.min.css') }}">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">
                            Edit Class
                            <a href="{{ route('admin.classes.index') }}" class="btn btn-success btn-xs" style="margin-left: 5px">Back</a>
                        </h4>
                        <form action="{{ route('admin.classes.update', $cls->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name_en">Name (EN)</label>
                                        <input type="text" id="name_en" name="name_en" class="form-control" value="{{ $cls->name_en }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name_ar">Name (AR)</label>
                                        <input type="text" id="name_ar" name="name_ar" class="form-control" value="{{ $cls->name_ar }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description_en">Description (EN)</label>
                                <textarea class="form-control summernote" name="description_en" id="description_en" cols="30" rows="10">{{ $cls->description_en }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="description_ar">Description (AR)</label>
                                <textarea class="form-control summernote" name="description_ar" id="description_ar" cols="30" rows="10">{{ $cls->description_ar }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="capacity">Capacity</label>
                                        <input type="number" min="1" name="capacity" id="capacity" class="form-control" value="{{ $cls->capacity }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price ($)</label>
                                        <input type="number" min="1" name="price" id="price" class="form-control" value="{{ $cls->price }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="duration">Duration</label>
                                <input type="number" min="1" name="duration" id="duration" class="form-control" value="{{ $cls->duration }}">
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $cls->start_date }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">End Date</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $cls->end_date }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image" class="d-block">Image</label>
                                <input type="file" name="image" id="image">
                            </div>
                            <div class="form-group">
                                <label for="training">Training</label>
                                <select name="training_id" id="training" class="form-control">
                                    @foreach($trainings as $training)
                                        <option value="{{ $training->id }}" {{ $cls->training_id == $training->id ?? 'selected' }}>{{ $training->name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="is_active">Status</label>
                                <select name="status" id="is_active" class="form-control">
                                    <option value="1" {{ $cls->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $cls->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
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

@push('script')
    <script src="{{ asset('assets/admin/libs/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function(){

            $('.summernote').summernote({
                tabSize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            })
        });
    </script>
@endpush