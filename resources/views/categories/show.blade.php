<x-layouts.master title="View Category" menutitle="View Category">
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="card mt-3">
                <div class="card-header">
                    <h3>Category Details</h3>
                </div>
                <div class="card-body">
                    <p><strong>ID:</strong> {{ $category->sn }}</p>
                    <p><strong>Merchant ID:</strong> {{ $category->merchantID }}</p>
                    <p><strong>Name:</strong> {{ $category->name }}</p>
                    <p><strong>Description:</strong> {{ $category->description }}</p>
                    <a href="{{ route('categories.edit', $category->sn) }}" class="btn btn-warning">Edit Category</a>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.master>
