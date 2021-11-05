@extends('layouts.master')
@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        {{-- <h4 class="mb-sm-0 font-size-18">Data Tables</h4> --}}
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
                        <div class="page-title-right">
                            {{-- <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Data Tables</li>
                            </ol> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">All Candidates</h4>

                            <a href="{{route('candidates.create')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" style="float: right"><i class="mdi mdi-plus me-1"></i>Add Candidate</a>
                            <br><br><br>
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>UUID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @if(!empty($groups))
                                @foreach($groups as $group)
                                @if ($group['name'] == 'admin') 
                                @continue
                                @endif
                                <tr>
                                    <td class="text-center"><input name='id[]' type="checkbox" id="checkItem" 
                                        value="{{$group->id}}"></td>
                                    <td>{{$group->uuid}}</td>
                                    <td>{{$group->name}}</td>
                                    <td>{{$group->email}}</td>
                                    <td>{{$group->phone}}</td>
                                    <td>
                                        <a href ="{{route('candidates.edit', $group->id)}}" class="text-info">
                                            <i class="mdi mdi-pencil font-size-18"></i></a>
                                            &nbsp;&nbsp;
                                        <a href="{{route('candidates.kill', $group->id)}}" class="text-danger destroy-confirm" data-name ="{{ $group->name }}">
                                            <i class="mdi mdi-delete font-size-18"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
<script>
    $('.destroy-confirm').on('click', function (event) {
      var name = $(this).data("name");
      event.preventDefault();
      const url = $(this).attr('href');
        swal({
            title:  `Are you sure you want to delete ${name}?`,
            text: 'This will be permanantly deleted!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
      });
});
</script>
@endsection