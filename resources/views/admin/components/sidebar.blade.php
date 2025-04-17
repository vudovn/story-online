<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header py-5">
            <a href="{{ route('admin.dashboard') }}" class="b-brand text-primary">
                <img src="" class="img-fluid logo-lg" alt="logo" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                @foreach (__('sidebar.function') as $key => $val)
                    @if ($val['module'])
                        <li class="pc-item pc-hasmenu">
                            <a href="#!" class="pc-link">
                                <span class="pc-micon">
                                    {!! $val['icon'] !!}
                                </span>
                                <span class="pc-mtext">{{ $val['name'] }}</span>
                                <span class="pc-arrow">
                                    <i data-feather="chevron-right"></i>
                                </span>
                            </a>
                            <ul class="pc-submenu">
                                @foreach ($val['module'] as $module)
                                    <li class="pc-item">
                                        <a class="pc-link" href="{{ $module['path'] }}">{{ $module['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="pc-item">
                            <a href="{{ $val['route'] }}" class="pc-link">
                                <span class="pc-micon">
                                    {!! $val['icon'] !!}
                                </span>
                                <span class="pc-mtext">{{ $val['name'] }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</nav>
