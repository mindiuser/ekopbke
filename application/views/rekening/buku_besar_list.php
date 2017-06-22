<?php $this->load->view('shared/css_content');?>
<div class="row" id="buku_besar">
<div class="col-md-12">
<div class="card">
<div class="card-header card-header-icon" data-background-color="purple">
    <i class="material-icons">assignment</i>
</div>
<div class="card-content">
<h4 class="card-title">DAFTAR REKENING BUKU BESAR</h4>
<div class="toolbar">
    <!--        Here you can write extra buttons/actions for the toolbar              -->
</div>
<div class="material-datatables">
<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
<thead>
<tr>
    <th>KODE</th>
    <th>NAMA BUKU BESAR</th>
    <th>KATEGORI</th>
    <th>GOLONGAN</th>
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
$this->load->view('shared/js_content');
?>
<script type="text/javascript">
    $(document).ready(function() {
        var initBar = function(){
            var actionbutton = '';
            actionbutton += '<div class="btn-group">';
            actionbutton += '<button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown">';
            actionbutton += '<span id="filter-jenis-label">JENIS REKENING </span> <span class="caret"></span></button>';
            actionbutton += '<ul class="dropdown-menu" role="menu" id="filter-jenis">';
            <?php if(!empty($jenis)){ foreach($jenis as $row) { ?>
            actionbutton += '<li><a href="#" class="select-jenis" id="<?php echo $row->ACCJENIS;?>" label="<?php echo $row->JENIS;?>"><?php echo $row->JENIS;?></a></li>';
            <?php }} ?>
            actionbutton += '</ul>';
            actionbutton += '</div>';
            actionbutton += '<div class="btn-group">';
            actionbutton += '<button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown">';
            actionbutton += '<span id="filter-kelompok-label">KELOMPOK </span><span class="caret"></span></button>';
            actionbutton += '<ul class="dropdown-menu" role="menu" id="filter-kelompok">';
            actionbutton += '</ul>';
            actionbutton += '</div>';
            actionbutton += '<button type="button" class="btn btn-sm btn-success" style="margin-left:5px"><i class="fa fa-plus"></i><span style="padding-left:5px">Baru</span></button>';
            actionbutton += '';
            $(".dt-actionbutton").html(actionbutton);
        }

        var reloadTable = function(kelompok){
            $.ajax({
                url: "<?php echo my_url();?>/rekening/buku_besar_data",
                type: 'POST',
                dataType:'json',
                data: {
                    kelompok:kelompok
                },
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

        var table = $('#datatables').DataTable({
            "responsive": true,
            "dom": "<'dt-actionbutton'><'dt-actionbulk'>flr<'dt-advance-search'>B<'dt-alert col-md-12 no-padding'>tip",
            "buttons": [ 'excel', 'pdf', 'print'],
            "ajax": "<?php echo my_url();?>/rekening/buku_besar_data",
            "columnDefs":[
                {
                    "render": function ( data, type, row ) {
                        return '<a href="javascript:void(0)" class="edit btn btn-xs btn-success" accbb="'+row[0]+'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="javascript:void(0)" class="delete btn btn-xs btn-danger" accbb="'+row[0]+'"><i class="fa fa-times" aria-hidden="true"></i></a>';
                    },
                    "targets": 4
                }
            ]
        });
        initBar();

        $('.select-jenis').on("click",function(){
            $.ajax({
                url: "<?php echo base_url();?>/rekening/filter_kelompok",
                type: 'POST',
                dataType:'html',
                data: {
                    jenis_rekening : $(this).attr('id')
                },
                success: function(options) {
                    $("ul#filter-kelompok").html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    $('.dt-alert .alert').addClass('alert-danger').removeClass('alert-success hidden').text(textStatus);
                }
            });

            $("#filter-jenis-label").text("JENIS REKENING : "+$(this).attr("label"));
            var tgt = $("#filter-jenis-label").parent(".btn");
            $(tgt).removeClass("btn-success").addClass("btn-warning");
        });

        $("#filter-kelompok").on('click',".select-kelompok",function () {
            reloadTable($(this).attr("id"));
            $("#filter-kelompok-label").text("Kelompok : "+$(this).attr("label"));
            var tgt = $("#filter-kelompok-label").parent(".btn");
            $(tgt).removeClass("btn-success").addClass("btn-warning");
        });



    });
</script>