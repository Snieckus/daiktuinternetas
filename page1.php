<?php include('./header.php');?>
<br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12" style="padding-bottom:10px">
                <b>Dabartiniai rodmenys</b>
            </div>
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Temperatūra</th>
                            <th>Rėlė</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php 
                            $dabartine_temp = mfa_kaip_array("SELECT temp, created_at FROM temperature ORDER BY created_at DESC LIMIT 1");
                            $dabartine_rele = mfa_kaip_array("SELECT state, created_at FROM controller ORDER BY created_at DESC LIMIT 1");?>
                            <td><?php echo '<b>'.$dabartine_temp[0]['temp'].'</b>';?><br><?php echo $dabartine_temp[0]['created_at'];?></td>
                            <td><?php echo ($dabartine_rele[0]['state'] == '1') ? '<b>Įjungta</b>' : '<b>Išjungta</b>' ;?><br><?php echo $dabartine_rele[0]['created_at'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="d-flex justify-content-center"><b>Temperatūra</b></div><br>
                    <?php 
                    $columns = array(
                        'id' => 'ID',
                        'temp' => 'Temperatūra <span>&#8451;</span>',
                        'created_at' => 'Data'
                    );
                    $sql = "SELECT * FROM temperature";
                    ?><div id="autosearch_temp"><?php autosearch($sql, $columns, 'temperature');?></div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex justify-content-center"><b>Valdymas</b></div><br>
                    <?php 
                    $columns = array(
                        'id' => 'ID',
                        'state' => 'Būsena',
                        'created_at' => 'Data'
                    );
                    $sql = "SELECT * FROM controller";
                    ?><div id="autosearch_controller"><?php autosearch($sql, $columns, 'controller');?></div>
            </div>
        </div>  
    </div>

<?php include('./footer.php');?>
<script>
    $(document).on('click', '[id^="delete_"]', function() {
        var id = ($(this).attr('data-foo'));
        var table_name = $(this).parent().parent().parent().parent().attr('table_name');
        $.ajax({
            url:"ajax_calls.php",    //the page containing php script
            type: "post",    //request type,
            data: {id: id, 'call' : 'delete_data', 'table_name' : table_name },
            success:function(result){
                if(table_name == 'temperature'){
                    $('#autosearch_temp').html(result);
                }else{
                    $('#autosearch_controller').html(result);
                }
            }
        });
    });
</script>