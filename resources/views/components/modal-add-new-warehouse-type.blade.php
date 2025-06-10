<div class="modal fade" id="addNewWarehouseTypeModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Location Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form action="{{ route('warehouse-type.store') }}" method="POST" name="frmSaveWarehouseType" id="frmSaveWarehouseType">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="code">Code</label>
                            <textarea class="form-control" id="code" name="code"></textarea>
                        </div>

                        <input type="hidden" id="merchantID" name="merchantID" class="form-control" value="{{ Auth::user()->accountID }}">

                        <button type="submit" class="btn btn-lg btn-primary mt-3 btnSaveWarehouseType" name="btnSaveWarehouseType" id="btnSaveWarehouseType">Save Location Type</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn modal-close-btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                </div>
            </div>
        </div>
    </div>