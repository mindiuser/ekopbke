<?php $this->load->view('shared/css_content');?>
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-content">
<h3 class="card-title"><i class="fa fa-user-circle" aria-hidden="true"></i> LOG TRANSAKSI</h3>
<div class="toolbar">
    <!--        Here you can write extra buttons/actions for the toolbar              -->
</div>
<div class="material-datatables">
<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
<thead>
<tr>
    <th>TANGGAL</th>
    <th>USER</th>
    <th>AKSI</th>
    <th>FORM</th>
    <th>RESUME</th>
    <th>IP ADDRESS</th>
    <th>COMPUTER NAME</th>
    <th>DATE TIME</th>
</tr>
</thead>
<tbody>
<?php
if(!empty($data)) {
    foreach($data as $row){
    ?>
        <tr>
            <td><?php echo isset($row->TGL)?$row->TGL:'';?></td>
            <td><?php echo isset($row->UID)?$row->UID:'';?></td>
            <td><?php echo isset($row->AKSI)?$row->AKSI:'';?></td>
            <td><?php echo isset($row->APP_FORM)?$row->APP_FORM:'';?></td>
            <td><?php echo isset($row->RESUME)?$row->RESUME:'';?></td>
            <td><?php echo isset($row->IP_ADDRESS)?$row->IP_ADDRESS:'';?></td>
            <td><?php echo isset($row->COMP_NAME)?$row->COMP_NAME:'';?></td>
            <td><?php echo isset($row->TIME_STAMP)?$row->TIME_STAMP:'';?></td>
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
<?php
$this->load->view('shared/js_content');
?>
<script type="text/javascript">
    $(document).ready(function() {

        var initBar = function(){
            var actionbutton = '';
            actionbutton += '<div class="btn-group">';
            actionbutton += '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">';
            actionbutton += '<span id="filter-user-label">FILTER USER</span> <span class="caret"></span></button>';
            actionbutton += '<ul class="dropdown-menu" role="menu" id="filter-user">';
            actionbutton += '<li><a href="#" class="select-user" id="ALL" label="">SEMUA</a></li>';
            <?php if(!empty($users)){ foreach($users as $row) { ?>
            actionbutton += '<li><a href="#" class="select-user" id="<?php echo $row->NAMA;?>" label="<?php echo $row->NAMA;?>"><?php echo $row->NAMA;?></a></li>';
            <?php }} ?>
            actionbutton += '</ul>';
            actionbutton += '</div>';
           /* actionbutton += '<button type="button" id="add" class="btn btn-sm btn-primary" style="margin-left:5px"><i class="fa fa-plus"></i><span style="padding-left:5px">Baru</span></button>';*/
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
            "buttons": [ 'excel', 'pdf', 'print']

        });

        initBar();

        $('#filter-user').on( 'click','.select-user', function () {
            console.log($(this).attr("id"));
            if($(this).attr("id") != 'ALL'){
            table
                .columns(1)
                .search( $(this).attr("id") )
                .draw();
            }
            else {
                table.draw();
            }
        } );


    });
</script>