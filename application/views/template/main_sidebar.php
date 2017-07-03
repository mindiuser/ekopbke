<div class="sidebar" data-active-color="purple" data-background-color="#1580b9">
    <!--
Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
Tip 2: you can also add an image using data-image tag
Tip 3: you can change the color of the sidebar with data-background-color="white | black"
-->

    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="<?php echo base_url();?>public/uploads/profile/<?php echo $this->session->userdata('uid');?>.jpg" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <?php
                    if($this->session->has_userdata('logged_in') && $this->session->userdata('logged_in')){
                        echo $this->session->userdata('name');
                    }
                    else {
                        echo "-= unknown user =-";
                    }
                    ?>
                    <b class="caret"></b>
                </a>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="<?php echo site_url('user/update/photo');?>">Ganti Photo Profile</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('user/profile/change_password');?>">Ganti Password</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li>
                <a data-toggle="collapse" href="#pagesExamples" id="menu-1" class="side-menu <?php echo ($this->session->userdata('menu-active') == 'menu-1')?'menu-open':'';?>" <?php echo ($this->session->userdata('menu-active') == 'menu-1')?'aria-hidden="true"':'';?>>
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <p>User Profile
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse <?php echo ($this->session->userdata('menu-active') == 'menu-1')?'in':'';?>" id="pagesExamples" <?php echo ($this->session->userdata('menu-active') == 'menu-1')?'aria-hidden="true"':'';?>>
                    <ul class="nav">
                        <li>
                            <a href="<?php echo site_url('user/bagian');?>">Daftar Bagian User</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('user/jabatan');?>">Daftar Jabatan User</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('user/profile');?>">User Profile Manager</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('slide/web');?>">Slide Web</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('slide/mobile');?>">Slide Mobile</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="<?php echo site_url('user/log');?>" id="menu-2" class="side-menu <?php echo ($this->session->userdata('menu-active') == 'menu-2')?'menu-open':'';?>">
                    <i class="fa fa-database" aria-hidden="true"></i>
                    <p>Log Transaksi</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#pagesExamples2" id="menu-3" class="side-menu <?php echo ($this->session->userdata('menu-active') == 'menu-3')?'menu-open':'';?>" <?php echo ($this->session->userdata('menu-active') == 'menu-3')?'aria-hidden="true"':'';?>>
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <p>Wilayah
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse <?php echo ($this->session->userdata('menu-active') == 'menu-3')?'in':'';?>" id="pagesExamples2" <?php echo ($this->session->userdata('menu-active') == 'menu-3')?'aria-hidden="true"':'';?>>
                    <ul class="nav">
                        <li>
                            <a href="<?php echo site_url('wilayah/propinsi');?>">Propinsi</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('wilayah/kabupaten');?>">Kabupaten</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('wilayah/kecamatan');?>">Kecamatan</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('wilayah/kelurahan');?>">Kelurahan</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('wilayah/kodepos');?>">Kode pos</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#pagesExamples3" id="menu-4" class="side-menu <?php echo ($this->session->userdata('menu-active') == 'menu-4')?'menu-open':'';?>">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    <p>Chart of Account
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse <?php echo ($this->session->userdata('menu-active') == 'menu-4')?'in':'';?>" id="pagesExamples3" <?php echo ($this->session->userdata('menu-active') == 'menu-4')?'aria-hidden="true"':'';?>>
                    <ul class="nav">
                        <li>
                            <a href="<?php echo site_url('rekening/jenis_rekening');?>">Jenis Rekening</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('rekening/kelompok_rekening');?>">Kelompok Rekening</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('rekening/buku_besar');?>">Rekening Buku Besar</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('rekening/sub_buku_besar');?>">Rekening Sub Buku Besar</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li>
                <a href="<?php echo site_url('regulasi/acuan');?>" id="menu-5" class="side-menu <?php echo ($this->session->userdata('menu-active') == 'menu-5')?'menu-open':'';?>">
                    <i class="fa fa-gavel" aria-hidden="true"></i>
                    <p>Acuan Regulasi</p>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('kesehatan/penilaian');?>" id="menu-6" class="side-menu <?php echo ($this->session->userdata('menu-active') == 'menu-6')?'menu-open':'';?>">
                    <i class="fa fa-eyedropper" aria-hidden="true"></i>
                    <p>Penilaian Kesehatan</p>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('kesehatan/predikat');?>" id="menu-7" class="side-menu <?php echo ($this->session->userdata('menu-active') == 'menu-7')?'menu-open':'';?>">
                    <i class="fa fa-thermometer-full" aria-hidden="true"></i>
                    <p>Predikat Kesehatan</p>
                </a>
            </li>

        </ul>
    </div>
</div>