<?php $this->load->view('shared/css_content');?>
<div class="row" id="slidemobile">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <h3 class="card-title"><i class="fa fa-cloud-upload" aria-hidden="true"></i> SLIDE MOBILE</h3>
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAMA FILE</th>
                            <th>KETERANGAN</th>
                            <th>LOKASI</th>
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
$this->load->view('slide/slidemobile_add_modal');
$this->load->view('shared/js_content');
?>
<script type="text/javascript">
    $(document).ready(function() {
        var reloadTable = function(){
            $.ajax({
                url: "<?php echo my_url();?>/slide/mobile_data",
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
            actionbutton += '<button type="button" id="add" class="btn btn-sm btn-primary" style="margin-left:5px"><i class="fa fa-plus"></i><span style="padding-left:5px">Baru</span></button>';
            actionbutton += '';
            $(".dt-actionbutton").html(actionbutton);
        }

        var hideModal = function(){
            $(".modal-alert","#add-slidemobile-modal").removeClass("alert-danger").addClass("hide").text("");
            $("[name='tema']",$("#add-slidemobile-modal")).val('');
            $("[name='keterangan']",$("#add-slidemobile-modal")).val('');
            $("[name='file']",$("#add-slidemobile-modal")).val('');
            $("#add-slidemobile-modal").modal("hide");
        }

        var table = $('#datatables').DataTable({
            "responsive": true,
            "dom": "<'dt-actionbutton'><'dt-actionbulk'>flr<'dt-advance-search'>B<'dt-alert col-md-12 no-padding'>tip",
            "buttons": [ 'excel', 'pdf', 'print'],
            "ajax": "<?php echo my_url();?>/slide/mobile_data",
            "columnDefs":[
                {
                    "render": function ( data, type, row ) {
                        return '<a target="_blank" href="<?php echo my_url();?>'+row[3]+'" ide="'+row[0]+'">'+row[3]+'</a>';
                    },
                    "targets": 3
                },
                {
                    "render": function ( data, type, row ) {
                        return '<a href="javascript:void(0)" class="delete btn btn-xs btn-danger" ide="'+row[0]+'" ><i class="fa fa-times" aria-hidden="true"></i></a>';
                    },
                    "targets": 4
                }
            ]
        });
        initBar();

        $("#slidemobile").on('click', '#add', function() {
            $(".modal-alert","#add-slidemobile-modal").removeClass("alert-danger").addClass("hide").text("");
            $("#add-slidemobile-modal").modal("show");
            return false;
        });

        $("#add-slidemobile-modal").on('click', '#slidemobile-submit', function() {
            var id = $("input[name='id']",$("#add-slidemobile-modal")).val();
            var keterangan = $("input[name='keterangan']",$("#add-slidemobile-modal")).val();
            var file = $("input[name='file']",$("#add-slidemobile-modal")).val();
            if(id.trim() == ''){
                $(".modal-alert","#add-slidemobile-modal").addClass("alert-danger").removeClass("hide").text("Tema masih kosong");
                return false;
            }
            if(keterangan.trim() == ''){
                $(".modal-alert","#add-slidemobile-modal").addClass("alert-danger").removeClass("hide").text("Keterangan masih kosong");
                return false;
            }
            if(file.trim() == ''){
                $(".modal-alert","#add-slidemobile-modal").addClass("alert-danger").removeClass("hide").text("File wajib diisi");
                return false;
            }
            var file_data = $('#file').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url:"<?php echo my_url();?>/slide/mobile_upload_file",
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    if(response.status){
                        if(response.file_name && response.file_name != ''){
                            file = response.file_name
                        }
                        $.ajax({
                            url: "<?php echo my_url().'/slide/mobile_add';?>",
                            type: 'POST',
                            dataType:'json',
                            data: {
                                id:id,keterangan:keterangan,file:file
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

                    }
                    else {
                        hideModal();
                        showAlerts('error',response.message);
                    }
                },
                error: function (response) {
                    showAlerts('error',response);
                }
            });
        });

        $("#add-slidemobile-modal").on('click', '#slidemobile-submit-cancel', function(){
            $(".modal-alert","#add-slidemobile-modal").removeClass("alert-danger").addClass("hide").text("");
            $("[name='id']",$("#add-slidemobile-modal")).val('');
            $("[name='keterangan']",$("#add-slidemobile-modal")).val('');
            $("[name='file']",$("#add-slidemobile-modal")).val('');
            $("#add-slidemobile-modal").modal("hide");
        });

        // Delete a record
        table.on('click', '.delete', function(e) {
            var ide = $(this).attr('ide');
            $.ajax({
                url: "<?php echo my_url().'/slide/mobile_delete';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    ide:ide
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
