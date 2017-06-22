<link href="<?php echo base_url();?>public/assets/js/plugin/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>public/assets/js/plugin/datatable/css/responsive.dataTables.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>public/assets/js/plugin/datatable/css/buttons.dataTables.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>public/assets/js/plugin/datatable/css/editor.dataTables.min.css" rel="stylesheet">

<div class="row" id="kecamatan">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="red">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">DAFTAR WILAYAH KODE POS</h4>
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID KEL</th>
                            <th>ID</th>
                            <th>NAMA KELURAHAN</th>
                            <th>KETERANGAN</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!empty($kelurahan)) {
                            foreach($kelurahan as $row){
                                ?>
                                <tr>
                                    <td><?php echo isset($row->ID_KEL)?$row->ID_KEL:'';?></td>
                                    <td><?php echo isset($row->ID_KODE)?$row->ID_KODE:'';?></td>
                                    <td><?php echo isset($row->NAMA_KELURAHAN)?$row->NAMA_KELURAHAN:'';?></td>
                                    <td><?php echo isset($row->LONGITUDE)?$row->LONGITUDE:'';?></td>
                                    <td><?php echo isset($row->LATTITUDE)?$row->LATTITUDE:'';?></td>
                                    <td class="text-right">
                                        <button type="button" rel="tooltip" class="btn btn-xs btn-primary btn-round">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-xs btn-danger btn-round">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </td>
                                </tr>

                            <?php
                            }
                        }
                        ?>
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


<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/vfs_fonts.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var table;
        var initBar = function(){
            var actionbutton = '';
            actionbutton += '<div class="btn-group">';
            actionbutton += '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">';
            actionbutton += 'PILIH PROPINSI <span class="caret"></span></button>';
            actionbutton += '<ul class="dropdown-menu" role="menu" id="filter-propinsi">';
            <?php if(!empty($propinsi)){ foreach($propinsi as $row) { ?>
            actionbutton += '<li><a href="#" class="select-propinsi" id="<?php echo $row->ID_PROP;?>"><?php echo $row->NAMA_PROPINSI;?></a></li>';
            <?php }} ?>
            actionbutton += '</ul>';
            actionbutton += '</div>';

            actionbutton += '<div class="btn-group">';
            actionbutton += '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">';
            actionbutton += 'PILIH KABUPATEN <span class="caret"></span></button>';
            actionbutton += '<ul class="dropdown-menu" role="menu" id="filter-kabupaten">';
            <?php if(empty($kabupaten)){ foreach($kabupaten as $row) { ?>
            actionbutton += '<li><a href="#" class="select-kabupaten" id="<?php echo $row->ID_KAB;?>"><?php echo $row->NAMA_KABUPATEN;?></a></li>';
            <?php }} ?>
            actionbutton += '</ul>';
            actionbutton += '</div>';
            actionbutton += '<div class="btn-group">';
            actionbutton += '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">';
            actionbutton += 'PILIH KECAMATAN <span class="caret"></span></button>';
            actionbutton += '<ul class="dropdown-menu" role="menu" id="filter-kecamatan">';
            <?php if(empty($kecamatan)){ foreach($kecamatan as $row) { ?>
            actionbutton += '<li><a href="#" class="select-kecamatan" id="<?php echo $row->ID_KEC;?>"><?php echo $row->NAMA_KECAMATAN;?></a></li>';
            <?php }} ?>
            actionbutton += '</ul>';
            actionbutton += '</div>';

            actionbutton += '<button type="button" class="btn btn-sm btn-primary" style="margin-left:5px"><i class="fa fa-plus"></i><span style="padding-left:5px">Baru</span></button>';
            actionbutton += '';
            $(".dt-actionbutton").html(actionbutton);
        }

        var table = $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": true,
            "language": {
                search: "_INPUT_",
                searchPlaceholder: "Search records"
            },
            "dom": "<'dt-actionbutton'><'dt-actionbulk'>flr<'dt-advance-search'>B<'dt-alert col-md-12 no-padding'>tip",
            "buttons": [ 'excel'],
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": true
                }
            ]
        });

        initBar();

        $('.select-propinsi').on("click",function(){
            $.ajax({
                url: "<?php echo base_url();?>/index.php/parameter/wilayah/filter_kabupaten",
                type: 'POST',
                dataType:'html',
                data: {
                    propinsi : $(this).attr('id')
                },
                success: function(options) {
                    $("ul#filter-kabupaten").html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    $('.dt-alert .alert').addClass('alert-danger').removeClass('alert-success hidden').text(textStatus);
                }
            });
        });

        $('#filter-kabupaten').on("click",'.select-kabupaten',function(){
            $.ajax({
                url: "<?php echo base_url();?>/index.php/parameter/wilayah/filter_kecamatan",
                type: 'POST',
                dataType:'html',
                data: {
                    kabupaten : $(this).attr('id')
                },
                success: function(options) {
                    $("ul#filter-kecamatan").html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    $('.dt-alert .alert').addClass('alert-danger').removeClass('alert-success hidden').text(textStatus);
                }
            });
        });

        $("#filter-kecamatan").on( 'click','.select-kecamatan', function () {
            table
                .columns(0)
                .search( $(this).attr("id") )
                .draw();
        });

        $('.card .material-datatables label').addClass('form-group');

    });
</script>