<x-layouts.master title="Add Item" menutitle="Add Item">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>

    <div id="content" class="main-content">
      <div class="layout-px-spacing">
        <div class="col-12 mt-3 mb-3 mt-3 pull-right" style="text-align:right">
                <a href="{{ route('items.index') }}" class="btn-lg btn btn-info">View Items</a>
                <a href="{{ route("items.bulk_upload") }}" class="btn-lg btn btn-success">Bulk Upload Items.</a>
        </div>
        <div class="col-10 offset-1 mt-3 mb-3">
            <div class="card mt-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Add New Item</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('items.store') }}" method="POST" name="frmSaveItem" id="frmSaveItem">
                        @csrf

                        <div class="row">

                            {{-- Name --}}
                            <div class="col-md-12 mb-4">
                                <label for="name" class="form-label">Name</label>
                                <input type="text"
                                    id="name"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="col-12 mb-4">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description"
                                        name="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Category --}}
                            <div class="col-md-3 mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="categoryID" class="form-label mb-2">Category</label>
                                    <a href="javascript:void(0)" class="text-end text-info text-bold" id="labelAddCategory">Add Category</a>
                                </div>
                                <select id="categoryID"
                                        name="categoryID"
                                        class="form-selec form-control cmbSelect2 categoryIDMain">
                                        {!! $category_list !!}
                                </select>
                                @error('categoryID')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Sub Category --}}
                            <div class="col-md-3 mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="categoryID" class="form-label mb-2">Sub Category</label>
                                    <a href="javascript:void(0)" class="text-end text-info text-bold" id="labelAddSubCategory">Add Sub Category</a>
                                </div>
                                <select id="subCategoryID"
                                        name="subCategoryID"
                                        class="form-select form-control cmbSelect">
                                    {!! $sub_category_list !!}
                                </select>
                                @error('categoryID')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- Unit --}}
                            <div class="col-md-3 mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="unitID" class="form-label mb-2">Unit</label>
                                    <a href="javascript:void(0)" class="text-end text-info text-bold" id="labelAddUnit">Add Unit</a>
                                </div>
                                <select id="unitID"
                                        name="unitID"
                                        class="form-select form-control cmbSelect2">
                                        {!! $unit_list !!}
                                </select>
                                @error('unitID')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="col-md-3 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select id="status"
                                        name="status"
                                        class="form-select @error('status') is-invalid @enderror form-control cmbSelect2">
                                    {!! $status_list !!}
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Cost Price --}}
                            <div class="col-md-4 mb-3">
                                <label for="cost_price" class="form-label">Cost Price</label>
                                <input type="number"
                                    step="0.01"
                                    id="cost_price"
                                    name="cost_price"
                                    class="form-control @error('cost_price') is-invalid @enderror"
                                    value="{{ old('cost_price', '0.00') }}">
                                @error('cost_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Selling Price --}}
                            <div class="col-md-4 mb-3">
                                <label for="selling_price" class="form-label">Selling Price</label>
                                <input type="number"
                                    step="0.01"
                                    id="selling_price"
                                    name="selling_price"
                                    class="form-control @error('selling_price') is-invalid @enderror"
                                    value="{{ old('selling_price', '0.00') }}">
                                @error('selling_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Reorder Level --}}
                            <div class="col-md-4 mb-3">
                                <label for="reorder_level" class="form-label">Reorder Level</label>
                                <input type="number"
                                    step="0.01"
                                    id="reorder_level"
                                    name="reorder_level"
                                    class="form-control @error('reorder_level') is-invalid @enderror"
                                    value="{{ old('reorder_level', '0.00') }}">
                                @error('reorder_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            
                        </div>

                        <input type="hidden" id="item_id" name="item_id" class="form-control" value="" />
                        <input type="hidden" id="item_code" name="item_code" class="form-control" value="" />
                        <input type="hidden" id="merchantID" name="merchantID" class="form-control" value="{{ Auth::user()->accountID }}">

                        <div class="text-right">
                            <button type="submit" name="btnSaveItem" id="btnSaveItem" class="btnSaveItem btn btn-primary btn-lg pull-right mt-5">Create Item</button>
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

    <x-modal-add-new-category />
    <x-modal-add-new-sub-category 
        :categoryList="$category_list" 
        :statusList="$status_list"
    />
    <x-modal-add-new-unit />
    <x-modal-add-new-warehouse />

</x-layouts.master>
