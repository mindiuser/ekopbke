<div class="modal fade" id="edit-subbukubesar-modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b><i class="fa fa-book mr-10"></i> Edit Rekening Sub Buku Besar</b>
                <button type="button" class="close" title="close"><span aria-hidden="true" data-dismiss="modal">&times;</span><span class="hide">Close</span></button>
            </div>
            <div class="modal-body">
                <div class="modal-alert alert hide"></div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        JENIS REKENING
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select id="jenis-edit-form" name="jenis" class="form-control" disabled required>
                            <option value="">PILIH JENIS</option>
                            <?php if(!empty($jenis)){ foreach($jenis as $row) { ?>
                                <option value="<?php echo $row->ACCJENIS;?>"><?php echo $row->JENIS;?></option>;
                            <?php }} ?>
                        </select>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        KELOMPOK REKENING
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select id="kelompok-edit-form" name="kelompok" class="form-control" disabled required>
                            <option value="">PILIH KELOMPOK</option>
                        </select>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        BUKU BESAR
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select id="bukubesar-edit-form" name="bukubesar" class="form-control" disabled required>
                            <option value="">PILIH BUKU BESAR</option>
                        </select>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        KODE SUB BUKU BESAR
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="id" class="form-control" maxlength="7" disabled required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        SUB BUKU BESAR
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="keterangan" class="form-control" maxlength="200" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        GOLONGAN
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select id="golongan-edit-form" name="golongan" class="form-control" required>
                            <option value="">Pilih Golongan</option>
                            <option value="SYSTEM">SYSTEM</option>
                            <option value="USER">USER</option>
                        </select>
                    </div>
                </div>
                <div class="row small-list-margin hide">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        KU
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select id="ku-edit-form" name="ku" class="form-control">
                            <option value="">Pilih KU</option>
                            <option value="00">00</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="subbukubesar-edit-submit" class="btn btn-primary btn-sm">Simpan</button>
                <button type="button" id="subbukubesar-edit-cancel" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
</div>
