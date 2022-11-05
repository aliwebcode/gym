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
                            Add New Subscription
                            <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-success btn-xs" style="margin-left: 5px">Back</a>
                        </h4>
                        <form action="{{ route('admin.subscriptions.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name_en">Name (EN)</label>
                                        <input type="text" id="name_en" name="name_en" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name_ar">Name (AR)</label>
                                        <input type="text" id="name_ar" name="name_ar" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description_en">Description (EN)</label>
                                <textarea class="form-control summernote" name="description_en" id="description_en" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="description_ar">Description (AR)</label>
                                <textarea class="form-control summernote" name="description_ar" id="description_ar" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image" class="d-block">Image</label>
                                <input type="file" name="image" id="image">
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="duration">Duration (minute)</label>
                                        <input type="number" min="1" class="form-control" name="duration" id="duration">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price ($)</label>
                                        <input type="number" min="1" class="form-control" name="price" id="price">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subscription_category_id">Subscription Category</label>
                                <select class="form-control" name="subscription_category_id" id="subscription_category_id">
                                    <option value="" selected disabled>Choose</option>
                                    @foreach($subscription_categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                @if($subscription_categories->count() > 0)
                                    <input type="submit" class="btn btn-success" value="Add">
                                @else
                                    <div class="alert alert-info">
                                        Please add subscription category first.
                                        <a href="{{ route('admin.subscription_categories.index') }}" class="btn btn-primary btn-xs">Add Now</a>
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
