<x-layouts.master title="Add Sales Order Item" menutitle="Add Sales Order Item">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>
    <div id="content" class="main-content">
        <div class="layout-px-spacing mt-5">
            <div class="col-8 offset-2 mt-3 mb-3">
                <div class="card mt-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white">Add New Sales Order Item</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sales_order_items.store') }}" method="POST" name="frmSalesOrderItem" id="frmSalesOrderItem">
                            @csrf
                            <div class="form-group">
                                <label for="name">Item</label>
                                <select id="itemID"
                                        name="itemID"
                                        class="form-selec form-control cmbSelect2">

                                        {!! $optionsHtml !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="qty">Quantity</label>
                                <input type="number"
                                    class="form-control"
                                    id="qty"
                                    name="qty"
                                    min="0"
                                    step="1"
                                    pattern="\d*"
                                    inputmode="numeric"
                                    required />
                            </div>

                            <div class="form-group">
                                <label for="customer name">Customer Name</label>
                                <input class="form-control" id="cust_name" name="cust_name" type="text" />
                            </div>

                            <div class="form-group">
                                <label for="customer email">Customer Email</label>
                                <input class="form-control" id="qty" type="text" name="qty" />
                            </div>

                            <input type="hidden" id="merchantID" name="merchantID" class="form-control" value="{{ Auth::user()->accountID }}">
                            <div class="text-right">
                                <button type="submit" class="btn btn-lg btn-primary mt-3 btnSaveSalesItem" name="btnSaveSalesItem" id="btnSaveSalesItem">Save Sale</button>
                            </div>

                        </form>
                    </div>
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
