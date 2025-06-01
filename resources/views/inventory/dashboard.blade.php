<x-layouts.master title="Inventory Dashboard" menutitle="Inventory Dashboard">

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
                padding: 10px;
                border-radius: 50%;
                background: #f1f1f1;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                margin-right: 10px;
            }
            .inventory-counter {
                display: flex;
                align-items: center;
                padding: 15px;
                border: 1px solid #eaeaea;
                border-radius: 8px;
                margin-bottom: 20px;
                background-color: #fff;
            }
            .inventory-counter p {
                margin: 0;
            }
        </style>
    </x-slot>
    {{-- END PAGE LEVEL STYLES --}}

    <!-- BEGIN CONTENT AREA -->
    <div id="content" class="main-content">
        <div class="container-fluid p-4">
            <div class="row gy-4">
                <!--<div class="col-12 mb-3 pull-right" style="text-align:right">-->
                <!--    <a href="{{ route('items.create') }}" class="btn btn-rounded btn-primary">Add Item</a>-->
                <!--    <a href="{{ route('items.index') }}" class="btn btn-rounded btn-info">View Items</a>-->
                    
                <!--    <a href="{{ route('categories.create') }}" class="btn btn-rounded btn-dark">Manage Categories</a>-->
                    
                <!--    <a href="{{ route('units.create') }}" class="btn btn-rounded btn-dark">Manage Units</a>-->
                <!--</div>-->
                {{-- Inventory Overview Counters --}}
                <div class="col-12">
                    <h4 class="mb-3 fw-bold">Inventory Overview</h4>
                    <div class="row">
                        @php
                            $counters = [
                                ['title' => 'Total Items', 'value' => $stats['totalItems'], 'icon' => 'box'],
                                ['title' => 'Low Stock Alerts', 'value' => $stats['lowStockAlerts'], 'icon' => 'alert-triangle'],
                                ['title' => 'Out-of-Stock Items', 'value' => $stats['outOfStock'], 'icon' => 'x-circle'],
                                ['title' => 'Fast Moving Items', 'value' => $stats['fastMoving'], 'icon' => 'zap'] //"Items with over 100 units sold in the last 30 days"
                            ];
                        @endphp

                        @foreach ($counters as $counter)
                        <div class="col-xl-3 col-md-6 col-sm-12">
                            <div class="inventory-counter">
                                <div class="counter-icon text-primary">
                                    <i data-feather="{{ $counter['icon'] }}"></i>
                                </div>
                                <div>
                                    <p class="fw-semibold text-muted mb-1">{{ $counter['title'] }}</p>
                                    <h5 class="mb-0">{{ $counter['value'] }}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                {{-- Stock Movement Chart --}}
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header">
                            <h5 class="mb-0">Stock Movement</h5>
                        </div>
                        <div class="card-body">
                            <div id="stockMovementChart" class="chart-container"></div>
                        </div>
                    </div>
                </div>
                
                {{-- Reorder Trends Chart --}}
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header">
                            <h5 class="mb-0">Reorder Trends</h5>
                        </div>
                        <div class="card-body">
                            <div id="reorderTrendsChart" class="chart-container"></div>
                        </div>
                    </div>
                </div>
                
                {{-- Low Stock Items Table --}}
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header">
                            <h5 class="mb-0">Low Stock Items</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>Current Stock</th>
                                            <th>Reorder Level</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($lowStockItems as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->total_quantity }}</td>
                                                <td>{{ $item->reorder_level }}</td>
                                                <td>
                                                    <a href="{{ route('item_batches.create', $item->sn) }}" class="btn btn-sm btn-warning">Restock</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">No low stock items found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
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

                // Stock Movement Chart Options
                var stockMovementOptions = {
                    chart: {
                        type: 'bar',
                        height: 280
                    },
                    series: [{
                        name: 'Stock In',
                        data: [120, 150, 100, 180, 130, 170, 140, 200, 160, 180, 190, 220]
                    }, {
                        name: 'Stock Out',
                        data: [80, 90, 70, 110, 100, 130, 110, 150, 120, 130, 140, 160]
                    }],
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    },
                    colors: ['#5A8DEE', '#FF5B5C'],
                    tooltip: {
                        theme: 'dark'
                    }
                };
                var stockMovementChart = new ApexCharts(document.querySelector("#stockMovementChart"), stockMovementOptions);
                stockMovementChart.render();

                // Reorder Trends Chart Options
                var reorderTrendsOptions = {
                    chart: {
                        type: 'line',
                        height: 280
                    },
                    series: [{
                        name: 'Reorder Count',
                        data: [5, 12, 8, 15, 10, 18, 14, 20, 16, 22, 18, 25]
                    }],
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    },
                    colors: ['#39DA8A'],
                    tooltip: {
                        theme: 'dark'
                    }
                };
                var reorderTrendsChart = new ApexCharts(document.querySelector("#reorderTrendsChart"), reorderTrendsOptions);
                reorderTrendsChart.render();
            });
        </script>
        {{-- <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Feather Icons
                feather.replace();

                // Chart Data from Controller
                const months = @json($months);
                const stockIn = @json($stockIn);
                const stockOut = @json($stockOut);
                const reorderTrends = @json($reorderTrends);
                const topSellingLabels = @json($topSellingLabels);
                const topSellingData = @json($topSellingData);

                // Stock Movement
                new ApexCharts(document.querySelector("#stockMovementChart"), {
                    chart: { type: 'bar', height: 280 },
                    series: [
                        { name: 'Stock In', data: stockIn },
                        { name: 'Stock Out', data: stockOut }
                    ],
                    xaxis: { categories: months },
                    colors: ['#5A8DEE', '#FF5B5C'],
                    tooltip: { theme: 'dark' }
                }).render();

                // Reorder Trends
                new ApexCharts(document.querySelector("#reorderTrendsChart"), {
                    chart: { type: 'line', height: 280 },
                    series: [{ name: 'Reorder Count', data: reorderTrends }],
                    xaxis: { categories: months },
                    colors: ['#39DA8A'],
                    tooltip: { theme: 'dark' }
                }).render();

                // Top Selling Products
                new ApexCharts(document.querySelector("#topSellingProductsChart"), {
                    chart: { type: 'donut', height: 280 },
                    labels: topSellingLabels,
                    series: topSellingData,
                    colors: ['#00CFE8', '#FFA1A1', '#5A8DEE', '#39DA8A', '#FF5B5C'],
                    tooltip: { theme: 'dark' }
                }).render();
            });
        </script> --}}
    </x-slot>
    {{-- END PAGE LEVEL SCRIPTS --}}
    
</x-layouts.master>
