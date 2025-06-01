<div class="modal fade" id="addNewUnitModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form action="{{ route('units.store') }}" method="POST" name="frmSaveUnit" id="frmSaveUnit">
                        @csrf
                        <div class="form-group">
                            <label for="unit_name">Unit Name</label>
                            <input type="text" class="form-control" id="unit_name" name="unit_name" required>
                        </div>
                        <div class="form-group">
                            <label for="abbreviation">Abbreviation (optional)</label>
                            <input type="text" class="form-control" id="abbreviation" name="abbreviation">
                        </div>

                        <input type="hidden" id="merchantID" name="merchantID" class="form-control" value="{{ Auth::user()->accountID }}">
                        <button type="submit" class="btn btn-lg btn-primary mt-3 btnSaveUnit" name="btnSaveUnit" id="btnSaveUnit">Save Unit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn modal-close-btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                </div>
            </div>
        </div>
    </div>