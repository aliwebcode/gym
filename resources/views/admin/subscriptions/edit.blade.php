@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">
                            Edit Subscription
                            <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-success btn-xs" style="margin-left: 5px">Back</a>
                        </h4>
                        <form action="{{ route('admin.subscriptions.update', $subscription->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="form-group">
                                    <label for="subscription_category_id">Subscription Category</label>
                                    <select class="form-control" name="subscription_category_id" id="subscription_category_id">
                                        @foreach($subscription_categories as $category)
                                            <option value="{{ $category->id }}" {{ $subscription->subscription_category_id == $category->id ?? 'selected' }}>{{ $category->name_en }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name_en">Name (EN)</label>
                                        <input type="text" id="name_en" name="name_en" class="form-control" value="{{ $subscription->name_en }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name_ar">Name (AR)</label>
                                        <input type="text" id="name_ar" name="name_ar" class="form-control" value="{{ $subscription->name_ar }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description_en">Description (EN)</label>
                                <textarea class="form-control" name="description_en" id="description_en" cols="30" rows="10">{{ $subscription->description_en }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="description_ar">Description (AR)</label>
                                <textarea class="form-control" name="description_ar" id="description_ar" cols="30" rows="10">{{ $subscription->description_ar }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image" class="d-block">Image</label>
                                <input type="file" name="image" id="image">
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="duration">Duration (Days)</label>
                                        <input type="number" min="1" class="form-control" name="duration" id="duration" value="{{ $subscription->duration }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" min="1" class="form-control" name="price" id="price" value="{{ $subscription->price }}">
                                    </div>
                                </div>
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
