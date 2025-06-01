<div class="modal fade" id="addNewLocationModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form action="{{ route('warehouses.store') }}" method="POST" id="frmSaveWarehouse" name="frmSaveWarehouse">
                        @csrf
                        <div class="form-group">
                            <label for="name">Location Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Address (optional)</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <!-- Other fields such as contact_person, phone, email -->
                        <input type="hidden" id="warehouse_id" name="warehouse_id" class="form-control" value="">
                        <input type="hidden" id="merchantID" name="merchantID" class="form-control" value="{{ Auth::user()->accountID }}">
                        <button type="submit" name="btnSaveWarehouse" id="btnSaveWarehouse" class="btnSaveWarehouse btn btn-primary btn-lg pull-right mt-5">Save Location</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn modal-close-btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                </div>
            </div>
        </div>
    </div>