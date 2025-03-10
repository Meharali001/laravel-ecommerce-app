<div>
            <!-- MENU SIDEBAR-->
            <aside class="menu-sidebar d-none d-lg-block">
                <div class="logo">
                    <a href="#">
                        <img src="{{ asset('assets/admin/images/icon/logo.png') }}" alt="Cool Admin" />
                    </a>
                </div>
                <div class="menu-sidebar__content js-scrollbar1">
                    <nav class="navbar-sidebar">
                        <ul class="list-unstyled navbar__list">
                            <li>
                                <a href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-table"></i>Dashboard</a>
                            </li>
                            {{-- <li>
                                <a  href="{{ route('admin.charts') }}">
                                    <i class="fas fa-chart-bar"></i>Charts</a>
                            </li> --}}
                            <li>
                                <a  href="{{ route('admin.site.category') }}">
                                    <i class="fas fa-chart-bar"></i>Categories</a>
                            </li>
                            <li>
                                <a  href="{{ route('admin.products') }}">
                                    <i class="fas fa-chart-bar"></i>Products</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.site.banner') }}">
                                    <i class="fas fa-table"></i>Banner</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.site.testimonials') }}">
                                    <i class="fas fa-table"></i>Testimonials</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.forms') }}">
                                    <i class="far fa-check-square"></i>Add User</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.calendar') }}">
                                    <i class="fas fa-calendar-alt"></i>Calendar</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <!-- END MENU SIDEBAR-->
</div>
