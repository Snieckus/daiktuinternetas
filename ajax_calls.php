

<?php
require_once('./config.php');
require_once('./global_functions.php');
//page2
switch($_POST['call']){
    case 'delete_data':
        switch($_POST['table_name']){
            case 'temperature':
                send_pg_query("DELETE FROM temperature WHERE id = '".$_POST['id']."'");
                $columns = array(
                    'id' => 'ID',
                    'temp' => 'Temperatūra <span>&#8451;</span>',
                    'created_at' => 'Data'
                );
                $sql = "SELECT * FROM temperature";
                $var = autosearch($sql, $columns, 'temperature');
            break;
            case 'controller':
                send_pg_query("DELETE FROM controller WHERE id = '".$_POST['id']."'");
                $columns = array(
                    'id' => 'ID',
                    'state' => 'Būsena',
                    'created_at' => 'Data'
                );
                $sql = "SELECT * FROM controller";
                $var = autosearch($sql, $columns, 'controller');
            break;
        }
    echo json_encode($var);   
    break;
    case 'switch_rele':
        send_pg_query("INSERT INTO controller (state) VALUES('".$_POST['state']."')");

        // $response = file_get_contents('http://daiktuinternetasnodered.herokuapp.com');
        // echo $response;

        $url = 'http://daiktuinternetasnodered.herokuapp.com/state';
        $data = array('key1' => $_POST['state']);
        
        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */ }
        
        var_dump($result);
    break;
}