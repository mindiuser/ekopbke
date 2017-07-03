<?php $this->load->view('shared/css_content');?>
<div class="row" id="predikat">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <h3 class="card-title"><i class="fa fa-thermometer-full" aria-hidden="true"></i> DAFTAR PREDIKAT PENILAIAN KESEHATAN</h3>
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                        <tr>
                            <th>NO</th>
                            <th>PREDIKAT</th>
                            <th>NILAI MIN</th>
                            <th>RASIO</th>
                            <th>NILAI MAKS</th>
                            <th>RASIO</th>
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
$this->load->view('predikat/predikat_add_modal');
$this->load->view('predikat/predikat_edit_modal');
$this->load->view('shared/js_content');
?>
<script type="text/javascript">
    $(document).ready(function() {
        var reloadTable = function(){
            $.ajax({
                url: "<?php echo my_url();?>/kesehatan/predikat/data",
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
            $(".modal-alert","#edit-predikat-modal").removeClass("alert-danger").addClass("hide").text("");
            $("[name='predikat']",$("#add-predikat-modal")).val('');
            $("[name='min']",$("#add-predikat-modal")).val('');
            $("[name='rmin']",$("#add-predikat-modal")).val('');
            $("[name='maks']",$("#add-predikat-modal")).val('');
            $("[name='rmaks']",$("#add-predikat-modal")).val('');
            $("#add-predikat-modal").modal("hide");
        }

        var hideModalEdit = function(){
            $(".modal-alert","#edit-predikat-modal").removeClass("alert-danger").addClass("hide").text("");
            $("[name='kode']",$("#edit-predikat-modal")).val('');
            $("[name='predikat']",$("#edit-predikat-modal")).val('');
            $("[name='min']",$("#edit-predikat-modal")).val('');
            $("[name='rmin']",$("#edit-predikat-modal")).val('');
            $("[name='maks']",$("#edit-predikat-modal")).val('');
            $("[name='rmaks']",$("#edit-predikat-modal")).val('');
            $("#edit-predikat-modal").modal("hide");
        }

        var table = $('#datatables').DataTable({
            "responsive": true,
            "dom": "<'dt-actionbutton'><'dt-actionbulk'>flr<'dt-advance-search'>B<'dt-alert col-md-12 no-padding'>tip",
            "buttons": [ 'excel', 'pdf', 'print'],
            "ajax": "<?php echo my_url();?>/kesehatan/predikat/data",
            "columnDefs":[
                {
                    "render": function ( data, type, row ) {
                        return '<a href="javascript:void(0)" class="edit btn btn-xs btn-primary" kode="'+row[0]+'" predikat="'+row[1]+'" min="'+row[2]+'" rmin="'+row[3]+'" maks="'+row[4]+'" rmaks="'+row[5]+'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="javascript:void(0)" class="delete btn btn-xs btn-danger" kode="'+row[0]+'" ><i class="fa fa-times" aria-hidden="true"></i></a>';
                    },
                    "targets": 6
                }
            ]
        });
        initBar();

        $("#predikat").on('click', '#add', function() {
            $(".modal-alert","#add-predikat-modal").removeClass("alert-danger").addClass("hide").text("");
            $("#add-predikat-modal").modal("show");
            return false;
        });

        $("#add-predikat-modal").on('click', '#predikat-submit', function() {
            var predikat = $("input[name='predikat']",$("#add-predikat-modal")).val();
            var min = $("input[name='min']",$("#add-predikat-modal")).val();
            var rmin = $("input[name='rmin']",$("#add-predikat-modal")).val();
            var maks = $("input[name='maks']",$("#add-predikat-modal")).val();
            var rmaks = $("input[name='rmaks']",$("#add-predikat-modal")).val();
            if(predikat == ''){
                $(".modal-alert","#add-predikat-modal").addClass("alert-danger").removeClass("hide").text("Predikat masih kosong");
                return false;
            }
            if(min == ''){
                $(".modal-alert","#add-predikat-modal").addClass("alert-danger").removeClass("hide").text("Nilai minimal wajib diisi");
                return false;
            }
            if(rmin == ''){
                $(".modal-alert","#add-predikat-modal").addClass("alert-danger").removeClass("hide").text("Rasio minimal wajib diisi");
                return false;
            }
            if(maks == ''){
                $(".modal-alert","#add-predikat-modal").addClass("alert-danger").removeClass("hide").text("Nilai maksimal wajib diisi");
                return false;
            }
            if(rmaks == ''){
                $(".modal-alert","#add-predikat-modal").addClass("alert-danger").removeClass("hide").text("Rasio maksimal wajib diisi");
                return false;
            }

            $.ajax({
                url: "<?php echo my_url().'kesehatan/predikat/add';?>",
                type: 'POST',
                dataType:'json',
                data: {
                   predikat:predikat,min:min,rmin:rmin,maks:maks,rmaks:rmaks
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

        $("#add-predikat-modal").on('click', '#predikat-submit-cancel', function(){
            $(".modal-alert","#add-predikat-modal").removeClass("alert-danger").addClass("hide").text("");
            $("[name='predikat']",$("#add-predikat-modal")).val('');
            $("[name='min']",$("#add-predikat-modal")).val('');
            $("[name='rmin']",$("#add-predikat-modal")).val('');
            $("[name='maks']",$("#add-predikat-modal")).val('');
            $("[name='rmaks']",$("#add-predikat-modal")).val('');
            $("#add-predikat-modal").modal("hide");
        });

        // Delete a record
        table.on('click', '.delete', function(e) {
            var kode = $(this).attr('kode');
            $.ajax({
                url: "<?php echo my_url().'/kesehatan/predikat/delete';?>",
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
            $(".modal-alert","#edit-predikat-modal").removeClass("alert-danger").addClass("hide").text("");
            $("[name='kode']",$("#edit-predikat-modal")).val($(this).attr("kode"));
            $("[name='predikat']",$("#edit-predikat-modal")).val($(this).attr("predikat"));
            $("[name='min']",$("#edit-predikat-modal")).val($(this).attr("min"));
            $("[name='rmin']",$("#edit-predikat-modal")).val($(this).attr("rmin"));
            $("[name='maks']",$("#edit-predikat-modal")).val($(this).attr("maks"));
            $("[name='rmaks']",$("#edit-predikat-modal")).val($(this).attr("rmaks"));
            $("#edit-predikat-modal").modal("show");
            return false;
        });

        $("#edit-predikat-modal").on('click', '#predikat-edit-submit', function() {
            var kode = $("input[name='kode']",$("#edit-predikat-modal")).val();
            var predikat = $("input[name='predikat']",$("#edit-predikat-modal")).val();
            var min = $("input[name='min']",$("#edit-predikat-modal")).val();
            var rmin = $("input[name='rmin']",$("#edit-predikat-modal")).val();
            var maks = $("input[name='maks']",$("#edit-predikat-modal")).val();
            var rmaks = $("input[name='rmaks']",$("#edit-predikat-modal")).val();
            if(predikat == ''){
                $(".modal-alert","#edit-predikat-modal").addClass("alert-danger").removeClass("hide").text("Predikat masih kosong");
                return false;
            }
            if(min == ''){
                $(".modal-alert","#edit-predikat-modal").addClass("alert-danger").removeClass("hide").text("Nilai minimal wajib diisi");
                return false;
            }
            if(rmin == ''){
                $(".modal-alert","#edit-predikat-modal").addClass("alert-danger").removeClass("hide").text("Rasio minimal wajib diisi");
                return false;
            }
            if(maks == ''){
                $(".modal-alert","#edit-predikat-modal").addClass("alert-danger").removeClass("hide").text("Nilai maksimal wajib diisi");
                return false;
            }
            if(rmaks == ''){
                $(".modal-alert","#edit-predikat-modal").addClass("alert-danger").removeClass("hide").text("Rasio maksimal wajib diisi");
                return false;
            }

            $.ajax({
                url: "<?php echo my_url().'kesehatan/predikat/edit';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    kode:kode,predikat:predikat,min:min,rmin:rmin,maks:maks,rmaks:rmaks
                },
                success: function(data) {
                    hideModalEdit();
                    if(data.status == true){
                        showAlerts('success',data.message);
                        reloadTable();
                    }
                    else {
                        showAlerts('error',data.message);
                    }
                },
                error: function(xhr, textStatus, ThrownException){
                    hideModalEdit();
                    showAlerts('error',textStatus);
                }
            });
        });

        $("#edit-predikat-modal").on('click', '#predikat-edit-cancel', function(){
            hideModalEdit();
        });


    });
</script>
