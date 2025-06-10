<div class="modal fade" id="addNewSubCategoryModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Sub Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form action="{{ route('sub-categories.store') }}" method="POST" name="frmSaveSubCategory" id="frmSaveSubCategory">
                            @csrf
                            <div class="form-group">
                                    <label for="categoryID">Select Category <small class="text-bold text-danger">(required)</small></label>
                                    <select class="form-control cmbSelect2" id="categoryID" name="categoryID" required>
                                        {{!! $categoryList !!}}
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Sub Category Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status <small class="text-bold text-danger">(required)</small></label>
                                <select class="form-control cmbSelect2" id="status" name="status" required>
                                    {{!! $statusList !!}}
                                </select>
                            </div>

                            <input type="hidden" id="merchantID" name="merchantID" class="form-control" value="{{ Auth::user()->accountID }}">
                            <div class="text-right">
                                <button type="submit" class="btn btn-lg btn-primary mt-3 btnSaveSubCategory" name="btnSaveSubCategory" id="btnSaveSubCategory">Save Sub Category</button>
                            </div>
                            
                        </form>
                </div>
                <div class="modal-footer">
                    <button class="btn modal-close-btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                </div>
            </div>
        </div>
    </div>