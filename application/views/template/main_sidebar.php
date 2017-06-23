<div class="sidebar" data-active-color="purple" data-background-color="#1580b9">
    <!--
Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
Tip 2: you can also add an image using data-image tag
Tip 3: you can change the color of the sidebar with data-background-color="white | black"
-->

    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="<?php echo base_url();?>public/assets/img/faces/avatar.jpg" />
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
                            <a href="<?php echo site_url('user/myprofile');?>">My Profile</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('logout');?>">Log out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li>
                <a data-toggle="collapse" href="#pagesExamples">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <p>User Profile
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pagesExamples">
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
                            <a href="<?php echo site_url('user/upload_web');?>">Slide Web</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('user/upload_mobile');?>">Slide Mobile</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="<?php echo site_url('user/log');?>">
                    <i class="fa fa-database" aria-hidden="true"></i>
                    <p>Log Transaksi</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#pagesExamples2">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <p>Wilayah
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pagesExamples2">
                    <ul class="nav">
                        <li>
                            <a href="<?php echo site_url('parameter/wilayah/propinsi');?>">Propinsi</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('parameter/wilayah/kabupaten');?>">Kabupaten</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('parameter/wilayah/kecamatan');?>">Kecamatan</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('parameter/wilayah/kelurahan');?>">Kelurahan</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('parameter/wilayah/kodepos');?>">Kode pos</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <a data-toggle="collapse" href="#pagesExamples3">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    <p>Chart of Account
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pagesExamples3">
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
                <a href="<?php echo site_url('regulasi/acuan');?>">
                    <i class="fa fa-gavel" aria-hidden="true"></i>
                    <p>Acuan Regulasi</p>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('penilaian/kesehatan');?>">
                    <i class="fa fa-eyedropper" aria-hidden="true"></i>
                    <p>Penilaian Kesehatan</p>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('predikat/kesehatan');?>">
                    <i class="fa fa-thermometer-full" aria-hidden="true"></i>
                    <p>Predikat Kesehatan</p>
                </a>
            </li>

        </ul>
    </div>
</div>