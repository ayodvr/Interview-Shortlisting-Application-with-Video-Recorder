 <!-- ========== Left Sidebar Start ========== -->
 <div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                {{-- <li class="menu-title" key="t-menu">Admin</li> --}}
                {{-- <hr> --}}
                <br>
                <li>
                    <a href="/index" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                @if (!is_null(auth()->user()) && auth()->user()->hasanyRole('admin'))

                <li class="menu-title" key="t-apps">Admin</li>

                @elseif (!is_null(auth()->user()) && auth()->user()->hasanyRole('client'))

                <li class="menu-title" key="t-apps">Client</li>
                @endif

                @if (!is_null(auth()->user()) && auth()->user()->hasanyRole('admin'))
                <li>
                    <a href="{{route('users.index')}}" class="waves-effect">
                        <i class="bx bx-group"></i>
                        <span key="t-ecommerce">Clients</span>
                    </a>
                </li>
                @endif
                
                <li>
                    @if (!is_null(auth()->user()) && auth()->user()->hasanyRole('client'))
                    <a href="{{route('adminCands')}}" class="waves-effect">
                        <i class="bx bx-group"></i>
                        <span key="t-invoices">Candidates</span>
                    </a>
                    @elseif(!is_null(auth()->user()) && auth()->user()->hasanyRole('admin'))
                    <a href="{{route('candidates.index')}}" class="waves-effect">
                        <i class="bx bx-group"></i>
                        <span key="t-invoices">Candidates</span>
                    </a>
                    @endif
                </li>
                
                <li>
                    @if (!is_null(auth()->user()) && auth()->user()->hasanyRole('admin'))
                    <a href="{{route('groups.index')}}" class="waves-effect">
                        <i class="bx bx-group"></i>
                        <span key="t-invoices">Groups</span>
                    </a>
                    @elseif (!is_null(auth()->user()) && auth()->user()->hasanyRole('client'))
                    <a href="{{route('groups.clients')}}" class="waves-effect">
                        <i class="bx bx-group"></i>
                        <span key="t-invoices">Groups</span>
                    </a>
                    @endif            
                </li>
                
                <li class="menu-title" key="t-pages">Interview</li>

                <li>
                    <a href="{{route('interview.create')}}" class="waves-effect">
                        <i class="bx bx-grid-small"></i>
                        <span key="t-authentication">Create Interview Batch</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('all_entries')}}" class="waves-effect">
                        <i class="bx bx-grid-small"></i>
                        <span key="t-authentication">All Entries</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->