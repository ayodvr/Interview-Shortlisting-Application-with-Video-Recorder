@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger" style="width:92%; margin:auto">
            {{$error}}</div>
    @endforeach
@endif

@if(session('success'))
        <div class="alert alert-success" style="width:92%; margin:auto">
    {{session('success')}}</div>
@endif

@if(session('error'))
        <div class="alert alert-danger" style="width:92%; margin:auto">
    {{session('error')}}</div>
@endif