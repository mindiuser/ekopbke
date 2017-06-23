<div class="modal fade" id="edit-jabatan-modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b><i class="fa fa-user mr-10"></i> Edit Jabatan</b>
            </div>
            <div class="modal-body">
                <div class="modal-alert alert hide"></div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        Bagian
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select name="bagian" class="form-control" disabled required>
                            <option value="">-- PILIH BAGIAN --</option>
                            <?php if(!empty($bagian)){ foreach($bagian as $row) { ?>
                                <option value="<?php echo $row->BAGIAN;?>"><?php echo $row->BAGIAN;?></option>
                            <?php }}?>
                        </select>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        Nomor Urut
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="edit-urut" class="form-control" maxlength="2" required>
                        <input type="hidden" name="edit-urut-old" >
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        Nama Jabatan
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="edit-jabatan" class="form-control" maxlength="20" required>
                        <input type="hidden" name="edit-jabatan-old" >
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="jabatan-edit-submit" class="btn btn-primary btn-sm">Simpan</button>
                <button type="button" id="jabatan-edit-cancel" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
</div>
