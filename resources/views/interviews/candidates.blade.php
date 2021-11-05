@extends('layouts.master')
@section('content')


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">All Candidates</h4>
                    </div>
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
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <div class="search-box me-2 mb-2 d-inline-block">
                                        {{-- <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Search...">
                                            <i class="bx bx-search-alt search-icon"></i>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="text-sm-end">
                                        <a href="{{route('users.create')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i>Add Candidate</a>
                                        <a href="{{route('candidates.upload')}}" class="btn btn-info btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i>Upload Candidates</a>
                                    </div>
                                </div><!-- end col-->
                            </div>
    
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
                                            <th class="align-middle">UUID</th>
                                            <th class="align-middle">Name</th>
                                            {{-- <th class="align-middle">Email</th> --}}
                                            <th class="align-middle">Role</th>
                                            <th class="align-middle">Phone</th>
                                            <th class="align-middle">Date</th>
                                            {{-- <th class="align-middle">View Details</th> --}}
                                            <th class="align-middle">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($candidates))
                                        @foreach($candidates as $candidate)
                                        <tr>
                                            {{-- <td class="text-center"><input name='id[]' type="checkbox" id="checkItem" 
                                                value="{{$group->id}}"></td> --}}
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="orderidcheck01">
                                                    <label class="form-check-label" for="orderidcheck01"></label>
                                                </div>
                                            </td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#{{$candidate->uuid}}</a> </td>
                                            <td>{{$candidate->name}}</td>
                                            {{-- <td>
                                                {{$candidate->email}}
                                            </td> --}}
                                            @if(!empty($candidate->getRoleNames()))
                                            @foreach($candidate->getRoleNames() as $v)
                                            @if($v == 'candidate')
                                            <td>
                                                <span class="badge rounded-pill bg-success font-size-12">{{ $v }}</span>
                                            </td>
                                            @endif
                                            @endforeach
                                            @endif
                                            <td>
                                                {{$candidate->phone}}
                                            </td>
                                            <td>
                                                {{$candidate['created_at']->diffForHumans()}}
                                            </td> 
                                            {{-- <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target=".orderdetailsModal">
                                                    View Details
                                                </button>
                                            </td> --}}
                                            <td>
                                                <div class="d-flex gap-3">
                                                    <a href="{{route('users.edit', $candidate->id)}}" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="{{route('users.kill', $candidate->id)}}" class="text-danger delete-confirm" data-name ="{{ $candidate->name }}">
                                                        <i class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <!-- Modal -->
    <div class="modal fade orderdetailsModal" tabindex="-1" role="dialog" aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=orderdetailsModalLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">Product id: <span class="text-primary">#SK2540</span></p>
                    <p class="mb-4">Billing Name: <span class="text-primary">Neal Matthews</span></p>

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead>
                                <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <div>
                                            <img src="assets/images/product/img-7.png" alt="" class="avatar-sm">
                                        </div>
                                    </th>
                                    <td>
                                        <div>
                                            <h5 class="text-truncate font-size-14">Wireless Headphone (Black)</h5>
                                            <p class="text-muted mb-0">$ 225 x 1</p>
                                        </div>
                                    </td>
                                    <td>$ 255</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <div>
                                            <img src="assets/images/product/img-4.png" alt="" class="avatar-sm">
                                        </div>
                                    </th>
                                    <td>
                                        <div>
                                            <h5 class="text-truncate font-size-14">Hoodie (Blue)</h5>
                                            <p class="text-muted mb-0">$ 145 x 1</p>
                                        </div>
                                    </td>
                                    <td>$ 145</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h6 class="m-0 text-right">Sub Total:</h6>
                                    </td>
                                    <td>
                                        $ 400
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h6 class="m-0 text-right">Shipping:</h6>
                                    </td>
                                    <td>
                                        Free
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h6 class="m-0 text-right">Total:</h6>
                                    </td>
                                    <td>
                                        $ 400
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
    
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Skote.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by Themesbrand
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<script>
    $('.delete-confirm').on('click', function (event) {
      var name = $(this).data("name");
      event.preventDefault();
      const url = $(this).attr('href');
        swal({
            title:  `Are you sure you want to delete ${name}?`,
            text: 'This group will be permanantly deleted!',
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

