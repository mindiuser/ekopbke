<?php $this->load->view('shared/css_content');?>
<div class="row" id="propinsi">
<div class="col-md-12">
<div class="card">
<div class="card-content">
<h3 class="card-title"><i class="fa fa-map-marker" aria-hidden="true"></i> DAFTAR WILAYAH PROPINSI</h3>
<div class="toolbar">
    <!--        Here you can write extra buttons/actions for the toolbar              -->
</div>
<div class="material-datatables">
<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
<thead>
<tr>
    <th>ID</th>
    <th>PROPINSI</th>
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
$this->load->view('wilayah/propinsi_add_modal');
$this->load->view('wilayah/propinsi_edit_modal');
$this->load->view('shared/js_content');
?>
<script type="text/javascript">
    $(document).ready(function() {
        var idModalAdd = "#add-propinsi-modal";
        var idModalEdit = "#edit-propinsi-modal";
        var reloadTable = function(){
            $.ajax({
                url: "<?php echo my_url();?>/wilayah/propinsi/data",
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
            actionbutton += '<button type="button" id="add" class="btn-new btn-single-group btn btn-sm btn-primary" ><i class="fa fa-plus"></i><span style="padding-left:5px">Baru</span></button>';
            actionbutton += '';
            $(".dt-actionbutton").html(actionbutton);
        }

        var clearFormModal = function(){
            $("[name='id_prop']",$("#add-propinsi-modal")).val('');
            $("[name='propinsi']",$("#add-propinsi-modal")).val('');
            $(".modal-alert","#add-propinsi-modal").removeClass("alert-warning").addClass("hide").text("");
        }

        var clearFormModalEdit = function($this){
            $("[name='edit-id']",$("#edit-propinsi-modal")).val($($this).attr('id_prop'));
            $("[name='edit-propinsi']",$("#edit-propinsi-modal")).val($($this).attr('propinsi'));
            $("[name='edit-id-old']",$("#edit-propinsi-modal")).val($($this).attr('id_prop'));
            $("[name='edit-propinsi-old']",$("#edit-propinsi-modal")).val($($this).attr('propinsi'));
            $(".modal-alert","#edit-propinsi-modal").removeClass("alert-warning").addClass("hide").text("");
        }

        var hideFormAddModal = function(){
            $("[name='id_prop']",$("#add-propinsi-modal")).val('');
            $("[name='propinsi']",$("#add-propinsi-modal")).val('');
            $(".modal-alert","#add-propinsi-modal").removeClass("alert-warning").addClass("hide").text("");
            $("#add-propinsi-modal").modal("hide");
        }

        var table = $('#datatables').DataTable({
            "responsive": true,
            "dom": "<'dt-actionbutton'><'dt-actionbulk'>flr<'dt-advance-search'>B<'dt-alert col-md-12 no-padding'>tip",
            "buttons": dtBtn,
            "ajax": "<?php echo my_url();?>/wilayah/propinsi/data",
            "columnDefs":[
                {
                    "render": function ( data, type, row ) {
                        //console.log(row);
                        return '<a href="javascript:void(0)" class="edit btn btn-xs btn-primary" id_prop="'+row[0]+'" propinsi="'+row[1]+'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="javascript:void(0)" class="delete btn btn-xs btn-danger" id_prop="'+row[0]+'" propinsi="'+row[1]+'"><i class="fa fa-times" aria-hidden="true"></i></a>';
                    },
                    "targets": 2
                }
            ]
        });
        initBar();

        $("#propinsi").on('click', '#add', function() {
             clearFormModal();
            $("#add-propinsi-modal").modal("show");
            return false;
        });

        $("#add-propinsi-modal").on('click', '#propinsi-submit', function() {
            var id = $("input[name='id_prop']","#add-propinsi-modal").val();
            var propinsi = $("input[name='propinsi']","#add-propinsi-modal").val();
            if(id.trim() == ''){
                $(".modal-alert","#add-propinsi-modal").addClass("alert-danger").removeClass("hide").text("ID masih kosong");
                return false;
            }
            if(propinsi.trim() == ''){
                $(".modal-alert","#add-propinsi-modal").addClass("alert-danger").removeClass("hide").text("Propinsi masih kosong");
                return false;
            }
            $.ajax({
                url: "<?php echo my_url().'/wilayah/propinsi/add';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    id_prop:id,propinsi:propinsi
                },
                success: function(data) {
                    if(data.status == true){
                        hideFormAddModal();
                        showAlerts('success',data.message);
                        reloadTable();
                    }
                    else {
                        //showAlerts('error',data.message);
                        showErrorModal(idModalAdd,data.message);
                    }
                },
                error: function(xhr, textStatus, ThrownException){
                    //showAlerts('error',textStatus);
                    showErrorModal(idModalAdd,textStatus);
                }
            });
        });

        table.on('click', '.delete', function(e) {
            var id = $(this).attr('id_prop');
            var propinsi = $(this).attr('propinsi');
            $.ajax({
                url: "<?php echo my_url().'/wilayah/propinsi/delete';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    id_prop:id,propinsi:propinsi
                },
                success: function(status) {
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
            clearFormModalEdit($(this));
            $("#edit-propinsi-modal").modal("show");
            return false;
        });

        $("#edit-propinsi-modal").on('click', '#propinsi-edit-submit', function() {
            var id = $("input[name='edit-id']","#edit-propinsi-modal").val();
            var propinsi = $("input[name='edit-propinsi']","#edit-propinsi-modal").val();
            var id_old = $("input[name='edit-id-old']","#edit-propinsi-modal").val();
            var propinsi_old = $("input[name='edit-propinsi-old']","#edit-propinsi-modal").val();
            if(id.trim() == ''){
                $(".modal-alert","#edit-propinsi-modal").addClass("alert-danger").removeClass("hide").text("Nomor ID masih kosong");
                return false;
            }
            if(propinsi.trim() == ''){
                $(".modal-alert","#edit-propinsi-modal").addClass("alert-danger").removeClass("hide").text("Nama propinsi masih kosong");
                return false;
            }
            $.ajax({
                url: "<?php echo my_url().'/wilayah/propinsi/edit';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    id:id,propinsi:propinsi,id_old:id_old,propinsi_old:propinsi_old
                },
                success: function(data) {
                    if(data.status == true){
                        clearFormModalEdit();
                        $("#edit-propinsi-modal").modal("hide");
                        showAlerts('success',data.message);
                        reloadTable();
                    }
                    else {
                        //showAlerts('error',data.message);
                        showErrorModal(idModalEdit,data.message);
                    }
                },
                error: function(xhr, textStatus, ThrownException){
                    //showAlerts('error',textStatus);
                    showErrorModal(idModalEdit,textStatus);
                }
            });

        });

        return false;
    });
</script>