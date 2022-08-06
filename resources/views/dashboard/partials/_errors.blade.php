@if($errors->any())
    <div class="alert alert-danger mb-0">
        @foreach($errors->all() as $error)
            <p class="mb-0">{{$error}}</p>
        @endforeach
    </div>
@endif

