<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @if (session()->has('message'))
                <div class="alert alert-{{ session()->get('alert-type') }}" role="alert" id="alert-message">
                    {{ session()->get('message') }}
                </div>
            @endif

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
        </div>
    </div>
</div>
