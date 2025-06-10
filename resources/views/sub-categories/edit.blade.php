<x-layouts.master title="Edit Sub Category" menutitle="Edit  Sub Category">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="col-12 mt-3 mb-3 mt-3 pull-right" style="text-align:right">
                    <a href="{{ route('sub-categories.create') }}" class="btn-lg btn btn-primary">Add Sub Category</a>
            </div>
    
            <div class="col-8 offset-2 mt-3 mb-3">
                <div class="card mt-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white">Edit Sub Category</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sub-categories.update', $category->sn) }}" method="POST" name="frmSaveSubCategory" id="frmSaveSubCategory">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Sub Category Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status <small class="text-bold text-danger">(required)</small></label>
                                <select class="form-control cmbSelect2" id="status" name="status" required>
                                     {{!! $status !!}}
                                </select>
                            </div>
                            <input type="hidden" id="merchantID" name="merchantID" class="form-control" value="{{ Auth::user()->accountID }}">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary mt-3 btnSaveSubCategory" name="btnSaveSubCategory" id="btnSaveSubCategory">Update Sub Category</button>
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
            applyDataTable();
            saveSubCategory();
        </script>
    </x-slot>
</x-layouts.master>
