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
                            <h4 class="card-title">Manage groups</h4>
                            <div class="text-sm-end">
                                <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-centers" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i>Add group</a>
                                <a href="{{route('groups.upload')}}" class="btn btn-info btn-rounded waves-effect waves-light mb-2 me-2" style="float: right"><i class="mdi mdi-upload me-1"></i>Upload group</a>
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
                                    <th>No of candidates</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @if(!empty($groups))
                                @foreach($groups as $group)
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
                                    <td class="align-middle">{{$group->name}}</td>
                                    <td class="align-middle">{{$group->candidates_count}}</td>
                                    <td class="align-middle">
                                    <a href="/groups/all/{{$group->id}}" class="text-success">
                                    <i class="mdi mdi-eye-circle font-size-18"></i></a>
                                    &nbsp;&nbsp;
                                    <a href ="#" class="text-info" id="editCompany" data-toggle="modal" data-target='#practice_modal' data-id="{{ $group->id }}">
                                    <i class="mdi mdi-pencil font-size-18"></i></a>
                                    &nbsp;&nbsp;
                                    <a href="{{route('groups.kill', $group->id)}}" class="text-danger destroy-confirm" data-name ="{{ $group->name }}">
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
<div class="modal fade bs-example-modal-center" id="practice_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <input type="hidden" id="color_id" name="color_id" value="">
            <div class="modal-header">
                <h5 class="modal-title-center">Edit Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="companydata">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                            <input type="text" class="form-control" id="name" name="name" value="" placeholder="Enter Group Name">
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <input type="submit" id="submit" class="form-control btn btn-primary" value="Update">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

        $(document).ready(function () {
            
            $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

        $('body').on('click', '#submit', function (event) {
            event.preventDefault()
            var id = $("#color_id").val();
            var name = $("#name").val();
        
            $.ajax({
            url: "{{ route('groups.store') }}" +'/' + id,
            type: "PUT",
            data: {
                id: id,
                name: name,
            },
            dataType: 'json',
            success: function (data) {
                //console.log(data);
                $('#companydata').trigger("reset");
                $('#practice_modal').modal('hide');
                window.location.reload(true);
            }
        });
        });
    
    $('body').on('click', '#editCompany', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.get("{{ route('groups.store') }}" +'/' + id + '/edit', function (data) {
            //console.log(data)
             $('#practice_modal').modal('show');
             $('#color_id').val(data.data.id);
             $('#name').val(data.data.name);
         })
    });
    
}); 
</script>


<div class="modal fade bs-example-modal-centers" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title-center">Add Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('groups.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                            <input type="text" class="form-control" name="name" id="formrow-firstname-input">
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <input type="submit" class="form-control btn btn-primary" value="Add">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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