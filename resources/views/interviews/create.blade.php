@extends('layouts.master')
@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
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
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Set interview questions</h4>

                        <div class="page-title-right">
                            {{-- <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Form Validation</li>
                            </ol> --}}
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h4 class="card-title">Bootstrap Validation - Normal</h4> --}}
                            {{-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with
                                HTML5 form validation–available in all our supported browsers.</p> --}}
                            <form  method="POST" action="{{route('interview.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="title" placeholder="Title" id="formrow-firstname-input">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control docs-date" name="expire"
                                                    placeholder="Expires" autocomplete="off">
                                            </div>
                                            <div class="docs-datepicker-container"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="number"
                                                    placeholder="Number of candidates" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div>
                                                <textarea class="form-control" name="instruction" rows="5" placeholder="Instruction to candidates"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <table class="table table-bordered" id="dynamicTable">  
                                        <tr>
                                            <th>Question</th>
                                        </tr>
                                        <tr>  
                                            <td><input type="text" class="form-control" name="question[]" id="formrow-firstname-input" placeholder="Enter question"/></td>   
                                            <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                                        </tr>  
                                    </table>
                                </div>
                                <br>
                                <input type="text" class="form-control docs-date" name="user_id" hidden="hidden" value="{{$user}}">

                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <script type="text/javascript">
   
        var i = 0;
           
        $("#add").click(function(){
       
            ++i;
       
            $("#dynamicTable").append('<tr><td><input type="text" name="question['+i+']" placeholder="Enter question" class="form-control" /></td><td><svg type="button" class="remove-tr" height="25pt" viewBox="-64 0 512 512" width="20pt" xmlns="http://www.w3.org/2000/svg"><path d="m256 80h-32v-48h-64v48h-32v-80h128zm0 0" fill="#62808c"/><path d="m304 512h-224c-26.507812 0-48-21.492188-48-48v-336h320v336c0 26.507812-21.492188 48-48 48zm0 0" fill="#e76e54"/><path d="m384 160h-384v-64c0-17.671875 14.328125-32 32-32h320c17.671875 0 32 14.328125 32 32zm0 0" fill="#77959e"/><path d="m260 260c-6.246094-6.246094-16.375-6.246094-22.625 0l-41.375 41.375-41.375-41.375c-6.25-6.246094-16.378906-6.246094-22.625 0s-6.246094 16.375 0 22.625l41.375 41.375-41.375 41.375c-6.246094 6.25-6.246094 16.378906 0 22.625s16.375 6.246094 22.625 0l41.375-41.375 41.375 41.375c6.25 6.246094 16.378906 6.246094 22.625 0s6.246094-16.375 0-22.625l-41.375-41.375 41.375-41.375c6.246094-6.25 6.246094-16.378906 0-22.625zm0 0" fill="#fff"/></svg></td></tr>');
        });
       
        $(document).on('click', '.remove-tr', function(){  
             $(this).parents('tr').remove();
        });  
    </script>
</div>
@endsection