<x-layouts.master title="Add Sub Category" menutitle="Add Sub Category">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>

    <div id="content" class="main-content">
        <div class="layout-px-spacing mt-5">
            <div class="col-12 mt-3 mb-3 mt-3 pull-right" style="text-align:right">
                    <a href="{{ route('items.index') }}" class="btn-lg btn btn-primary">Go Back to Products</a>
            </div>
            <div class="col-8 offset-2 mt-3 mb-3">
                <div class="card mt-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white">Add New Sub Category</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sub-categories.store') }}" method="POST" name="frmSaveSubCategory" id="frmSaveSubCategory">
                            @csrf
                            <div class="form-group">
                                    <label for="categoryID">Select Category <small class="text-bold text-danger">(required)</small></label>
                                    <select class="form-control cmbSelect2" id="categoryID" name="categoryID" required>
                                        {{!! $category_list !!}}
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Sub Category Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status <small class="text-bold text-danger">(required)</small></label>
                                <select class="form-control cmbSelect2" id="status" name="status" required>
                                    {{!! $status !!}}
                                </select>
                            </div>

                            <input type="hidden" id="merchantID" name="merchantID" class="form-control" value="{{ Auth::user()->accountID }}">
                            <div class="text-right">
                                <button type="submit" class="btn btn-lg btn-primary mt-3 btnSaveSubCategory" name="btnSaveSubCategory" id="btnSaveSubCategory">Save Sub Category</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>

            <br/><hr/><br/>

            <div class="col-8 offset-2 mt-3 mb-3">
                <div class="card mt-0">
                    <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                        <h3 class="text-white">View Sub Categories</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered myDataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->category->name }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ ucwords($category->status) }}</td>
                                    <td>
                                        <a href="{{ route('sub-categories.edit', $category->sn) }}" class="btn btn-info btn-sm">
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
            applySelect2([".cmbSelect2"]);
            applyDataTable();
            saveSubCategory();
        </script>
    </x-slot>
</x-layouts.master>
