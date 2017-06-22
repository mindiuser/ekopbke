<div class="row" id="upload_mobile">
    <div class="col-md-12">
        <div class="card mt-20">
            <div class="card-content">
                <h3 class="card-title"> <i class="fa fa-user-circle" aria-hidden="true"></i> UPLOAD MOBILE</h3>
                <div class="toolbar"></div>
                <div clas="col col-md-3"></div>
                <div clas="col col-md-6">
                    <input type="file" id="file" name="file_upload_mobile">
                    <div class="form-group label-floating">
                        <button type="button" id="upload" class="btn btn-primary btn-sm">Upload</button>
                        <button type="button" id="upload-cancel" class="btn btn-danger btn-sm" >Batal</button>
                    </div>
                </div>
                <div clas="col col-md-3"></div>

            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#upload_mobile").on('click', '#upload', function() {
            var file = $("input[name='file_upload_mobile']").val();
            if(file.trim() == ''){
                $(".modal-alert").addClass("alert-danger").removeClass("hide").text("File wajib diisi");
                return false;
            }
            var file_data = $('#file').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url:"<?php echo my_url();?>/user/upload_file_mobile",
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    if(response.status){
                        showAlerts('success',response.message);
                        setTimeout(function(){
                            window.location.reload(1);
                        }, 5000);
                    }
                    else {
                        showAlerts('error',response.message);
                    }
                },
                error: function (response) {
                    showAlerts('error',response);
                }
            });
        });
    });
</script>