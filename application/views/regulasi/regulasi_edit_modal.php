<div class="modal fade" id="edit-bagian-modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b><i class="fa fa-user mr-10"></i> Edit Bagian</b>
            </div>
            <div class="modal-body">
                <div class="modal-alert alert hide"></div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        Nomor Urut
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="edit-urut" class="form-control" maxlength="2" required >
                        <input type="hidden" name="edit-urut-old" class="form-control">
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        Nama Bagian
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="edit-bagian" class="form-control" maxlength="20" required >
                        <input type="hidden" name="edit-bagian-old" class="form-control" >
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="bagian-edit-submit" class="btn btn-primary btn-sm">Simpan</button>
                <button type="button" id="bagian-edit-cancel" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
</div>
