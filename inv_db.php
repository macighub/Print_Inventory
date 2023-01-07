<html>
    <head>
    </head>
    <body>
        <?php
            switch ($_GET['method']) {
                case "insert":
                    $db = pg_connect("host=dbserver port=6432 dbname=db_inv user=inv_usr password=inv_pwd");
                    $query = "INSERT INTO sb_reports.inv_records (prod_line,pn,pn_desc,m_unit,ref_weight,stub_weight,ref_value,rec_weight,rec_value) ";
                    $query .= "VALUES ('" . $_GET['prod_line'] . "', '" . $_GET['pn'] . "', '" . $_GET['pn_desc'] . "', '" . $_GET['m_unit'] . "', " . $_GET['ref_weight'] . ", " . $_GET['stub_weight'] . ", " . $_GET['ref_value'] . ", " . $_GET['rec_weight'] . ", " . $_GET['rec_value'] . ")";
                    $result = pg_query($query); 

                    //echo $query
                    break;
            };
        ?>
        <table cellspacing="0">
            <tr height='50pt'>
                <td width='8.34%'
                    readonly 
                    style="text-align:center;
                        border-left:solid grey 1pt;
                        border-top:solid grey 1pt;
                        border-bottom:solid black 1pt;
                        border-right:solid black 1pt;
                        background: rgb(100,100,100);
                        background: -moz-linear-gradient(-45deg,  rgba(100,100,100,1) 0%, rgba(50,50,50,1) 50%, rgba(50,50,50,1) 51%, rgba(100,100,100,1) 100%);
                        background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(100,100,100,1)), color-stop(50%,rgba(50,50,50,1)), color-stop(51%,rgba(50,50,50,1)), color-stop(100%,rgba(100,100,100,1)));
                        background: -webkit-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -o-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -ms-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: linear-gradient(135deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )">
                    <div style='text-align:center; 
                                font-family:arial; 
                                font-size:12pt; 
                                color:white;
                                padding-left:5pt;
                                padding-right:5pt'>
                        idx    
                    </div>
                </td>
                <td width='8.34%'
                    readonly 
                    style="text-align:center;
                        border-left:solid grey 1pt;
                        border-top:solid grey 1pt;
                        border-bottom:solid black 1pt;
                        border-right:solid black 1pt;
                        background: rgb(100,100,100);
                        background: -moz-linear-gradient(-45deg,  rgba(100,100,100,1) 0%, rgba(50,50,50,1) 50%, rgba(50,50,50,1) 51%, rgba(100,100,100,1) 100%);
                        background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(100,100,100,1)), color-stop(50%,rgba(50,50,50,1)), color-stop(51%,rgba(50,50,50,1)), color-stop(100%,rgba(100,100,100,1)));
                        background: -webkit-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -o-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -ms-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: linear-gradient(135deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )">
                    <div style='text-align:center; 
                                font-family:arial; 
                                font-size:12pt; 
                                color:white;
                                padding-left:5pt;
                                padding-right:5pt'>
                        Prod. Line   
                    </div>
                </td>
                <td width='8.34%'
                    readonly 
                    style="text-align:center;
                        border-left:solid grey 1pt;
                        border-top:solid grey 1pt;
                        border-bottom:solid black 1pt;
                        border-right:solid black 1pt;
                        background: rgb(100,100,100);
                        background: -moz-linear-gradient(-45deg,  rgba(100,100,100,1) 0%, rgba(50,50,50,1) 50%, rgba(50,50,50,1) 51%, rgba(100,100,100,1) 100%);
                        background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(100,100,100,1)), color-stop(50%,rgba(50,50,50,1)), color-stop(51%,rgba(50,50,50,1)), color-stop(100%,rgba(100,100,100,1)));
                        background: -webkit-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -o-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -ms-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: linear-gradient(135deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )">
                    <div style='text-align:center; 
                                font-family:arial; 
                                font-size:12pt; 
                                color:white;
                                padding-left:5pt;
                                padding-right:5pt'>
                        Date    
                    </div>
                </td>
                <td width='8.34%'
                    readonly 
                    style="text-align:center;
                        border-left:solid grey 1pt;
                        border-top:solid grey 1pt;
                        border-bottom:solid black 1pt;
                        border-right:solid black 1pt;
                        background: rgb(100,100,100);
                        background: -moz-linear-gradient(-45deg,  rgba(100,100,100,1) 0%, rgba(50,50,50,1) 50%, rgba(50,50,50,1) 51%, rgba(100,100,100,1) 100%);
                        background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(100,100,100,1)), color-stop(50%,rgba(50,50,50,1)), color-stop(51%,rgba(50,50,50,1)), color-stop(100%,rgba(100,100,100,1)));
                        background: -webkit-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -o-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -ms-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: linear-gradient(135deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )">
                    <div style='text-align:center; 
                                font-family:arial; 
                                font-size:12pt; 
                                color:white;
                                padding-left:5pt;
                                padding-right:5pt'>
                        Time    
                    </div>
                </td>
                <td width='8.34%'
                    readonly 
                    style="text-align:center;
                        border-left:solid grey 1pt;
                        border-top:solid grey 1pt;
                        border-bottom:solid black 1pt;
                        border-right:solid black 1pt;
                        background: rgb(100,100,100);
                        background: -moz-linear-gradient(-45deg,  rgba(100,100,100,1) 0%, rgba(50,50,50,1) 50%, rgba(50,50,50,1) 51%, rgba(100,100,100,1) 100%);
                        background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(100,100,100,1)), color-stop(50%,rgba(50,50,50,1)), color-stop(51%,rgba(50,50,50,1)), color-stop(100%,rgba(100,100,100,1)));
                        background: -webkit-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -o-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -ms-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: linear-gradient(135deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )">
                    <div style='text-align:center; 
                                font-family:arial; 
                                font-size:12pt; 
                                color:white;
                                padding-left:5pt;
                                padding-right:5pt'>
                        Part Number    
                    </div>
                </td>
                <td width='8.34%'
                    readonly 
                    style="text-align:center;
                        border-left:solid grey 1pt;
                        border-top:solid grey 1pt;
                        border-bottom:solid black 1pt;
                        border-right:solid black 1pt;
                        background: rgb(100,100,100);
                        background: -moz-linear-gradient(-45deg,  rgba(100,100,100,1) 0%, rgba(50,50,50,1) 50%, rgba(50,50,50,1) 51%, rgba(100,100,100,1) 100%);
                        background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(100,100,100,1)), color-stop(50%,rgba(50,50,50,1)), color-stop(51%,rgba(50,50,50,1)), color-stop(100%,rgba(100,100,100,1)));
                        background: -webkit-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -o-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -ms-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: linear-gradient(135deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )">
                    <div style='text-align:center; 
                                font-family:arial; 
                                font-size:12pt; 
                                color:white;
                                padding-left:5pt;
                                padding-right:5pt'>
                        Description    
                    </div>
                </td>
                <td width='8.34%'
                    readonly 
                    style="text-align:center;
                        border-left:solid grey 1pt;
                        border-top:solid grey 1pt;
                        border-bottom:solid black 1pt;
                        border-right:solid black 1pt;
                        background: rgb(100,100,100);
                        background: -moz-linear-gradient(-45deg,  rgba(100,100,100,1) 0%, rgba(50,50,50,1) 50%, rgba(50,50,50,1) 51%, rgba(100,100,100,1) 100%);
                        background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(100,100,100,1)), color-stop(50%,rgba(50,50,50,1)), color-stop(51%,rgba(50,50,50,1)), color-stop(100%,rgba(100,100,100,1)));
                        background: -webkit-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -o-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -ms-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: linear-gradient(135deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )">
                    <div style='text-align:center; 
                                font-family:arial; 
                                font-size:12pt; 
                                color:white;
                                padding-left:5pt;
                                padding-right:5pt'>
                        Unit    
                    </div>
                </td>
                <td width='8.34%'
                    readonly 
                    style="text-align:center;
                        border-left:solid grey 1pt;
                        border-top:solid grey 1pt;
                        border-bottom:solid black 1pt;
                        border-right:solid black 1pt;
                        background: rgb(100,100,100);
                        background: -moz-linear-gradient(-45deg,  rgba(100,100,100,1) 0%, rgba(50,50,50,1) 50%, rgba(50,50,50,1) 51%, rgba(100,100,100,1) 100%);
                        background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(100,100,100,1)), color-stop(50%,rgba(50,50,50,1)), color-stop(51%,rgba(50,50,50,1)), color-stop(100%,rgba(100,100,100,1)));
                        background: -webkit-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -o-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -ms-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: linear-gradient(135deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )">
                    <div style='text-align:center; 
                                font-family:arial; 
                                font-size:12pt; 
                                color:white;
                                padding-left:5pt;
                                padding-right:5pt'>
                        Reference Weight (g)   
                    </div>
                </td>
                <td width='8.34%'
                    readonly 
                    style="text-align:center;
                        border-left:solid grey 1pt;
                        border-top:solid grey 1pt;
                        border-bottom:solid black 1pt;
                        border-right:solid black 1pt;
                        background: rgb(100,100,100);
                        background: -moz-linear-gradient(-45deg,  rgba(100,100,100,1) 0%, rgba(50,50,50,1) 50%, rgba(50,50,50,1) 51%, rgba(100,100,100,1) 100%);
                        background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(100,100,100,1)), color-stop(50%,rgba(50,50,50,1)), color-stop(51%,rgba(50,50,50,1)), color-stop(100%,rgba(100,100,100,1)));
                        background: -webkit-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -o-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -ms-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: linear-gradient(135deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )">
                    <div style='text-align:center; 
                                font-family:arial; 
                                font-size:12pt; 
                                color:white;
                                padding-left:5pt;
                                padding-right:5pt'>
                        Stub Weight (g)    
                    </div>
                </td>
                <td width='8.34%'
                    readonly 
                    style="text-align:center;
                        border-left:solid grey 1pt;
                        border-top:solid grey 1pt;
                        border-bottom:solid black 1pt;
                        border-right:solid black 1pt;
                        background: rgb(100,100,100);
                        background: -moz-linear-gradient(-45deg,  rgba(100,100,100,1) 0%, rgba(50,50,50,1) 50%, rgba(50,50,50,1) 51%, rgba(100,100,100,1) 100%);
                        background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(100,100,100,1)), color-stop(50%,rgba(50,50,50,1)), color-stop(51%,rgba(50,50,50,1)), color-stop(100%,rgba(100,100,100,1)));
                        background: -webkit-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -o-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -ms-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: linear-gradient(135deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )">
                    <div style='text-align:center; 
                                font-family:arial; 
                                font-size:12pt; 
                                color:white;
                                padding-left:5pt;
                                padding-right:5pt'>
                        Reference Value    
                    </div>
                </td>
                <td width='8.34%'
                    readonly 
                    style="text-align:center;
                        border-left:solid grey 1pt;
                        border-top:solid grey 1pt;
                        border-bottom:solid black 1pt;
                        border-right:solid black 1pt;
                        background: rgb(100,100,100);
                        background: -moz-linear-gradient(-45deg,  rgba(100,100,100,1) 0%, rgba(50,50,50,1) 50%, rgba(50,50,50,1) 51%, rgba(100,100,100,1) 100%);
                        background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(100,100,100,1)), color-stop(50%,rgba(50,50,50,1)), color-stop(51%,rgba(50,50,50,1)), color-stop(100%,rgba(100,100,100,1)));
                        background: -webkit-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -o-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -ms-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: linear-gradient(135deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )">
                    <div style='text-align:center; 
                                font-family:arial; 
                                font-size:12pt; 
                                color:white;
                                padding-left:5pt;
                                padding-right:5pt'>
                        Recorded Weight (g)    
                    </div>
                </td>
                <td width='8.34%'
                    readonly 
                    style="text-align:center;
                        border-left:solid grey 1pt;
                        border-top:solid grey 1pt;
                        border-bottom:solid black 1pt;
                        border-right:solid black 1pt;
                        background: rgb(100,100,100);
                        background: -moz-linear-gradient(-45deg,  rgba(100,100,100,1) 0%, rgba(50,50,50,1) 50%, rgba(50,50,50,1) 51%, rgba(100,100,100,1) 100%);
                        background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(100,100,100,1)), color-stop(50%,rgba(50,50,50,1)), color-stop(51%,rgba(50,50,50,1)), color-stop(100%,rgba(100,100,100,1)));
                        background: -webkit-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -o-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -ms-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: linear-gradient(135deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )">
                    <div style='text-align:center; 
                                font-family:arial; 
                                font-size:12pt; 
                                color:white;
                                padding-left:5pt;
                                padding-right:5pt'>
                        Recorded Value    
                    </div>
                </td>
            </tr>

            <?php
                switch ($_GET['method']) {
                    case "load":
                    $db_conn = "";
                    $db_conn .= "host=dbserver ";
                    $db_conn .= "port=6432 ";
                    $db_conn .= "dbname=db_inv ";
                    $db_conn .= "user=inv_usr ";
                    $db_conn .= "password=inv_pwd";

                    $db = pg_connect($db_conn);

                    $db_query = "";
                    $db_query .= "SELECT * ";
                    $db_query .= "FROM sb_reports.inv_records ";
                    $db_query .= "WHERE prod_line='" . $_GET['prod_line'] . "' AND ";
                    $db_query .= "rec_date=to_char(now(), 'DD.MM.YYYY')";

                    $result = pg_query($db, $db_query);

                    $rowcnt=0;
                    while($row=pg_fetch_assoc($result)){;
                        $rowcnt += 1;

                        echo "<tr height='100%'>";

                        echo "<td style='border:solid darkgrey 1.0pt;'> ";
                        echo "<div style='text-align:center; "; 
                        echo "            font-family:arial; ";
                        echo "            font-size:12pt; ";
                        echo "            color:white'>";
                        echo $row['idx'];
                        echo "</div>";
                        echo "</td>";

                        echo "<td style='border:solid darkgrey 1.0pt;'> ";
                        echo "<div style='text-align:center; "; 
                        echo "            font-family:arial; ";
                        echo "            font-size:12pt; ";
                        echo "            color:white'>";
                        echo $row['prod_line'];
                        echo "</div>";
                        echo "</td>";

                        echo "<td style='border:solid darkgrey 1.0pt;'> ";
                        echo "<div style='text-align:center; "; 
                        echo "            font-family:arial; ";
                        echo "            font-size:12pt; ";
                        echo "            color:white'>";
                        echo $row['rec_date'];
                        echo "</div>";
                        echo "</td>";

                        echo "<td style='border:solid darkgrey 1.0pt;'> ";
                        echo "<div style='text-align:center; "; 
                        echo "            font-family:arial; ";
                        echo "            font-size:12pt; ";
                        echo "            color:white'>";
                        echo $row['rec_time'];
                        echo "</div>";
                        echo "</td>";

                        echo "<td style='border:solid darkgrey 1.0pt;'> ";
                        echo "<div style='text-align:center; "; 
                        echo "            font-family:arial; ";
                        echo "            font-size:12pt; ";
                        echo "            color:white'>";
                        echo $row['pn'];
                        echo "</div>";
                        echo "</td>";

                        echo "<td style='border:solid darkgrey 1.0pt;'> ";
                        echo "<div style='text-align:center; "; 
                        echo "            font-family:arial; ";
                        echo "            font-size:12pt; ";
                        echo "            color:white'>";
                        echo $row['pn_desc'];
                        echo "</div>";
                        echo "</td>";

                        echo "<td style='border:solid darkgrey 1.0pt;'> ";
                        echo "<div style='text-align:center; "; 
                        echo "            font-family:arial; ";
                        echo "            font-size:12pt; ";
                        echo "            color:white'>";
                        echo $row['m_unit'];
                        echo "</div>";
                        echo "</td>";

                        echo "<td style='border:solid darkgrey 1.0pt;'> ";
                        echo "<div style='text-align:center; "; 
                        echo "            font-family:arial; ";
                        echo "            font-size:12pt; ";
                        echo "            color:white'>";
                        echo $row['ref_weight'];
                        echo "</div>";
                        echo "</td>";

                        echo "<td style='border:solid darkgrey 1.0pt;'> ";
                        echo "<div style='text-align:center; "; 
                        echo "            font-family:arial; ";
                        echo "            font-size:12pt; ";
                        echo "            color:white'>";
                        echo $row['stub_weight'];
                        echo "</div>";
                        echo "</td>";

                        echo "<td style='border:solid darkgrey 1.0pt;'> ";
                        echo "<div style='text-align:center; "; 
                        echo "            font-family:arial; ";
                        echo "            font-size:12pt; ";
                        echo "            color:white'>";
                        echo $row['ref_value'];
                        echo "</div>";
                        echo "</td>";

                        echo "<td style='border:solid darkgrey 1.0pt;'> ";
                        echo "<div style='text-align:center; "; 
                        echo "            font-family:arial; ";
                        echo "            font-size:12pt; ";
                        echo "            color:white'>";
                        echo $row['rec_weight'];
                        echo "</div>";
                        echo "</td>";

                        echo "<td style='border:solid darkgrey 1.0pt;'> ";
                        echo "<div style='text-align:center; "; 
                        echo "            font-family:arial; ";
                        echo "            font-size:12pt; ";
                        echo "            color:white'>";
                        echo $row['rec_value'];
                        echo "</div>";
                        echo "</td>";

                        echo "</tr>";
                    };
                    break;
                };
            ?>
        </table>
    </body>
</html>
