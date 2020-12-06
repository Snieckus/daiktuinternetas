<?php include('./header.php');?>
    <div class="container">
        <div class="row" style="padding-top:10px">
            <div class="col-lg-12 d-flex justify-content-center">
                <b>Lempa</b>
            </div>
            <div class="col-lg-12 d-flex justify-content-center"  style="padding-bottom:10px">
                <?php $last_lempa_state = gor("SELECT state FROM controller WHERE kam = '0' ORDER BY created_at DESC LIMIT 1");?>
                <input type="checkbox" id="lempa" <?php echo ($last_lempa_state == '1') ? 'checked' : '' ;?> data-toggle="toggle" data-on="Įjungta" data-off="Išjungta" data-onstyle="success" data-offstyle="danger">
            </div>
            <div class="col-lg-12 d-flex justify-content-center">
                <b>Temperatūra</b>
            </div>
            <div class="col-lg-12 d-flex justify-content-center"  style="padding-bottom:10px">
                <?php $last_temp_state = gor("SELECT state FROM controller WHERE kam = '1' ORDER BY created_at DESC LIMIT 1");?>
                <input type="checkbox" id="temp" <?php echo ($last_temp_state == '1') ? 'checked' : '' ;?> data-toggle="toggle" data-on="Įjungta" data-off="Išjungta" data-onstyle="success" data-offstyle="danger">
            </div>
        </div>
    </div>
<?php include('./footer.php');?>
<script>
    $(document).ready(function () {
        $(document).on('change', '#lempa', function (){
            var state = 0;
            if($(this).prop('checked')){
                state = 1;
            }else{
                state = 0;
            }
            $.ajax({
            url:"ajax_calls.php",    //the page containing php script
            type: "post",    //request type,
            data: {'call' : 'switch_lempa', state : state },
                success:function(result){
                }
            });
        });
        $(document).on('change', '#temp', function (){
            var state = 0;
            if($(this).prop('checked')){
                state = 1;
            }else{
                state = 0;
            }
            $.ajax({
            url:"ajax_calls.php",    //the page containing php script
            type: "post",    //request type,
            data: {'call' : 'switch_temp', state : state },
                success:function(result){
                }
            });
        });
    });
</script>