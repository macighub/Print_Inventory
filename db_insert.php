<html>
    <head>
        
    </head>
    <body>
        <?php
            $db = pg_connect("host=dbserver port=6432 dbname=db_inv user=inv_usr password=inv_pwd");
            $query = "INSERT INTO sb_reports.inv_records (prod_line,pn,pn_desc,m_unit,ref_weight,stub_weight,ref_value,rec_weight,rec_value) ";
            $query .= "VALUES ('" . $_GET['prod_line'] . "', '" . $_GET['pn'] . "', '" . $_GET['pn_desc'] . "', '" . $_GET['m_unit'] . "', " . $_GET['ref_weight'] . ", " . $_GET['stub_weight'] . ", " . $_GET['ref_value'] . ", " . $_GET['rec_weight'] . ", " . $_GET['rec_value'] . ")";
            $result = pg_query($query); 

            echo $query
        ?>
    </body>
</html>
