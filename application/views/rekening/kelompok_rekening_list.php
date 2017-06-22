<?php $this->load->view('shared/css_content');?>
<div class="row" id="kelompok_rekening">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="red">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">DAFTAR KELOMPOK REKENING</h4>
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                        <tr>
                            <th>KODE</th>
                            <th>NAMA KELOMPOK</th>
                            <th>GOLONGAN</th>
                            <th>SUB GOLONGAN</th>
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
$this->load->view('shared/js_content');
?>
<script type="text/javascript">
    $(document).ready(function() {
        var initBar = function(){
            var actionbutton = '';
            actionbutton += '<div class="btn-group">';
            actionbutton += '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">';
            actionbutton += '<span id="filter-jenis-label">PILIH JENIS REKENING</span><span class="caret"></span></button>';
            actionbutton += '<ul class="dropdown-menu" role="menu" id="filter-jenis">';
            <?php if(!empty($jenis)){ foreach($jenis as $row) { ?>
            actionbutton += '<li><a href="#" class="select-jenis" id="<?php echo $row->ACCJENIS;?>" label="<?php echo $row->JENIS;?>"><?php echo $row->JENIS;?></a></li>';
            <?php }} ?>
            $(".dt-actionbutton").html(actionbutton);
        }

        var table = $('#datatables').DataTable({
            "responsive": true,
            "dom": "<'dt-actionbutton'><'dt-actionbulk'>flr<'dt-advance-search'>B<'dt-alert col-md-12 no-padding'>tip",
            "buttons": ['excel', 'pdf', 'print'],
            "ajax": "<?php echo my_url();?>/rekening/kelompok_rekening/data"
        });
        initBar();

        $("#filter-jenis").on('click',".select-jenis",function () {
            $.ajax({
                url: "<?php echo my_url();?>/rekening/kelompok_rekening/data",
                type: 'POST',
                dataType:'json',
                data: {
                    jenis_rekening : $(this).attr('id')
                },
                success: function(newData) {
                    var table = $('#datatables').DataTable();
                    table.clear();
                    table.rows.add(newData.data).draw();
                },
                error: function(xhr, textStatus, ThrownException){
                    $('#main-alert').addClass('alert-danger').removeClass('alert-success hidden').text(textStatus);
                },
                completed: function(){
                }
            });

            $("#filter-jenis-label").text("Jenis Rekening : "+$(this).attr("label"));
            var tgt = $("#filter-jenis-label").parent(".btn");
            $(tgt).removeClass("btn-primary").addClass("btn-warning");
        });

    });
</script>