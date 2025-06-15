<x-layouts.master title="Sales Order Items" menutitle="Sales Order Items">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Sales Order Items</h3>
                    <a href="{{ route('sales_order_items.create') }}" class="btn btn-primary">Add New Sales Order</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Customer</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales_order_items as $soi)
                            <tr>
                                <td>{{ $soi->soi_id }}</td>
                                <td>{{ $soi->customer_name }}</td>
                                <td>{{ $soi->item->name  }}</td>
                                <td>{{ $soi->quantity }}</td>
                                <td>{{ number_format($soi->item->selling_price, 2) }}</td>
                                <td>{{ number_format($soi->item->selling_price *  $soi->quantity, 2) }}</td>
                                <td>
                                    <a href="{{ route('sales_order_items.invoice', $soi->soi_id) }}" target="blank" class="btn btn-info btn-sm">Invoice</a>
                                    {{-- <a href="{{ route('sales_order_items.edit', $soi->sn) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('sales_order_items.destroy', $soi->sn) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this item?');">Delete</button>
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
    <x-slot name="scripts">
        <script src="{{ asset('@assets/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script>
            applySelect2([".cmbSelect2"]);
            saveCategory();
            saveSubCategory();
            saveUnit();
            saveItem();
            saveWarehouse();
            showModal("#labelAddUnit", "#addNewUnitModal");
            showModal("#labelAddCategory", "#addNewCategoryModal");
            showModal("#labelAddSubCategory", "#addNewSubCategoryModal");
            showModal("#labelAddLocation", "#addNewLocationModal");
            getSubCategoryByCategory();
            //applySelect2OnModal(".cmbSelect2", "#addNewSubCategoryModal");
        </script>
    </x-slot>
</x-layouts.master>
