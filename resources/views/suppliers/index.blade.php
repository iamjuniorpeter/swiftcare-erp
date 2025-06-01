<x-layouts.master title="Suppliers" menutitle="Suppliers">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>
    <div id="content" class="main-content">
       <div class="layout-px-spacing">
            <div class="col-12 mt-5 mb-3 mt-3 pull-right" style="text-align:right">
                <a href="{{ route('suppliers.create') }}" class="btn-lg btn btn-info">Add New Supplier</a>
            </div>
            <div class="col-10 offset-1 mt-5 mb-3">
                <div class="card mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center bg-primary">
                        <h3 class="text-white">Suppliers</h3>                        
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>sn</th>
                                    <th>Name</th>
                                    <th>Contact Person</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suppliers as $supplier)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->contact_person }}</td>
                                    <td>{{ $supplier->phone }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ $supplier->type }}</td>
                                    <td>{!! getStatusBadge($supplier->status) !!}</td>
                                    <td title="{{ $supplier->notes }}">{{ \Illuminate\Support\Str::limit($supplier->notes, 30, '...') }}</td>
                                    <td>
                                        <a href="{{ route('suppliers.edit', $supplier->supplier_id) }}" class="btn btn-warning btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 20h9"></path>
                                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
       </div>
    </div>
    <x-slot name="scripts">
        <script src="{{ asset('@assets/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script>
            applyDataTable();
            saveUnit();
        </script>
    </x-slot>
</x-layouts.master>
