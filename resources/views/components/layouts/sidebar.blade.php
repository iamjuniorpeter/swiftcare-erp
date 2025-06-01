<!--  BEGIN SIDEBAR  -->
@php

$logged_in_user = Auth()->user();
$account_type = $logged_in_user->accountType->code;
$account_role = $logged_in_user->accountRole->code;
$account_category = $logged_in_user->accountCategory->code;

@endphp
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <ul class="navbar-nav theme-brand flex-row  text-center p-2">
            <li class="nav-item theme-logo">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('@assets/img/logo-t.png') }}" class="navbar-logo" alt="logo">
                    &nbsp;&nbsp;
                    <span class="text-white" style="font-size:17px">SwiftCare Distribution</span>
                </a>
            </li>
            <!-- <li class="nav-item theme-text">
                <a href="{{ route('dashboard') }}" class="nav-link"> SwiftCare </a>
            </li> -->
        </ul>


        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                        <circle cx="12" cy="12" r="1"></circle>
                        <circle cx="19" cy="12" r="1"></circle>
                        <circle cx="5" cy="12" r="1"></circle>
                    </svg><span class="text-wrap text-primary font-weight-bold">Account Type: {{ ucwords($account_type) }}</span></div>
            </li>
            <a aria-expanded="true"></a>

            <li class="menu {{ $menutitle == 'dashboard' ? 'active': ''}}">
                <a href="{{ route('dashboard') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>

            {{-- <li class="menu {{ $menutitle == 'Inventory' ? 'active': ''}}">
                <a href="{{ route('inventory.dashboard') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout nav-icon me-2 icon-xxs"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>

                        <span>Inventory</span>
                    </div>
                </a>
            </li> --}}

            <li class="menu {{ $menutitle == 'inventory' ? 'active': ''}}">
                <a href="#manage-inventory" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout nav-icon me-2 icon-xxs"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                        <span>Inventory</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="manage-inventory" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('items.create') }}"> Products / Items </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'all') }}"> Locations </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.create') }}"> Categories </a>
                    </li>
                    <li>
                        <a href="{{ route('units.create') }}"> Units </a>
                    </li>
                    <li>
                        <a href="{{ route('items.index') }}"> Batches </a>
                    </li>
                </ul>
            </li>

            <li class="contact-admin menu {{ $menutitle == 'order-sales' ? 'active': ''}}">
                <a href="javascript:void(0)" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <!-- Custom Inventory Icon: Stacked Boxes in a Warehouse Frame -->
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                          <rect x="3" y="7" width="13" height="13" rx="2" />
                          <path d="M8 7V3h8a2 2 0 0 1 2 2v10" />
                          <path d="M16 21l5-5" />
                          <circle cx="20" cy="16" r="1" />
                        </svg>

                        <span>Rentals</span>
                    </div>
                </a>
            </li>

            <li class="contact-admin menu {{ $menutitle == 'warehouse-logistics' ? 'active': ''}}">
                <a href="javascript:void(0)" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                          <path d="M9 2h6a2 2 0 0 1 2 2v1H7V4a2 2 0 0 1 2-2z"/>
                          <rect x="4" y="5" width="16" height="16" rx="2" />
                          <path d="M9 14l2 2l4 -4" />
                        </svg>

                        <span>Procurement</span>
                    </div>
                </a>
            </li>

            <li class="contact-admin menu {{ $menutitle == 'forecast-insights' ? 'active': ''}}">
                <a href="javascript:void(0)" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart nav-icon me-2 icon-xxs"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
                        
                        <span>Forecasting</span>
                    </div>
                </a>
            </li>
            
            <li class="contact-admin menu {{ $menutitle == 'supplier-list' ? 'active': ''}}">
                <!-- {{ route('suppliers.index') }} -->
                <a href="javascript:void(0)" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <!-- Custom Inventory Icon: Stacked Boxes in a Warehouse Frame -->
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" 
                             stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" 
                             xmlns="http://www.w3.org/2000/svg">
                          <!-- Avatar -->
                          <circle cx="6" cy="7" r="3" />
                          <path d="M3 14c0-1.5 1.5-3 3-3s3 1.5 3 3v2H3v-2z" />
                          <!-- List -->
                          <line x1="12" y1="6" x2="21" y2="6" />
                          <line x1="12" y1="12" x2="21" y2="12" />
                          <line x1="12" y1="18" x2="21" y2="18" />
                        </svg>

                        <span>Supplier List</span>
                    </div>
                </a>
            </li>

            <li class="contact-admin menu {{ $menutitle == 'purchase-orders' ? 'active': ''}}">
                <a href="#manage-purchase-orders" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <!-- Custom Inventory Icon: Stacked Boxes in a Warehouse Frame -->
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" 
                             stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" 
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 2h8a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z" />
                            <path d="M9 12l2 2l4 -4" />
                            <line x1="9" y1="7" x2="15" y2="7" />
                            <line x1="9" y1="10" x2="15" y2="10" />
                        </svg>
                        <span>Purchase Orders</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <!--<ul class="collapse submenu list-unstyled" id="manage-purchase-orders" data-parent="#accordionExample">-->
                <!--    <li>-->
                <!--        <a href="{{ route('purchase_orders.create') }}"> New Purchase Order </a>-->
                <!--    </li>-->
                <!--    <li>-->
                <!--        <a href="{{ route('purchase_orders.index') }}"> View Purchase Order </a>-->
                <!--    </li>-->
                <!--    <li>-->
                <!--        <a href="{{ route('purchase_orders.index') }}"> Purchase Order Items </a>-->
                <!--    </li>-->
                <!--</ul>-->
            </li>
            
            <li class="contact-admin menu {{ $menutitle == 'cost-insights' ? 'active': ''}}">
                <a href="javascript:void(0)" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <!-- Custom Inventory Icon: Stacked Boxes in a Warehouse Frame -->
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" 
                             stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" 
                             xmlns="http://www.w3.org/2000/svg">
                          <circle cx="10" cy="10" r="7" />
                          <line x1="21" y1="21" x2="15" y2="15" />
                          <text x="7" y="13" font-size="8" font-family="Arial" fill="currentColor">$</text>
                        </svg>


                        <span>Cost Insights</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ $menutitle == 'reports' ? 'active': ''}}">
                <a href="{{ route('reports.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <!-- Custom Inventory Icon: Stacked Boxes in a Warehouse Frame -->
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4h16v16H4z" />
                            <path d="M8 16v-4" />
                            <path d="M12 16v-6" />
                            <path d="M16 16v-2" />
                        </svg>

                        <span>Reports</span>
                    </div>
                </a>
            </li>

            @if(strtolower($account_type) == 'admin1' || strtolower($account_type) == 'staff1')
            <li class="menu {{ $menutitle == 'inventory-stock' ? 'active': ''}}">
                <a href="#manage-customers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <span>Inventory & Stock</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="manage-customers" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('customer.register') }}"> Manage Products </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'all') }}"> Stock Levels & Adjustments </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'all') }}"> Stock Movements </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'all') }}"> Low Stock Alerts </a>
                    </li>
                </ul>
            </li>

            <li class="menu {{ $menutitle == 'order-sales' ? 'active': ''}}">
                <a href="#manage-customers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <span>Orders & Sales</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="manage-customers" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('customer.register') }}"> Order Management </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'all') }}"> Order Tracking & Fulfillment </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'all') }}"> Customer Invoices </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'all') }}"> Returns & Refunds </a>
                    </li>
                </ul>
            </li>

            <li class="menu {{ $menutitle == 'warehouse-logistics' ? 'active': ''}}">
                <a href="#manage-customers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" >
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <span>Warehouse & Logistics</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="manage-customers" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('customer.register') }}"> Warehouse Overview </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'all') }}"> Stock Transfers </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'all') }}"> Storage Locations </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'all') }}"> Warehouse Reports </a>
                    </li>
                </ul>
            </li>

            <li class="menu {{ $menutitle == 'forecast-insights' ? 'active': ''}}">
                <a href="#manage-customers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <span>Forecast & Insights</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="manage-customers" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('customer.register') }}"> Demand Prediction </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'all') }}"> Sales Trends Analysis </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'all') }}"> Inventory Forecasting </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'all') }}"> Reports & Export </a>
                    </li>
                </ul>
            </li>

            <li class="menu {{ $menutitle == 'user-access-roles' ? 'active': ''}}">
                <a href="#manage-customers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <span>User Access & Roles</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="manage-customers" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('customer.register') }}"> Manage Users </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'all') }}"> Roles & Permissions </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'all') }}"> Activity Logs </a>
                    </li>
                </ul>
            </li>

            <li class="menu {{ $menutitle == 'system-settings' ? 'active': ''}}">
                <a href="#manage-customers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <span>System Settings</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="manage-customers" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('customer.register') }}"> General Configurations </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'all') }}"> Notifications & Alerts </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'all') }}"> API & Integrations </a>
                    </li>
                </ul>
            </li>
            
            <li class="menu {{ $menutitle == 'manage-customers' ? 'active': ''}}">
                <a href="#manage-customers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <span>Book an Appointment</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="manage-customers" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('customer.register') }}"> Book an Appointment </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'all') }}"> View All Customers </a>
                    </li>

                    @if(strtolower($account_role) == 'bmr' || strtolower($account_role) == 'mgr' || strtolower($account_role) == 'spr')
                    <li>
                        <a href="{{ route('customer.view', 'in-progress') }}"> View Pending Customers </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.view', 'confirmed') }}"> View Confirmed Customers </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif




        </ul>

    </nav>

</div>
<!--  END SIDEBAR  -->