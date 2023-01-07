<html>
    <head>
    </head>
    <body>
        <?php
            //echo "<datalist id='materials'>";

            $db_conn = "";
            $db_conn .= "host=dbserver ";
            $db_conn .= "port=6432 ";
            $db_conn .= "dbname=db_smed ";
            $db_conn .= "user=smed_usr ";
            $db_conn .= "password=smed_pwd";

            $db = pg_connect($db_conn);

            $db_query = "";
            $db_query .= "SELECT DISTINCT denumirematerial FROM asmd_smedmaterial WHERE material = '" . $_GET['mat_text'] . "' and not trim(material) = ''";

            $result = pg_query($db, $db_query);

            while($row=pg_fetch_assoc($result)){
                echo $row['denumirematerial'];
            };
        ?>
    </body>
</html>
