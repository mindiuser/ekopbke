<div class="modal fade" id="edit-user-modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b><i class="fa fa-user mr-10"></i> Edit User Profile</b>
            </div>
            <div class="modal-body">
                <div class="modal-alert alert hide"></div>
                <div class="col col-md-4">
                    <h4>DATA USER</h4>
                    <div class="group-input">
                        <div class="label-extend">
                            UID</div>
                        <input type="text" name="uid" class="form-control-extend" disabled required>

                    </div>
                    <div class="group-input">
                        <div class="label-extend">
                            Nama</div>
                        <input type="text" name="nama" class="form-control-extend" required>

                    </div>
                    <div class="group-input">
                        <div class="label-extend">
                            Password</div>
                        <input type="password" name="password" class="form-control-extend" disabled required>

                    </div>
                    <div class="group-input">
                        <div class="label-extend">
                            Level</div>
                        <select class="form-control-extend" id="level-edit-form" name="level">
                            <option value="">--Pilih Level---</option>
                            <?php if(!empty($level)){ foreach($level as $row){ ?>
                                <option value="<?php echo $row->ID;?>"><?php echo $row->LEVEL;?></option>
                            <?php }} ?>
                        </select>
                    </div>
                    <div class="group-input">
                        <div class="label-extend">
                            Bagian</div>
                        <select class="form-control-extend" id="bagian-edit-form" name="bagian">
                            <option value="">--Pilih Bagian---</option>
                            <?php if(!empty($bagian)){ foreach($bagian as $row){ ?>
                                <option value="<?php echo $row->BAGIAN;?>"><?php echo $row->BAGIAN;?></option>
                            <?php }} ?>
                        </select>
                    </div>
                    <div class="group-input">
                        <div class="label-extend">
                            Jabatan</div>
                        <select class="form-control-extend" id="jabatan-edit-form" name="jabatan">
                            <option value="">--Pilih Jabatan---</option>
                            <?php if(!empty($jabatan)){ foreach($jabatan as $row){ ?>
                                <option bagian="<?php echo $row->BAGIAN;?>" value="<?php echo $row->JABATAN;?>" class=""><?php echo $row->JABATAN;?></option>
                            <?php }} ?>
                        </select>
                    </div>
                    <div class="group-input">
                        <div class="label-extend">
                            status</div>
                        <input type="radio" name="status" value="1" required> Enable
                        <input type="radio" name="status" value="0" required> Disable
                    </div>

                </div>
                <div class="col col-md-4">
                    <h4>AKSES MODUL</h4>
                    <div class="group-input">
                        <div class="label-extend">
                            Administrator</div>
                        <input type="checkbox" name="administrator" value="1">
                    </div>
                    <div class="group-input">
                        <div class="label-extend">
                            Setting</div>
                        <input type="checkbox" name="setting" value="1">
                    </div>
                    <div class="group-input">
                        <div class="label-extend">
                            Registrasi mitra</div>
                        <input type="checkbox" name="registrasi_mitra" value="1">
                    </div>
                    <div class="group-input">
                        <div class="label-extend">
                            Master</div>
                        <input type="checkbox" name="master" value="1">
                    </div>
                    <div class="group-input">
                        <div class="label-extend">
                            Approval</div>
                        <input type="checkbox" name="approval" value="1">
                    </div>
                    <div class="group-input">
                        <div class="label-extend">
                            Dashboard</div>
                        <input type="checkbox" name="dashboard" value="1">
                    </div>
                    <div class="group-input">
                        <div class="label-extend">
                            regulasi</div>
                        <input type="checkbox" name="regulasi" value="1">
                    </div>
                </div>
                <div class="col col-md-4">
                    <h4>AKSES MONITORING</h4>
                    <div class="group-input">
                        <div class="label-extend">
                            Regional</div>
                        <select class="form-control-extend" id="regional-edit-form" name="regional">
                            <option value="">--Pilih Regional---</option>
                            <?php if(!empty($regional)){ foreach($regional as $row){ ?>
                                <option value="<?php echo $row->IDREG;?>"><?php echo $row->NAMA_REGIONAL;?></option>
                            <?php }} ?>
                            <option value="TIDAK">TIDAK DIIJINKAN</option>
                            <option value="SEMUA">SEMUA</option>
                        </select>
                    </div>
                    <div class="group-input">
                        <div class="label-extend">
                            Cabang</div>
                        <select class="form-control-extend" id="cabang-edit-form" name="cabang">
                            <option value="">--Pilih Cabang---</option>
                            <?php if(!empty($cabang)){ foreach($cabang as $row){ ?>
                                <option value="<?php echo $row->IDCAB;?>"><?php echo $row->NAMA_CABANG;?></option>
                            <?php }} ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col col-md-12">
                    <button type="button" id="user-edit-submit" class="btn btn-primary btn-sm">Simpan</button>
                    <button type="button" id="user-edit-submit-cancel" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
