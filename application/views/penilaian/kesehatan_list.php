<?php $this->load->view('shared/css_content');?>
<div class="row" id="penilaian">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <h3 class="card-title"><i class="fa fa-eyedropper" aria-hidden="true"></i> KATEGORI PENILAIAN KESEHATAN</h3>
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                        <tr>
                            <th>KODE</th>
                            <th>KATEGORI PENILAIAN</th>
                            <th>BOBOT</th>
                            <th class="disabled-sorting">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>
<?php
$this->load->view('penilaian/kesehatan_add_modal');
$this->load->view('penilaian/kesehatan_edit_modal');
$this->load->view('shared/js_content');
?>
<script type="text/javascript">
    $(document).ready(function() {
        var reloadTable = function(){
            $.ajax({
                url: "<?php echo my_url();?>/kesehatan/penilaian/data",
                type: 'POST',
                dataType:'json',
                data: {},
                success: function(newData) {
                    var xtable = $('#datatables').DataTable();
                    xtable.clear();
                    xtable.rows.add(newData.data).draw();
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });
        }
        var initBar = function(){
            var actionbutton = '';
            actionbutton += '<button type="button" id="add" class="btn-new btn-single-group btn btn-sm btn-primary" style="margin-left:5px"><i class="fa fa-plus"></i><span style="padding-left:5px">Baru</span></button>';
            actionbutton += '';
            $(".dt-actionbutton").html(actionbutton);
        }

        var hideModal = function(){
            $(".modal-alert","#add-penilaian-modal").removeClass("alert-danger").addClass("hide").text("");
            $("[name='tema']",$("#add-penilaian-modal")).val('');
            $("[name='keterangan']",$("#add-penilaian-modal")).val('');
            $("[name='file']",$("#add-penilaian-modal")).val('');
            $("#add-penilaian-modal").modal("hide");
        }

        var table = $('#datatables').DataTable({
            "responsive": true,
            "dom": "<'dt-actionbutton'><'dt-actionbulk'>flr<'dt-advance-search'>B<'dt-alert col-md-12 no-padding'>tip",
            "buttons": dtBtn,
            "ajax": "<?php echo my_url();?>/kesehatan/penilaian/data",
            "columnDefs":[
                {
                    "render": function ( data, type, row ) {
                        return '<a href="javascript:void(0)" class="edit btn btn-xs btn-primary" kode="'+row[0]+'" aspek="'+row[1]+'" bobot="'+row[2]+'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="javascript:void(0)" class="delete btn btn-xs btn-danger" kode="'+row[0]+'" ><i class="fa fa-times" aria-hidden="true"></i></a>';
                    },
                    "targets": 3
                }
            ]
        });
        initBar();

        $("#penilaian").on('click', '#add', function() {
            $(".modal-alert","#add-penilaian-modal").removeClass("alert-danger").addClass("hide").text("");
            $("#add-penilaian-modal").modal("show");
            return false;
        });

        $("#add-penilaian-modal").on('click', '#penilaian-submit', function() {
            var id = $("input[name='kode']",$("#add-penilaian-modal")).val();
            var aspek = $("input[name='aspek']",$("#add-penilaian-modal")).val();
            var bobot = $("input[name='bobot']",$("#add-penilaian-modal")).val();
            if(id == ''){
                $(".modal-alert","#add-penilaian-modal").addClass("alert-danger").removeClass("hide").text("Kode masih kosong");
                return false;
            }
            if(aspek == ''){
                $(".modal-alert","#add-penilaian-modal").addClass("alert-danger").removeClass("hide").text("Nama aspek masih kosong");
                return false;
            }
            if(bobot == ''){
                $(".modal-alert","#add-penilaian-modal").addClass("alert-danger").removeClass("hide").text("Bobot aspek wajib diisi");
                return false;
            }
            $.ajax({
                url: "<?php echo my_url().'kesehatan/penilaian/add';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    kode:id,aspek:aspek,bobot:bobot
                },
                success: function(data) {
                    hideModal();
                    if(data.status == true){
                        showAlerts('success',data.message);
                        reloadTable();
                    }
                    else {
                        hideModal();
                        showAlerts('error',data.message);
                    }
                },
                error: function(xhr, textStatus, ThrownException){
                    hideModal();
                    showAlerts('error',textStatus);
                }
            });

        });

        $("#add-penilaian-modal").on('click', '#penilaian-submit-cancel', function(){
            $(".modal-alert","#add-penilaian-modal").removeClass("alert-danger").addClass("hide").text("");
            $("[name='id']",$("#add-penilaian-modal")).val('');
            $("[name='keterangan']",$("#add-penilaian-modal")).val('');
            $("[name='file']",$("#add-penilaian-modal")).val('');
            $("#add-penilaian-modal").modal("hide");
        });

        // Delete a record
        table.on('click', '.delete', function(e) {
            var kode = $(this).attr('kode');
            $.ajax({
                url: "<?php echo my_url().'/kesehatan/penilaian/delete';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    kode:kode
                },
                success: function(status) {
                    console.log(status);
                    if(status == true){
                        showAlerts('success','Data telah didelete');
                        reloadTable();
                    }
                    else {
                        showAlerts('error','Silahkan ulangi lagi');
                    }

                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });
        });

        // Edit record
        table.on('click', '.edit', function() {
            $("[name='kode']",$("#edit-penilaian-modal")).val($(this).attr('kode'));
            $("[name='aspek']",$("#edit-penilaian-modal")).val($(this).attr('aspek'));
            $("[name='bobot']",$("#edit-penilaian-modal")).val($(this).attr('bobot'));
            $("#edit-penilaian-modal").modal("show");
            return false;
        });

        $("#edit-penilaian-modal").on('click', '#penilaian-edit-submit', function() {
            var id = $("input[name='kode']",$("#edit-penilaian-modal")).val();
            var aspek = $("input[name='aspek']",$("#edit-penilaian-modal")).val();
            var bobot = $("input[name='bobot']",$("#edit-penilaian-modal")).val();
            if(id == ''){
                $(".modal-alert","#edit-penilaian-modal").addClass("alert-danger").removeClass("hide").text("Kode masih kosong");
                return false;
            }
            if(aspek == ''){
                $(".modal-alert","#edit-penilaian-modal").addClass("alert-danger").removeClass("hide").text("Nama aspek masih kosong");
                return false;
            }
            if(bobot == ''){
                $(".modal-alert","#edit-penilaian-modal").addClass("alert-danger").removeClass("hide").text("Bobot aspek wajib diisi");
                return false;
            }
            $.ajax({
                url: "<?php echo my_url().'kesehatan/penilaian/edit';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    kode:id,aspek:aspek,bobot:bobot
                },
                success: function(data) {
                    $("[name='kode']",$("#edit-penilaian-modal")).val('');
                    $("[name='aspek']",$("#edit-penilaian-modal")).val('');
                    $("[name='bobot']",$("#edit-penilaian-modal")).val('');
                    $("#edit-penilaian-modal").modal("hide");
                    if(data.status == true){
                        showAlerts('success',data.message);
                        reloadTable();
                    }
                    else {
                        showAlerts('error',data.message);
                    }
                },
                error: function(xhr, textStatus, ThrownException){
                    $("[name='kode']",$("#edit-penilaian-modal")).val('');
                    $("[name='aspek']",$("#edit-penilaian-modal")).val('');
                    $("[name='bobot']",$("#edit-penilaian-modal")).val('');
                    $("#edit-penilaian-modal").modal("hide");
                    showAlerts('error',textStatus);
                }
            });

        });

        $("#edit-penilaian-modal").on('click', '#penilaian-edit-cancel', function(){
            $(".modal-alert","#edit-penilaian-modal").removeClass("alert-danger").addClass("hide").text("");
            $("[name='kode']",$("#edit-penilaian-modal")).val('');
            $("[name='aspek']",$("#edit-penilaian-modal")).val('');
            $("[name='bobot']",$("#edit-penilaian-modal")).val('');
            $("#edit-penilaian-modal").modal("hide");
        });


    });
</script>
