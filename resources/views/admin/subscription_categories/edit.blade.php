@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">
                            Edit Subscription Category
                            <a href="{{ route('admin.subscription_categories.index') }}" class="btn btn-success btn-xs" style="margin-left: 5px">Back</a>
                        </h4>
                        <form action="{{ route('admin.subscription_categories.update', $category->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="name_en">Name (EN)</label>
                                <input type="text" id="name_en" name="name_en" class="form-control" value="{{ $category->name_en }}">
                            </div>
                            <div class="form-group">
                                <label for="name_ar">Name (AR)</label>
                                <input type="text" id="name_ar" name="name_ar" class="form-control" value="{{ $category->name_ar }}">
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
