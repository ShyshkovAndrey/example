<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard')}}">
                            {{__('back_sidebar.dashboard')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">

                            {{__('back_sidebar.users')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('roles.index') }}">

                            {{__('back_sidebar.roles')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('languages.index') }}">

                            {{__('back_sidebar.languages')}}
                        </a>
                    </li>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>{{__('back_sidebar.content_management')}}</span>
                    </h6>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('news.index') }}">

                            {{__('back_sidebar.news')}}
                        </a>
                    </li>

                    {{-- <li class="nav-item">
                         <a class="nav-link" href="#">
                             <span data-feather="bar-chart-2"></span>
                             Reports
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="#">
                             <span data-feather="layers"></span>
                             Integrations
                         </a>
                     </li>--}}
                </ul>

            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">