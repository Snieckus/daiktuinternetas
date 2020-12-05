<?php include('./header.php');?>
<div class="container">
        <div class="row" style="padding-top:10px">
            <div class="col-lg-6">
                <div class="d-flex justify-content-center"><b>Temperatūra</b></div><br>
                <canvas id="temp_graph" width="400" height="400"></canvas>
            </div>
            <div class="col-lg-6">
                <div class="d-flex justify-content-center"><b>Valdymas</b></div><br>
                <canvas id="controller_graph" width="400" height="400"></canvas>
            </div>
        </div>  
    </div>
    <?php $temp = mfa_kaip_array("SELECT * FROM temperature");
    if($temp){
        foreach($temp as $tmp){
            $data1 = $data1 . '"'. $tmp['temp'].'",';
            $data2 = $data2 . '"'. $tmp['created_at'].'",';
        }
    }

    $controll = mfa_kaip_array("SELECT * FROM controller");
    if($controll){
        foreach($controll as $tmp){
            $data3 = $data3 . '"'. $tmp['state'].'",';
            $data4 = $data4 . '"'. $tmp['created_at'].'",';
        }
    }
    ?>
<?php include('./footer.php');?>
<script>
$(document).ready(function () {

    var myChart = new Chart($('#temp_graph'), {
        type: 'line',
        data: {
            labels: [<?php echo $data2;?>],
            datasets: 
            [{
                data: [<?php echo $data1; ?>],
                backgroundColor: 'transparent',
                borderColor:'rgba(255,99,132)',
                borderWidth: 3
            },

            {
                data: [<?php echo $data2; ?>],
                backgroundColor: 'transparent',
                borderColor:'rgba(0,255,255)',
                borderWidth: 3	
            }]
        },
        
        options: {
            scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 200}]}},
            tooltips:{mode: 'index'},
            legend:{display: false, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
        }
    });

    var myChart = new Chart($('#controller_graph'), {
        type: 'line',
        data: {
            labels: [<?php echo $data4;?>],
            datasets: 
            [{
                data: [<?php echo $data3; ?>],
                backgroundColor: 'transparent',
                borderColor:'rgba(255,99,132)',
                borderWidth: 3
            },

            {
                data: [<?php echo $data4; ?>],
                backgroundColor: 'transparent',
                borderColor:'rgba(0,255,255)',
                borderWidth: 3	
            }]
        },
        
        options: {
            scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 200}]}},
            tooltips:{mode: 'index'},
            legend:{display: false, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
        }
    });

});
</script>