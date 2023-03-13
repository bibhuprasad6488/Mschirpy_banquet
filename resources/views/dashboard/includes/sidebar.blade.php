<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="active">
                    <a class="{{ request()->is('home') ? 'active' : '' }}" href="/home"><i class="fe fe-home"
                            style="font-size: 18px;"></i> <span>Dashboard</span></a>
                </li>
                @if (!empty(Auth::user()->getRoleNames()))
                @if (Auth::user()->getRoleNames()[0] == 'Super Admin')
                <li class="submenu">
                    <a href="#"><i class="fa fa-database"></i> <span> Master </span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li>
                            <a class="{{ request()->is('department*') ? 'active' : '' }}" href="/department_list">
                                Manage Department </a>
                        </li>
                        <li>
                            <a class="{{ request()->is('manage_roles*') ? 'active' : '' }}" href="/manage_roles"><span>
                                    Manage Roles</span></a>
                        </li>
                        <li>
                            <a class="{{ request()->is('staff_list') ? 'active' : '' }}" href="/staff_list"><span>
                                    Manage Staffs</span></a>
                        </li>
                        <li>
                            <a class="{{ request()->is('vendor_list*') ? 'active' : '' }}" href="/vendor_list"><span>
                                    Manage Vendors</span></a>
                        </li>
                        <li>
                            <a class="" href="/customer_list"><span> Customer List</span></a>
                        </li>


                    </ul>

                </li>
                @endif
                @endif

                <!-- <li>
                    <a href="/permission"><i class="fa fa-user-o" aria-hidden="true" style="font-size: 18px;"></i>
                        <span> Manage Permissions</span></a>
                </li>  -->

                <li class="menu-title">
                    <span>Pages</span>
                </li>
                @if (!empty(Auth::user()->getRoleNames()))

                @if (Auth::user()->getRoleNames()[0] == 'Chef')
                <li>
                    <a class="{{ request()->is('request-form') ? 'active' : '' }}" href="/request-form"><i
                            class="fa fa-file-text" aria-hidden="true"></i>
                        <span>Request Form</span> </a>
                </li>
                @endif
                @endif

                @canany(['manage_business.read'])

                <li class="submenu">
                    <a href="#"><i class="fa fa-briefcase"></i> <span> Business </span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        @can('manage_business.read')
                        <li><a class="{{ request()->is('business') ? 'active' : '' }}"
                                href="{{ route('business.index') }}"> Manage Business Detail </a></li>
                        @endcan
                    </ul>
                </li>
                @endcanany
                @canany(['cuisine.read', 'categories.read', 'sub_categories.read', 'venue_type.read', 'amenity.read',
                'items.read', 'menu.read', 'packages.read', 'venues.read'])
                <li class="submenu">
                    <a href="#"><i class="fa fa-server"></i> <span> Menus </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        @can('cuisine.read')
                        <li><a class="{{ request()->is('cuisine*') ? 'active' : '' }}"
                                href="{{ route('cuisine.index') }}"> Manage Cuisines </a></li>
                        @endcan
                        @can('categories.read')
                        <li><a class="{{ request()->is('category*') ? 'active' : '' }}"
                                href="{{ route('category.index') }}"> Manage Categories </a></li>
                        @endcan
                        {{-- @can('sub_categories.read')
                                <li><a class="{{ request()->is('subcategory*') ? 'active' : '' }}"
                        href="{{ route('subcategory.index') }}"> Manage Sub Categories </a>
                </li>
                @endcan --}}
                @can('venue_type.read')
                <li><a class="{{ request()->is('venuetype*') ? 'active' : '' }}" href="{{ route('venuetype.index') }}">
                        Manage Venue Types </a></li>
                @endcan
                @can('amenity.read')
                <li><a class="{{ request()->is('amenity*') ? 'active' : '' }}" href="{{ route('amenity.index') }}">
                        Manage Amenities </a></li>
                @endcan
                @can('items.read')
                <li><a class="{{ request()->is('menu*') ? 'active' : '' }}" href="{{ route('menu.index') }}">
                        Manage Items </a></li>
                @endcan
                @can('menu.read')
                <li><a class="{{ request()->is('menu_for_items*') ? 'active' : '' }}"
                        href="{{ route('menu_for_items.index') }}"> Manage Menus </a></li>
                @endcan
                @can('packages.read')
                <li><a class="{{ request()->is('package*') ? 'active' : '' }}" href="{{ route('package.index') }}">
                        Manage Packages </a></li>
                @endcan
                @can('venues.read')
                <li><a class="{{ request()->is('venue*') ? 'active' : '' }}" href="{{ route('venue.index') }}"> Manage
                        Venues </a></li>
                @endcan
                <li><a class="{{ request()->is('party*') ? 'active' : '' }}" href="{{ route('party.index') }}"> Manage
                        Party </a></li>
                <li class="submenu">
                    <a href="#"><span> Manage Taxes </span>
                        <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="" href="{{ route('tax_category.index') }}">Tax Categories</a></li>
                        <li><a class="" href="/list_subcat">Tax Sub Categories</a></li>
                    </ul>
                </li>
            </ul>
            </li>
            @endcanany

            @if (!empty(Auth::user()->getRoleNames()))
            @if (Auth::user()->getRoleNames()[0] != 'Chef')
            @canany(['brand.read', 'ingredient_item.read', 'ingredient_category.read', 'supplier.read'])
            <li class="submenu">
                <a href="#"><i class="fa fa-truck"></i> <span> Supplier </span> <span class="menu-arrow"></span></a>
                <ul style="display: none;">
                    @can('brand.read')
                    <li>
                        <a class="{{ request()->is('brand*') ? 'active' : '' }}" href="{{ route('brand.index') }}">
                            Manage Brand </a>
                    </li>
                    @endcan
                    @can('ingredient_item.read')
                    <li>
                        <a class="{{ request()->is('ingredient-item*') ? 'active' : '' }}"
                            href="{{ route('ingredient-item.index') }}"> Manage Ingredient Item </a>
                    </li>
                    @endcan

                    @can('ingredient_category.read')
                    <li>
                        <a class="{{ request()->is('ingredient_category*') ? 'active' : '' }}"
                            href="{{ route('ingredient_category.index') }}"> Manage Ingredient Category
                        </a>
                    </li>
                    @endcan
                    @can('supplier.read')
                    <li>
                        <a class="{{ request()->is('supplier*') ? 'active' : '' }}"
                            href="{{ route('supplier.index') }}"> Manage Suppliers </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcanany

            <li class="submenu">
                <a href="#"><i class="fa fa-line-chart"></i> <span> Report </span> <span class="menu-arrow"></span></a>
                <ul style="display: none;">
                    <li><a class="" href="/report/price_chart_report">Price chart report</a></li>
                </ul>
            </li>
            @endif
            @endif

            @can('event_booking.read')
            <li class="submenu">
                <a href="#"><i class="fa fa-ticket"></i> <span> Bookings </span> <span class="menu-arrow"></span></a>
                <ul style="display: none;">

                    {{-- <li><a class="{{ request()->is('all-event-bookings') ? 'active' : '' }}"
                    href="/all-event-bookings"> Booking Report </a>
            </li> --}}
            <li><a class="{{ request()->is('booking-report') ? 'active' : '' }}" href="/report/booking-report">
                    Booking Deatails </a></li>
            </ul>
            </li>
            @endcan
            @can('event_booking.read')
            <li class="submenu">
                <a href="#"><i class="fa fa-file-text"></i> <span>CMS</span> <span class="menu-arrow"></span></a>
                <ul style="display: none;">

                    <li><a class="{{ request()->is('create_page') ? 'active' : '' }}" href="/create_page"> Manage
                            Pages </a></li>
                    <li><a class="{{ request()->is('content') ? 'active' : '' }}" href="/content">Manage
                            Contents</a></li>
                    <li><a class="{{ request()->is('faq') ? 'active' : '' }}" href="/faq">Manage
                            Faqs</a></li>

                </ul>
            </li>
            <li><a class="{{ request()->is('show_review') ? 'active' : '' }}" href="/show_review"> <i
                        class="fa fa-commenting-o" aria-hidden="true"></i>
                    <span>Customer Reviews </span></a>
            </li>
            @endcan



            </ul>
        </div>
    </div>
</div>