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
                @if (!is_null(auth()->user()) && auth()->user()->hasanyRole('admin'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                {{-- <a href="{{route('candidates.upload')}}" class="btn btn-primary w-xs waves-effect waves-light" style="float: right">Upload Candidates</a> --}}
                                <h4 class="card-title mb-4">Create users</h4>
                                <br>
                                <form method="POST" action="{{route('users.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">First name</label>
                                            <input type="text" class="form-control" name="name" id="formrow-firstname-input">
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Assign Role</label>
                                                <select class="select2 form-control select2-multiple"
                                                    multiple="multiple" name="role[]" data-placeholder="">
                                                    <optgroup label="Roles">
                                                        @foreach($roles as $role)
                                                        @if($role->name === 'admin')
                                                            @continue
                                                        @endif
                                                        <option value="{{$role->id}}">
                                                            {{ $role->name }}
                                                        </option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="formrow-email-input" class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" id="formrow-email-input">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-phone-input" class="form-label">Phone</label>
                                                <input type="text" class="form-control" name="phone" id="formrow-phone-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="formrow-image-input" class="form-label">Image</label>
                                                <input type="file" class="form-control" name="image" id="formrow-image-input"
                                                accept="CandidatesImages/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                                <br><div><img id="output" style="width:100px"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Select Group</label>
                                                <select class="form-control select2" name="group_id">
                                                    <option></option>
                                                        <optgroup label="Groups">
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
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                @endif

                @if (!is_null(auth()->user()) && auth()->user()->hasanyRole('client'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                {{-- <a href="{{route('candidates.upload')}}" class="btn btn-primary w-xs waves-effect waves-light" style="float: right">Upload Candidates</a> --}}
                                <h4 class="card-title mb-4">Create user</h4>
                                <br>
                                <form method="POST" action="{{route('users.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">First name</label>
                                            <input type="text" class="form-control" name="name" id="formrow-firstname-input">
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Assign Role</label>
                                                <select class="select2 form-control select2-multiple"
                                                    multiple="multiple" name="role[]" data-placeholder="">
                                                    <optgroup label="Roles">
                                                        @foreach($roles as $role)
                                                        @if($role->name === 'client')
                                                            @continue
                                                        @endif
                                                        <option value="{{$role->id}}">
                                                            {{ $role->name }}
                                                        </option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="formrow-email-input" class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" id="formrow-email-input">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-phone-input" class="form-label">Phone</label>
                                                <input type="text" class="form-control" name="phone" id="formrow-phone-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="formrow-image-input" class="form-label">Image</label>
                                                <input type="file" class="form-control" name="image" id="formrow-image-input"
                                                accept="CandidatesImages/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                                <br><div><img id="output" style="width:100px"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Select Group</label>
                                                <select class="form-control select2" name="group_id">
                                                    <option></option>
                                                        <optgroup label="Groups">
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
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                @endif
                <!-- end row -->
                
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
@endsection
           