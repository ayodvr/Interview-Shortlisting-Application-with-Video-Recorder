@extends('layouts.master')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">All sessions</h4>

                        {{-- <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Projects</a></li>
                                <li class="breadcrumb-item active">Projects Grid</li>
                            </ol>
                        </div> --}}

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                @foreach($sessions as $session)
                <div class="col-xl-4 col-sm-12">
                    <div class="card dark">
                        <div class="card-body">
                            <video width="300" height="200" controls>
                                <source src="{{ $session->video_blob }}" type="video/webm">
                            </video>
                        </div>
                        <div class="px-4 py-3 border-top">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item me-3">
                                    @if(!empty($name))
                                    <span class="badge bg-success">{{$name}}</span>
                                    @endif
                                </li>
                                <li class="list-inline-item me-3">
                                    <i class="bx bx-calendar me-1"></i>{{$session['created_at']->toDayDateTimeString()}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- end row -->
            {{ $sessions->links() }}
            <div class="row">
                <div class="col-lg-12">
                   
                </div>
            </div>
            <!-- end row -->
            
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    
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
@endsection