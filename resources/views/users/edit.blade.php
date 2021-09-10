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
                                <h4 class="card-title mb-4">Edit users</h4>
                                <br>
                                <form method="POST" action="{{route('users.update', $user->id)}}" enctype="multipart/form-data">
                                    {{method_field('PUT')}}
                                    @csrf
                                <input type="hidden" name="id" value="{{{ $user->id }}}"> 
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">First name</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" id="formrow-firstname-input">
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
                                                        <option value="{{ old('id', $role->id)}}"
                                                         {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                                                            {{ old('name', $role->name) }}
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
                                                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" id="formrow-email-input">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-phone-input" class="form-label">Phone</label>
                                                <input type="text" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}" id="formrow-phone-input">
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
                <!-- end row -->
                
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
@endsection
           