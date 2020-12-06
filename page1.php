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
                            <th>Lempa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php 
                            $dabartine_temp = mfa_kaip_array("SELECT temp, created_at FROM temperature ORDER BY created_at DESC LIMIT 1");
                            $dabartine_lempa = mfa_kaip_array("SELECT state, created_at FROM controller WHERE kam = '0' ORDER BY created_at DESC LIMIT 1");
                            $dabartine_temp_controller = gor("SELECT state FROM controller WHERE kam = '1' ORDER BY created_at DESC LIMIT 1");?>
                            <td><?php echo '<b>'.$dabartine_temp[0]['temp'].' <span>&#8451;</span></b>';?><br><?php echo $dabartine_temp[0]['created_at'];?><br>Statusas: <?php echo ($dabartine_temp_controller == '0') ? '<b>Nepildo</b>' : '<b>Pildo</b>';?></td>
                            <td>
                            <?php if($dabartine_lempa[0]['state'] == 1){
                                ?><img id="myImg" src="https://www.w3schools.com/js/pic_bulbon.gif" alt="bulb" width="50" height="80"><?php
                            }else{
                                ?><img id="myImg" src="https://www.w3schools.com/js/pic_bulboff.gif" alt="bulb" width="50" height="80"><?php
                            }
                            ?>
                            <br><?php echo $dabartine_lempa[0]['created_at'];?>
                            </td>
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
                        'created_at' => 'Data',
                        'kam' => 'Kam'
                    );
                    $sql = "SELECT id, state, created_at, CAST(
                        CASE
                             WHEN kam = '0'
                                THEN 'Lempa'
                             ELSE 'Temperatūra'
                        END as varchar(200)) as kam FROM controller ORDER BY created_at DESC";
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

    function changeImage() {
        var image = document.getElementById('myImage');
        if (image.src.match("bulbon")) {
            image.src = "pic_bulboff.gif";
        } else {
            image.src = "pic_bulbon.gif";
        }
    }
</script>