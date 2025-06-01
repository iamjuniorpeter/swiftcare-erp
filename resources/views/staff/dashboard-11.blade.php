<x-layouts.master title="Dashboard" menutitle="dashboard">

    {{-- PAGE LEVEL STYLES --}}
    <x-slot name="styles">
        <link href="{{ asset('@assets/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('@assets/css/dashboard/dashui.css') }}" rel="stylesheet" type="text/css" />
        <style>
            .card h5 {
                font-weight: 600;
            }

            .chart-container {
                height: 280px;
            }

            .counter-icon {
                font-size: 24px;
                padding: 12px;
                border-radius: 50%;
                background: #f1f1f1;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 10px;
            }
        </style>
    </x-slot>
    {{-- END PAGE LEVEL STYLES --}}

    <!-- BEGIN CONTENT AREA -->
    <div id="content" class="main-content">
        <div class="container-fluid p-4">
            <div class="row">

                <!-- KPI CARDS GROUPED -->
                @php $groups = array_chunk([
                ['title' => 'Total Orders', 'value' => '1,245', 'icon' => 'shopping-cart'],
                ['title' => 'Pending Orders', 'value' => '230', 'icon' => 'clock'],
                ['title' => 'Completed Orders', 'value' => '1,015', 'icon' => 'check-circle'],
                ['title' => 'Revenue (MTD)', 'value' => '$125,980', 'icon' => 'dollar-sign'],
                ['title' => 'Total Expenses', 'value' => '$45,000', 'icon' => 'trending-down'],
                ['title' => 'Stock Levels', 'value' => '5,300 Items', 'icon' => 'package'],
                ['title' => 'Low-Stock Alerts', 'value' => '15 Items', 'icon' => 'alert-triangle'],
                ['title' => 'Out-of-Stock Items', 'value' => '8 Items', 'icon' => 'x-circle'],
                ['title' => 'Active Warehouses', 'value' => '4', 'icon' => 'home'],
                ['title' => 'Warehouse Capacity', 'value' => '75% Utilized', 'icon' => 'bar-chart-2'],
                ['title' => 'Total Customers', 'value' => '3,500', 'icon' => 'users'],
                ['title' => 'New Customers', 'value' => '150', 'icon' => 'user-plus'],
                ['title' => 'Top-Selling Products', 'value' => 'Product A', 'icon' => 'star'],
                ['title' => 'Total Users', 'value' => '85', 'icon' => 'user'],
                ['title' => 'Pending Approvals', 'value' => '12', 'icon' => 'file-text']
                ], 3); @endphp

                @foreach ($groups as $group)
                <div class="col-xl-12 mb-4">
                    <div class="row">
                        @foreach ($group as $item)
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 mb-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <div class="counter-icon text-primary">
                                        <i data-feather="{{ $item['icon'] }}"></i>
                                    </div>
                                    <h6 class="text-muted fw-semibold">{{ $item['title'] }}</h6>
                                    <h4 class="text-dark fw-bold mb-0">{{ $item['value'] }}</h4>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
                <!-- END KPI CARDS -->

                <!-- CHARTS SECTION -->
                @foreach ([
                'Sales vs. Expenses' => ['id' => 'salesExpensesChart', 'type' => 'area'],
                'Sales Trends' => ['id' => 'salesTrendsChart', 'type' => 'line'],
                'Stock Movement' => ['id' => 'stockMovementChart', 'type' => 'bar'],
                'Top Selling Products' => ['id' => 'topSellingProductsChart', 'type' => 'donut'],
                'Orders Status Breakdown' => ['id' => 'ordersStatusChart', 'type' => 'pie'],
                'Warehouse Utilization' => ['id' => 'warehouseUtilizationChart', 'type' => 'radialBar'],
                'Customer Growth Rate' => ['id' => 'customerGrowthChart', 'type' => 'area'],
                'Profit Margin Analysis' => ['id' => 'profitMarginChart', 'type' => 'bar'],
                'Employee Activity' => ['id' => 'employeeActivityChart', 'type' => 'heatmap'],
                'Forecasted Demand vs. Stock' => ['id' => 'forecastDemandChart', 'type' => 'bar']
                ] as $title => $chart)
                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <h5 class="mb-3 text-dark">{{ $title }}</h5>
                            <div id="{{ $chart['id'] }}" class="chart-container"></div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- END CHARTS SECTION -->

                <!-- TABLES SECTION -->
                @foreach ([
                'Recent Orders' => ['Order ID', 'Customer', 'Amount', 'Status'],
                'Low Stock Items' => ['Product', 'Stock Level', 'Reorder Level'],
                'Recent Customer Registrations' => ['Customer Name', 'Date Registered'],
                'Recent Transactions' => ['Invoice ID', 'Amount', 'Date'],
                'Pending Shipments' => ['Order ID', 'Destination', 'Status'],
                'Employee Activity Log' => ['User', 'Action', 'Timestamp'],
                'Warehouse Transfers Log' => ['Transfer ID', 'From', 'To', 'Quantity'],
                'Outstanding Payments' => ['Customer', 'Amount', 'Due Date']
                ] as $title => $columns)
                <div class="col-xl-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="mb-3">{{ $title }}</h5>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            @foreach ($columns as $col)
                                            <th class="text-muted">{{ $col }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="{{ count($columns) }}" class="text-center text-muted">Sample Data</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- END TABLES SECTION -->

            </div>
        </div>
    </div>
    <!-- END CONTENT AREA -->

    {{-- PAGE LEVEL SCRIPTS --}}
    <x-slot name="scripts">
        <script src="{{ asset('@assets/plugins/apex/apexcharts.min.js') }}"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                feather.replace();

                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

                const charts = {
                    salesExpensesChart: {
                        type: 'area',
                        multiSeries: [{
                                name: 'Sales',
                                data: months.map(() => Math.floor(Math.random() * 10000))
                            },
                            {
                                name: 'Expenses',
                                data: months.map(() => Math.floor(Math.random() * 8000))
                            }
                        ],
                        categories: months
                    },
                    salesTrendsChart: {
                        type: 'line',
                        multiSeries: [{
                            name: 'Sales',
                            data: months.map(() => Math.floor(Math.random() * 10000))
                        }],
                        categories: months
                    },
                    stockMovementChart: {
                        type: 'bar',
                        multiSeries: [{
                                name: 'Stock In',
                                data: months.map(() => Math.floor(Math.random() * 3000))
                            },
                            {
                                name: 'Stock Out',
                                data: months.map(() => Math.floor(Math.random() * 2500))
                            }
                        ],
                        categories: months
                    },
                    topSellingProductsChart: {
                        type: 'donut',
                        labels: ['Product A', 'Product B', 'Product C'],
                        series: [44, 55, 41]
                    },
                    ordersStatusChart: {
                        type: 'pie',
                        labels: ['Shipped', 'Pending', 'Processing', 'Canceled'],
                        series: [400, 300, 200, 100]
                    },
                    warehouseUtilizationChart: {
                        type: 'radialBar',
                        labels: ['Utilized'],
                        series: [75]
                    },
                    customerGrowthChart: {
                        type: 'area',
                        multiSeries: [{
                            name: 'New Customers',
                            data: months.map(() => Math.floor(Math.random() * 500))
                        }],
                        categories: months
                    },
                    profitMarginChart: {
                        type: 'bar',
                        multiSeries: [{
                            name: 'Profit %',
                            data: months.map(() => Math.floor(Math.random() * 100))
                        }],
                        categories: months
                    },
                    employeeActivityChart: {
                        type: 'heatmap',
                        series: months.map(month => ({
                            name: month,
                            data: Array.from({
                                length: 7
                            }, (_, i) => ({
                                x: `W${i + 1}`,
                                y: Math.floor(Math.random() * 100)
                            }))
                        }))
                    },
                    forecastDemandChart: {
                        type: 'bar',
                        multiSeries: [{
                                name: 'Forecasted Demand',
                                data: months.map(() => Math.floor(Math.random() * 3000))
                            },
                            {
                                name: 'Stock Available',
                                data: months.map(() => Math.floor(Math.random() * 3000))
                            }
                        ],
                        categories: months
                    }
                };

                Object.entries(charts).forEach(([id, cfg]) => {
                    const options = {
                        chart: {
                            type: cfg.type,
                            height: 280
                        },
                        colors: ['#5A8DEE', '#39DA8A', '#FF5B5C'],
                        tooltip: {
                            theme: 'dark'
                        }
                    };

                    if (cfg.multiSeries) {
                        options.series = cfg.multiSeries;
                        options.xaxis = {
                            categories: cfg.categories
                        };
                    } else if (cfg.type === 'heatmap') {
                        options.series = cfg.series;
                    } else {
                        options.series = cfg.series;
                        options.labels = cfg.labels;
                    }

                    new ApexCharts(document.querySelector(`#${id}`), options).render();
                });
            });
        </script>
    </x-slot>
    {{-- END PAGE LEVEL SCRIPTS --}}

</x-layouts.master>