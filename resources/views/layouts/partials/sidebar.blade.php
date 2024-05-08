<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @foreach (config('menu.' . Auth::user()->getCurrentUserRole()) as $menuItem)
                    @if (isset($menuItem['title']))
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">{{ $menuItem['text'] }}</span></li>
                    @elseif (isset($menuItem['submenu']))
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <i data-feather="{{ $menuItem['icon'] }}" class="feather-icon"></i>
                                <span class="hide-menu">{{ $menuItem['text'] }}</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                @foreach ($menuItem['submenu'] as $submenuItem)
                                    <li class="sidebar-item">
                                        <a href="{{ $submenuItem['url'] }}" class="sidebar-link">
                                            <span class="hide-menu">{{ $submenuItem['text'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="sidebar-item">
                            <a class="sidebar-link sidebar-link" href="{{ $menuItem['url'] }}" aria-expanded="false">
                                <i data-feather="{{ $menuItem['icon'] }}" class="feather-icon"></i>
                                <span class="hide-menu">{{ $menuItem['text'] }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
