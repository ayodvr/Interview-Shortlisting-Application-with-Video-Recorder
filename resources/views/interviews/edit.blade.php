@extends('layouts.master')
@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h3 class="mb-sm-0 font-size-18">Send Mail</h3>

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
                            <form id="external_group" method="POST" action="{{route('interview.update', $interview->id)}}">
                                {{method_field('PUT')}}
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="validationCustom01"
                                            placeholder="Subject" id="subject" name="subject" required>
                                        </div>
                                        <small class="text-danger subject" style="display: none">Subject field is required.</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div>
                                                <textarea required class="form-control" id="email_content" name="email_content" rows="5" placeholder="Content"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-danger email_content" style="display: none">Email contents is required.</small>
                                </div>
                                </div>
                            </div>
                            <input type="hidden" name="group_id" value="">
                    <!-- end card -->
                </div> <!-- end col -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th></th>
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
                                    <td class="text-center"><input name='group_id' type="checkbox" class="js-check-selected-row" 
                                        onclick="setGroupId(event)" value="{{$group->id}}"></td>
                                    {{-- <td>{{$group->id}}</td> --}}
                                    <td>{{$group->name}}</td>
                                    <td>{{$group->users_count}}</td>
                                    <td><a href="/groups/all/{{$group->id}}"><svg height="15pt" viewBox="0 0 512 511" width="15pt" xmlns="http://www.w3.org/2000/svg"><path d="m362.667969 512.484375h-298.667969c-35.285156 0-64-28.714844-64-64v-298.667969c0-35.285156 28.714844-64 64-64h170.667969c11.796875 0 21.332031 9.558594 21.332031 21.335938 0 11.773437-9.535156 21.332031-21.332031 21.332031h-170.667969c-11.777344 0-21.332031 9.578125-21.332031 21.332031v298.667969c0 11.753906 9.554687 21.332031 21.332031 21.332031h298.667969c11.773437 0 21.332031-9.578125 21.332031-21.332031v-170.667969c0-11.773437 9.535156-21.332031 21.332031-21.332031s21.335938 9.558594 21.335938 21.332031v170.667969c0 35.285156-28.714844 64-64 64zm0 0" fill="#607d8b"/><g fill="#42a5f5"><path d="m368.8125 68.261719-168.792969 168.789062c-1.492187 1.492188-2.496093 3.390625-2.921875 5.4375l-15.082031 75.4375c-.703125 3.496094.40625 7.101563 2.921875 9.640625 2.027344 2.027344 4.757812 3.113282 7.554688 3.113282.679687 0 1.386718-.0625 2.089843-.210938l75.414063-15.082031c2.089844-.429688 3.988281-1.429688 5.460937-2.925781l168.789063-168.789063zm0 0"/><path d="m496.382812 16.101562c-20.796874-20.800781-54.632812-20.800781-75.414062 0l-29.523438 29.523438 75.414063 75.414062 29.523437-29.527343c10.070313-10.046875 15.617188-23.445313 15.617188-37.695313s-5.546875-27.648437-15.617188-37.714844zm0 0"/></g></svg></a>
                                        &nbsp;&nbsp;
                                        {{-- <a href="{{route('users.kill', $user->id)}}"><svg height="16pt" viewBox="-64 0 512 512" width="16pt" xmlns="http://www.w3.org/2000/svg"><path d="m256 80h-32v-48h-64v48h-32v-80h128zm0 0" fill="#62808c"/><path d="m304 512h-224c-26.507812 0-48-21.492188-48-48v-336h320v336c0 26.507812-21.492188 48-48 48zm0 0" fill="#62808c"/><path d="m384 160h-384v-64c0-17.671875 14.328125-32 32-32h320c17.671875 0 32 14.328125 32 32zm0 0" fill="#77959e"/><path d="m260 260c-6.246094-6.246094-16.375-6.246094-22.625 0l-41.375 41.375-41.375-41.375c-6.25-6.246094-16.378906-6.246094-22.625 0s-6.246094 16.375 0 22.625l41.375 41.375-41.375 41.375c-6.246094 6.25-6.246094 16.378906 0 22.625s16.375 6.246094 22.625 0l41.375-41.375 41.375 41.375c6.25 6.246094 16.378906 6.246094 22.625 0s6.246094-16.375 0-22.625l-41.375-41.375 41.375-41.375c6.246094-6.25 6.246094-16.378906 0-22.625zm0 0" fill="#fff"/></svg></a> --}}
                                    </td>
                                </tr> 
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                            <br>
                            <div>
                                <button type="submit" onclick="submitExternals(event)" class="btn btn-success w-md">Send Links</button><span class="errors text-danger"  style="display: none">A validation error has occurred. Confirm all fields.</span>

                            </div>
                        </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>



        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
<script>

    function setGroupId(e){
        $('input[name="group_id"]').val(e.target.value);
    }
    function submitExternals(e) {
        e.preventDefault();
        if($('.js-check-selected-row:checked').length){
            $('.subject').hide();
            $('.email_content').hide();
            if ($('#subject').val() == "") {
                $('.subject').show();
                $('.errors').show();
            } else if ($('#email_content').val() == "") {
                $('.email_content').show();
                $('.errors').show();

            } else {
                if(confirm('You have selected ' + $('.js-check-selected-row:checked').length + ' Group(s), are you sure you want to proceed?')){
                    $("#external_group").submit();
                }
            }
        }else{
            alert('No Group(s) was selected.');
        }
        // throw new TypeError('wait');
    }

</script>
@endsection