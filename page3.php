<?php include('./header.php');?>
    <div class="container">
        <div class="row" style="padding-top:10px">
            <div class="col-lg-12 d-flex justify-content-center">
                <b>Rėlė</b>
            </div>
            <div class="col-lg-12 d-flex justify-content-center"  style="padding-bottom:10px">
                <?php $last_rele_state = gor("SELECT state FROM controller ORDER BY created_at DESC LIMIT 1");?>
                <input type="checkbox" id="rele" <?php echo ($last_rele_state == '1') ? 'checked' : '' ;?> data-toggle="toggle" data-on="Įjungta" data-off="Išjungta" data-onstyle="success" data-offstyle="danger">
            </div>
        </div>
    </div>
<?php include('./footer.php');?>
<script>
    $(document).ready(function () {
        $(document).on('change', '#rele', function (){
            var state = 0;
            if($(this).prop('checked')){
                state = 1;
            }else{
                state = 0;
            }
            $.ajax({
            url:"ajax_calls.php",    //the page containing php script
            type: "post",    //request type,
            data: {'call' : 'switch_rele', state : state },
                success:function(result){
                }
            });
        });
    });
</script>