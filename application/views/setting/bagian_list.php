<?php $this->load->view('shared/css_content');?>
<div class="row" id="bagian">
<div class="col-md-12">
<div class="card">
<div class="card-header card-header-icon" data-background-color="purple">
    <i class="material-icons">assignment</i>
</div>
<div class="card-content">
<h4 class="card-title">DAFTAR BAGIAN</h4>
<div class="toolbar">
    <!--        Here you can write extra buttons/actions for the toolbar              -->
</div>
<div class="material-datatables">
<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
<thead>
<tr>
    <th>URUT</th>
    <th>BAGIAN</th>
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
$this->load->view('setting/bagian_add_modal');
$this->load->view('setting/bagian_edit_modal');
$this->load->view('shared/js_content');
?>
<script type="text/javascript">
    $(document).ready(function() {
        var reloadTable = function(){
            $.ajax({
                url: "<?php echo my_url();?>/user/bagian/data",
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
            actionbutton += '<button type="button" id="add" class="btn btn-sm btn-success" style="margin-left:5px"><i class="fa fa-plus"></i><span style="padding-left:5px">Baru</span></button>';
            actionbutton += '';
            $(".dt-actionbutton").html(actionbutton);
        }
        var table = $('#datatables').DataTable({
            "responsive": true,
            "dom": "<'dt-actionbutton'><'dt-actionbulk'>flr<'dt-advance-search'>B<'dt-alert col-md-12 no-padding'>tip",
            "buttons": ['excel'],
            "ajax": "<?php echo my_url();?>/user/bagian/data",
            "columnDefs":[
                {
                    "render": function ( data, type, row ) {
                        //console.log(row);
                        return '<a href="javascript:void(0)" class="edit btn btn-xs btn-success" urut="'+row[0]+'" bagian="'+row[1]+'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="javascript:void(0)" class="delete btn btn-xs btn-danger" urut="'+row[0]+'" bagian="'+row[1]+'"><i class="fa fa-times" aria-hidden="true"></i></a>';
                    },
                    "targets": 2
                }
            ]
        });
        initBar();

        $("#bagian").on('click', '#add', function() {
            $(".modal-alert","#add-bagian-modal").removeClass("alert-danger").addClass("hide").text("");
            $("#add-bagian-modal").modal("show");
            return false;
        });

        $("#add-bagian-modal").on('click', '#bagian-submit', function() {
            var urut = $("input[name='urut']","#add-bagian-modal").val();
            var bagian = $("input[name='bagian']","#add-bagian-modal").val();
            if(urut.trim() == ''){
                $(".modal-alert","#add-bagian-modal").addClass("alert-danger").removeClass("hide").text("Nomor urut masih kosong");
                return false;
            }
            if(bagian.trim() == ''){
                $(".modal-alert","#add-bagian-modal").addClass("alert-danger").removeClass("hide").text("Nama bagian masih kosong");
                return false;
            }
            $.ajax({
                url: "<?php echo my_url().'/user/bagian/add';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    urut : urut, bagian:bagian
                },
                success: function(data) {
                    $("[name='urut']",$("#add-bagian-modal")).val('');
                    $("[name='bagian']",$("#add-bagian-modal")).val('');
                    $(".modal-alert","#add-bagian-modal").removeClass("alert-warning").addClass("hide").text("");
                    $("#add-bagian-modal").modal("hide");
                    if(data.status == true){
                        showAlerts('success',data.message);
                        reloadTable();
                    }
                    else {
                        showAlerts('error',data.message);
                    }
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });
        });

        $("#add-bagian-modal").on('click', '#bagian-submit-cancel', function(){
            $(".modal-alert","#add-bagian-modal").removeClass("alert-danger").addClass("hide").text("");
            $("[name='urut']",$("#add-bagian-modal")).val('');
            $("[name='bagian']",$("#add-bagian-modal")).val('');
            $("#add-bagian-modal").modal("hide");
        });

        // Edit record
        table.on('click', '.edit', function() {
            $("[name='edit-urut']",$("#edit-bagian-modal")).val($(this).attr('urut'));
            $("[name='edit-bagian']",$("#edit-bagian-modal")).val($(this).attr('bagian'));
            $("[name='edit-urut-old']",$("#edit-bagian-modal")).val($(this).attr('urut'));
            $("[name='edit-bagian-old']",$("#edit-bagian-modal")).val($(this).attr('bagian'));
            $("#edit-bagian-modal").modal("show");
            return false;
        });

        $("#edit-bagian-modal").on('click', '#bagian-edit-submit', function() {
            var urut = $("input[name='edit-urut']","#edit-bagian-modal").val();
            var bagian = $("input[name='edit-bagian']","#edit-bagian-modal").val();
            var urut_old = $("input[name='edit-urut-old']","#edit-bagian-modal").val();
            var bagian_old = $("input[name='edit-bagian-old']","#edit-bagian-modal").val();
            if(urut.trim() == ''){
                $(".modal-alert","#edit-bagian-modal").addClass("alert-danger").removeClass("hide").text("Nomor urut masih kosong");
                return false;
            }
            if(bagian.trim() == ''){
                $(".modal-alert","#edit-bagian-modal").addClass("alert-danger").removeClass("hide").text("Nama bagian masih kosong");
                return false;
            }
            $.ajax({
                url: "<?php echo my_url().'/user/bagian/edit';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    urut : urut, bagian:bagian, urut_old:urut_old, bagian_old:bagian_old
                },
                success: function(data) {
                    console.log(data);
                    $("[name='edit-urut']",$("#edit-bagian-modal")).val('');
                    $("[name='edit-bagian']",$("#edit-bagian-modal")).val('');
                    $("[name='edit-urut-old']",$("#edit-bagian-modal")).val('');
                    $("[name='edit-bagian-old']",$("#edit-bagian-modal")).val('');
                    $("#edit-bagian-modal").modal("hide");
                    if(data.status == true){
                        showAlerts('success',data.message);
                        reloadTable();
                    }
                    else {
                        showAlerts('error',data.message);
                    }
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });

        });

        $("#edit-bagian-modal").on('click', '#bagian-edit-cancel', function(){
            $(".modal-alert","#edit-bagian-modal").removeClass("alert-danger").addClass("hide").text("");
            $("[name='urut']",$("#edit-bagian-modal")).val('');
            $("[name='bagian']",$("#edit-bagian-modal")).val('');
            $("#edit-bagian-modal").modal("hide");
        });

        // Delete a record
        table.on('click', '.delete', function(e) {
            var urut = $(this).attr('urut');
            var bagian = $(this).attr('bagian');
            console.log(urut);
            console.log(bagian);
            $.ajax({
                url: "<?php echo my_url().'/user/bagian/delete';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    urut : urut, bagian:bagian
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


    });
</script>
