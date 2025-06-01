<x-layouts.master title="Edit Category" menutitle="Edit Category">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="col-12 mt-3 mb-3 mt-3 pull-right" style="text-align:right">
                    <a href="{{ route('categories.create') }}" class="btn-lg btn btn-primary">Add Category</a>
            </div>
    
            <div class="col-8 offset-2 mt-3 mb-3">
                <div class="card mt-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white">Edit Category</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('categories.update', $category->sn) }}" method="POST" name="frmSaveCategory" id="frmSaveCategory">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description (optional)</label>
                                <textarea class="form-control" id="description" name="description">{{ $category->description }}</textarea>
                            </div>
                            <input type="hidden" id="merchantID" name="merchantID" class="form-control" value="{{ Auth::user()->accountID }}">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary mt-3 btnSaveCategory" name="btnSaveCategory" id="btnSaveCategory">Update Category</button>
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
            applyDataTable();
            saveCategory();
        </script>
    </x-slot>
</x-layouts.master>
