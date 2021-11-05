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
                            <h4 class="card-title">Manage candidates</h4>
                            <div class="text-sm-end">
                                <a href="{{route('candidates.create')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i>Add Candidate</a>
                                <a href="{{route('candidates.upload')}}" class="btn btn-info btn-rounded waves-effect waves-light mb-2 me-2" style="float: right"><i class="mdi mdi-upload me-1"></i>Upload Candidate</a>
                            </div>
                            <br>
                            <div class="table-responsive">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 table-check">
                                <thead class="table-light">
                                <tr>
                                    <th style="width: 20px;" class="align-middle">
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox" id="checkAll">
                                            <label class="form-check-label" for="checkAll"></label>
                                        </div>
                                    </th>
                                    {{-- <th>Id</th> --}}
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @if(!empty($candidates))
                                @foreach($candidates as $candidate)
                                <tr>
                                    <td>
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox" id="orderidcheck01">
                                        <label class="form-check-label" for="orderidcheck01"></label>
                                    </div>
                                </td>
                                    {{-- <td class="text-center"><input name='id[]' type="checkbox" id="checkItem" 
                                        value="{{$group->id}}"></td> --}}
                                    {{-- <td>{{$group->id}}</td> --}}
                                    <td class="align-middle">{{$candidate->name}}</td>
                                    <td class="align-middle">{{$candidate->email}}</td>
                                    <td class="align-middle">{{$candidate->phone}}</td>
                                    <td class="align-middle">
                                    {{-- <a href="/groups/all/{{$group->id}}" class="text-success">
                                    <i class="mdi mdi-eye-circle font-size-18"></i></a>
                                    &nbsp;&nbsp; --}}
                                    <a href ="{{route('candidates.edit', $candidate->id)}}" class="text-info">
                                    <i class="mdi mdi-pencil font-size-18"></i></a>
                                    &nbsp;&nbsp;
                                    <a href="{{route('candidates.kill', $candidate->id)}}" class="text-danger destroy-confirm" data-name ="{{ $candidate->name }}">
                                        <i class="mdi mdi-delete font-size-18"></i></a>
                                    </td>
                                </tr> 
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                            </div>
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