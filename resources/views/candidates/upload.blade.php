@extends('layouts.master')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            {{-- <h4 class="mb-sm-0 font-size-18">Form Layouts</h4> --}}

                            {{-- <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                    <li class="breadcrumb-item active">Form Layouts</li>
                                </ol>
                            </div> --}}
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
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{route('candidates.template')}}" class="btn btn-danger w-xs waves-effect waves-light" style="float: right">Download template</a>
                                <h4 class="card-title mb-4">Upload candidates</h4>
                                <br>
                                <form method="POST" action="{{route('import_Template')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                {{-- <label for="formrow-image-input" class="form-label">Image</label> --}}
                                                <input type="file" class="form-control" name="file" id="formrow-image-input">
                                            </div>
                                            <button type="submit" class="btn btn-primary w-md">Upload</button>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                {{-- <label class="form-label">Select Group</label> --}}
                                                <select class="form-control select2" name="group_id">
                                                    <option>Select Group</option>
                                                        <optgroup label="">
                                                            @foreach($groups as $group)
                                                            <option value="{{$group->id}}">
                                                                {{ $group->name }}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
                
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
@endsection
           