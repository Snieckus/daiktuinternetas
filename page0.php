<?php include('./header.php');?>
    <div class="container">
        <span id="id">Page1</span>
        <?php
        $data = array(array(
            '0' => 'array'
            )
        );
        //dump($data);
        send_pg_query("CREATE TABLE temperature (
            id              SERIAL PRIMARY KEY,
            temp           VARCHAR(100) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
          );");
       // send_pg_query("INSERT INTO savitosios_varzos (metalas, savitoji_varza) VALUES('Aliuminis', 0.000000028)");

        //$data = mfa_kaip_array("SELECT * FROM persons");
        //dump($data);
        ?>
    </div>
<?php include('./footer.php');?>