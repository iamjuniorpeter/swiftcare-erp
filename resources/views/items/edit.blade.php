{{-- resources/views/inventory/items/edit.blade.php --}}
<x-layouts.master title="Items" menutitle="Items">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="col-12 mt-3 mb-3" style="text-align:right">
                <a href="{{ route('items.index') }}" class="btn-lg btn btn-primary">Add New Item</a>
                <a href="{{ route('items.index') }}" class="btn-lg btn btn-info">View Items</a>
            </div>
            <div class="col-10 offset-1 mt-3 mb-3">
                <div class="card mt-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white">Edit Item</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('items.update', $item->sn) }}" method="POST" name="frmSaveItem" id="frmSaveItem">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            {{-- Name --}}
                            <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text"
                                    id="name"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $item->name) }}"
                                    required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>

                            {{-- Description --}}
                            <div class="col-12 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description"
                                        name="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        rows="3">{{ old('description', $item->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>

                            {{-- Category --}}
                            <div class="col-md-4 mb-3">
                            <label for="categoryID" class="form-label">Category</label>
                            <select id="categoryID"
                                    name="categoryID"
                                    class="form-select @error('categoryID') is-invalid @enderror form-control cmbSelect2">
                                <option value="">-- choose category --</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->sn }}"
                                    {{ old('categoryID', $item->categoryID) == $cat->sn ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('categoryID')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>

                            {{-- Unit --}}
                            <div class="col-md-4 mb-3">
                            <label for="unitID" class="form-label">Unit</label>
                            <select id="unitID"
                                    name="unitID"
                                    class="form-select @error('unitID') is-invalid @enderror form-control cmbSelect2">
                                <option value="">-- choose unit --</option>
                                @foreach($units as $unit)
                                <option value="{{ $unit->sn }}"
                                    {{ old('unitID', $item->unitID) == $unit->sn ? 'selected' : '' }}>
                                    {{ $unit->unit_name }}
                                </option>
                                @endforeach
                            </select>
                            @error('unitID')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>

                            {{-- Status --}}
                            <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status"
                                    name="status"
                                    class="form-select @error('status') is-invalid @enderror form-control cmbSelect2">
                                <option value="active" {{ old('status', $item->status)=='active'? 'selected':'' }}>Active</option>
                                <option value="inactive" {{ old('status', $item->status)=='inactive'? 'selected':'' }}>Inactive</option>
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
                                    value="{{ old('cost_price', $item->cost_price) }}">
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
                                    value="{{ old('selling_price', $item->selling_price) }}">
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
                                    value="{{ old('reorder_level', $item->reorder_level) }}">
                            @error('reorder_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>

                        {{-- Hidden fields --}}
                        <input type="hidden" id="item_id"   name="item_id"   value="{{ $item->item_id }}">
                        <input type="hidden" id="item_code" name="item_code" value="{{ $item->item_code }}">
                        <input type="hidden" id="merchantID" name="merchantID" value="{{ Auth::user()->accountID }}">

                        <button type="submit" name="btnSaveItem" id="btnSaveItem" class="btn btn-primary btn-lg pull-right mt-5">
                            Update Item
                        </button>
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
      saveItem(); // re-use your JS form handler
    </script>
</x-slot>
</x-layouts.master>
