<div class="modal fade" id="add-bukubesar-modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b><i class="fa fa-book mr-10"></i> Tambahkan Rekening Buku Besar</b>
                <button type="button" class="close" title="close"><span aria-hidden="true" data-dismiss="modal">&times;</span><span class="hide">Close</span></button>
            </div>
            <div class="modal-body">
                <div class="modal-alert alert hide"></div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        JENIS REKENING
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select id="jenis-add-form" name="jenis" class="form-control" required>
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
                        <select id="kelompok-add-form" name="kelompok" class="form-control" required>
                            <option value="">PILIH KELOMPOK</option>
                        </select>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        KODE BUKU BESAR
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="id" class="form-control" maxlength="6" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        NAMA BUKU BESAR
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="bukubesar" class="form-control" maxlength="200" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        KATEGORI
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select id="kategori-add-form" name="kategori" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            <option value="GL">GL</option>
                        </select>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        GOLONGAN
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select id="golongan-add-form" name="golongan" class="form-control" required>
                            <option value="">Pilih Golongan</option>
                            <option value="SYSTEM">System</option>
                        </select>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        RESIKO
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="number" name="resiko" class="form-control" maxlength="11" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="bukubesar-submit" class="btn btn-primary btn-sm">Tambah</button>
                <button type="button" id="bukubesar-submit-cancel" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
</div>
