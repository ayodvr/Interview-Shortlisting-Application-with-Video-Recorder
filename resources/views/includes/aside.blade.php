 <!-- ========== Left Sidebar Start ========== -->
 <div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                {{-- <li class="menu-title" key="t-menu">Admin</li> --}}

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

                @elseif (!is_null(auth()->user()) && auth()->user()->hasanyRole('candidate'))

                <li class="menu-title" key="t-apps">Candidate</li>
                
                @endif

                @if (!is_null(auth()->user()) && auth()->user()->hasanyRole('admin'))
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-group"></i>
                        <span key="t-ecommerce">Clients</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="{{route('users.create')}}" key="t-products">Create user</a></li> --}}
                        <li><a href="{{route('users.index')}}" key="t-product-detail">Manage clients</a></li>
                    </ul>
                </li>
                @endif
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-group"></i>
                        <span key="t-invoices">Candidates</span>
                    </a>
                    @if (!is_null(auth()->user()) && auth()->user()->hasanyRole('client'))
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('adminCands')}}" key="t-wallet">Manage Candidates</a></li>
                    </ul>
                    @elseif(!is_null(auth()->user()) && auth()->user()->hasanyRole('admin'))
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('candidates.index')}}" key="t-wallet">Manage Candidates</a></li>
                    </ul>
                    @endif
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-group"></i>
                        <span key="t-invoices">Groups</span>
                    </a>
                    @if (!is_null(auth()->user()) && auth()->user()->hasanyRole('admin'))
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="{{route('groups.create')}}" key="t-wallet">Create group</a></li> --}}
                        <li><a href="{{route('groups.index')}}" key="t-wallet">Manage groups</a></li>
                    </ul>
                    @elseif (!is_null(auth()->user()) && auth()->user()->hasanyRole('client'))
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="{{route('groups.create')}}" key="t-wallet">Create group</a></li> --}}
                        <li><a href="{{route('groups.clients')}}" key="t-wallet">Manage groups</a></li>
                    </ul>
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