<x-layouts.master title="Items" menutitle="Items">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>

    <div id="content" class="main-content">
      <div class="layout-px-spacing">
        <div class="col-12 mt-3 mb-3 mt-3 pull-right" style="text-align:right">
            <a href="{{ route('items.create') }}" class="btn-lg btn btn-info">Add New Item</a>
        </div>
        <div class="col-10 offset-1 mt-3 mb-3">
            <div class="card mt-3">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    <h3 class="text-white">View All Items</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered myDataTable">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Item Code</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Unit</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Cost Price</th>
                                <th>Selling Price</th>
                                <th>Reorder Level</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->item_code }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ Str::limit($item->description, 50) }}</td>
                                <td>{{ optional($item->category)->name }}</td>
                                <td>{{ optional($item->unit)->unit_name }}</td>
                                <td>
                                    <span class="badge {{ $item->available_quantity <= $item->reorder_level ? 'bg-danger' : 'bg-success' }}">
                                        {{ $item->available_quantity ?? 0 }}
                                    </span>
                                </td>
                                <td>{!! getStatusBadge($item->status) !!}</td>
                                <td>{{ number_format($item->cost_price, 2) }}</td>
                                <td>{{ number_format($item->selling_price, 2) }}</td>
                                <td>{{ number_format($item->reorder_level, 2) }}</td>
                                <td class="text-center">
                                    {{-- <a href="{{ route('items.show', $item->sn) }}"
                                    class="btn btn-sm btn-success"
                                    title="View">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </a> --}}
                                    <a href="{{ route('item_batches.create', $item->sn) }}"
                                    class="btn btn-sm btn-primary"
                                    title="Add Item Batch">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <!-- Box icon -->
                                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                                            <!-- Plus sign -->
                                            <line x1="12" y1="10" x2="12" y2="16" />
                                            <line x1="9" y1="13" x2="15" y2="13" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('items.edit', $item->sn) }}"
                                    class="btn btn-sm btn-info"
                                    title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 20h9"></path>
                                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"></path>
                                        </svg>
                                    </a>
                                    {{-- <form action="{{ route('items.destroy', $item->sn) }}"
                                        method="POST"
                                        style="display:inline-block;"
                                        onsubmit="return confirm('Delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                                                <path d="M10 11v6"></path>
                                                <path d="M14 11v6"></path>
                                                <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
                                            </svg>
                                        </button>
                                    </form> --}}
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
        <script src="{{ asset('@assets/plugins/table/datatable/datatables.js') }}"></script>
        <script src="{{ asset('@assets/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script>
            applySelect2([".cmbSelect2"]);
            applyDataTable();
        </script>
    </x-slot>
</x-layouts.master>
