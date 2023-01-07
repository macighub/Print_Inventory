<html>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="../jquery.min.js"></script>
    <script>
        String.prototype.replaceAll = function(str1, str2, ignore) 
        {
            return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g,"\\$&"),(ignore?"gi":"g")),(typeof(str2)=="string")?str2.replace(/\$/g,"$$$$"):str2);
        };

        $(document).ready(function() {
            var content_url = "http://webserver/inventory/inv_db.php";
            content_url += "?method=load";
            content_url += "&prod_line=" + $('#pline').val();

            $('#tbl_db').load(content_url);

            $('#pline').on('input', function() {
                var content_url = "http://webserver/inventory/inv_db.php";
                content_url += "?method=load";
                content_url += "&prod_line=" + $('#pline').val();

                $('#tbl_db').load(content_url);
            });

             $('#material').on('input', function() {
                material_oninput()
            });

           $('#meas_weight').on('input', function() {
                meas_weight_oninput()
            });
        });

        function meas_weight_oninput() {
            if ( $.isNumeric($('#meas_weight').val()) || ($('#meas_weight').val() == "")  || ($('#meas_weight').val() == ".") ) {
                if ($('#meas_weight').val() == ".") {
                    $('#meas_weight').val("0.");
                };
                $('#meas_weight').attr('revertvalue', $('#meas_weight').val());
                
                var c_meas_weight = $('#meas_weight').val();
                var c_ref_weight = $('#inf_ref_weight').val();
                var c_stub_weight = $('#inf_stub_weight').val();
                var c_ref_val = $('#inf_ref_val').val();
                
                var c_value = (c_meas_weight - c_stub_weight) / ((c_ref_weight - c_stub_weight) / c_ref_val);

                if (c_value > c_ref_val) {
                    c_value = c_ref_val;
                } else {
                    if (c_value < 0) {
                        c_value = 0;
                    };
                };
                
                if ( $('#typ_meters').attr("checked") ) {
                    c_value = parseFloat(Math.round(c_value * 100) / 100).toFixed(3);
                } else {
                    c_value = parseFloat(Math.round(c_value * 100) / 100).toFixed(0);
                };

                if ($('#meas_weight').val() == "") {
                    $('#calc_val').val("")
                } else {                        
                    $('#calc_val').val(c_value);
                };
            } else {
                $('#meas_weight').val($('#meas_weight').attr('revertvalue'));
            };
        }

        function material_oninput() {
            var mat_text = $('#material').val();
            var found_text;

            $('#txt_pn_desc').val("");
            $('#typ_meters').attr("checked", false);
            $('#typ_pieces').attr("checked", false);
            $('#inf_ref_weight').val("");
            $('#inf_stub_weight').val("");
            $('#inf_ref_val').val("");
            $('#meas_weight').val("");
            $('#calc_val').val("");
            document.getElementById('lbl_ref_unit').innerText = "meters / pieces";
            document.getElementById('lbl_unit').innerText = "meters / pieces";
            
            document.getElementById($('#material').attr("id")).style.background = 'white';

            if (mat_text.substr(0,1) == "P") {
                mat_text = mat_text.substr(1);
            };

            $("#materials").find("option").each(function() {
                if (mat_text.substr(0,1) == "(") {
                    found_text = $(this).attr("mat_desc");
                } else {
                    found_text = $(this).attr("pn");
                };
                
                if (found_text == mat_text) {
                    if ($('#material').val() != $(this).attr("pn")) {
                        $('#material').val($(this).attr("pn"));
                    };
                    
                    $('#txt_pn_desc').val($(this).attr("pn_desc") + $(this).attr("mat_desc"));
                    if ($(this).attr("m_unit") == "m") {
                        $('#typ_meters').attr("checked", true);
                        $('#typ_pieces').attr("checked", false);
                        document.getElementById('lbl_ref_unit').innerText = "meters";
                        document.getElementById('lbl_unit').innerText = "meters";
                    } else {
                        $('#typ_meters').attr("checked", false);
                        $('#typ_pieces').attr("checked", true);
                        document.getElementById('lbl_ref_unit').innerText = "pieces";
                        document.getElementById('lbl_unit').innerText = "pieces";
                    };
                    $('#inf_ref_weight').val($(this).attr("ref_weight"));
                    $('#inf_stub_weight').val($(this).attr("stub_weight"));
                    $('#inf_ref_val').val($(this).attr("ref_value"));
                };
            });
        };

        function data_submit() {
            if ( ($('#pline').val() != "") && ($('#material').val() != "") && ( ($('#typ_meters').attr("checked")) || ($('#typ_pieces').attr("checked")) ) && ($('#meas_weight').val() != "") && ($('#calc_val').val() != "") ) {
                var insert_url = "http://webserver/inventory/inv_db.php";
                insert_url += "?method=insert";
                insert_url += "&prod_line=" + $('#pline').val();
                insert_url += "&pn=" + $('#material').val();
                insert_url += "&pn_desc=" + $('#txt_pn_desc').val();
                if ( $('#typ_meters').attr("checked") ) {
                    insert_url += "&m_unit=m";
                } else {
                    insert_url += "&m_unit=q";
                }
                insert_url += "&ref_weight=" + $('#inf_ref_weight').val();
                insert_url += "&stub_weight=" + $('#inf_stub_weight').val();
                insert_url += "&ref_value=" + $('#inf_ref_val').val();
                insert_url += "&rec_weight=" + $('#meas_weight').val();
                insert_url += "&rec_value=" + $('#calc_val').val();
                
                insert_url = insert_url.replaceAll(" ", "_")

                $('#tbl_db').load(insert_url);

                var content_url = "http://webserver/inventory/inv_db.php";
                content_url += "?method=load";
                content_url += "&prod_line=" + $('#pline').val();
                
                $('#tbl_db').load(content_url);

                alert("Success")
                
                $('#material').val("");
                $('#txt_pn_desc').val("");
                $('#typ_meters').attr("checked", false);
                $('#typ_pieces').attr("checked", false);
                $('#inf_ref_weight').val("");
                $('#inf_stub_weight').val("");
                $('#inf_ref_val').val("");
                $('#meas_weight').val("");
                $('#calc_val').val("");
                document.getElementById('lbl_ref_unit').innerText = "meters / pieces";
                document.getElementById('lbl_unit').innerText = "meters / pieces";
            } else {
                alert("Incomplete Data-Set!");
            };
        };

        function data_reset() {
            $('#pline').val("");
            $('#material').val("");
            $('#txt_pn_desc').val("");
            $('#typ_meters').attr("checked", false);
            $('#typ_pieces').attr("checked", false);
            $('#inf_ref_weight').val("");
            $('#inf_stub_weight').val("");
            $('#inf_ref_val').val("");
            $('#meas_weight').val("");
            $('#calc_val').val("");
            document.getElementById('lbl_ref_unit').innerText = "meters / pieces";
            document.getElementById('lbl_unit').innerText = "meters / pieces";
            
            var content_url = "http://webserver/inventory/inv_db.php";
            content_url += "?method=load";
            content_url += "&prod_line=" + $('#pline').val();

            $('#tbl_db').load(content_url);
        };

        function touchkey_onclick(touchkey) {
            var key_code = $(touchkey).attr("touchkey");
            if (document.activeElement.getAttribute("id") == "qty") {
                editelement = "#qty";
            } else { 
                editelement = "#meas_weight";
            };

            switch (true) {
                case (key_code <= 9):
                    $('#meas_weight').val($('#meas_weight').val() + key_code);
                    break;
                case (key_code == "DOT"):
                    $('#meas_weight').val($('#meas_weight').val() + ".");
                    break;
                case (key_code == "DEL"):
                    $('#meas_weight').val("");
                    break;
                case (key_code == "SUBMIT"):
                    data_submit();
                    break;
                case (key_code == "RESET"):
                    data_reset();
                    break;
            };

            meas_weight_oninput();
        };

        function touchkey_onmousedown(touchkey) {
            document.getElementById($(touchkey).attr("touchkey")).style.background = "rgb(50,50,50)";
            document.getElementById($(touchkey).attr("touchkey")).style.background = "-moz-linear-gradient(-45deg,  rgba(50,50,50,1) 0%, rgba(100,100,100,1) 50%, rgba(100,100,100,1) 51%, rgba(50,50,50,1) 100%)";
            document.getElementById($(touchkey).attr("touchkey")).style.background = "-webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(50,50,50,1)), color-stop(50%,rgba(100,100,100,1)), color-stop(51%,rgba(100,100,100,1)), color-stop(100%,rgba(50,50,50,1)))";
            document.getElementById($(touchkey).attr("touchkey")).style.background = "-webkit-linear-gradient(-45deg,  rgba(50,50,50,1) 0%,rgba(100,100,100,1) 50%,rgba(100,100,100,1) 51%,rgba(50,50,50,1) 100%)";
            document.getElementById($(touchkey).attr("touchkey")).style.background = "-o-linear-gradient(-45deg,  rgba(50,50,50,1) 0%,rgba(100,100,100,1) 50%,rgba(100,100,100,1) 51%,rgba(50,50,50,1) 100%)";
            document.getElementById($(touchkey).attr("touchkey")).style.background = "-ms-linear-gradient(-45deg,  rgba(50,50,50,1) 0%,rgba(100,100,100,1) 50%,rgba(100,100,100,1) 51%,rgba(50,50,50,1) 100%)";
            document.getElementById($(touchkey).attr("touchkey")).style.background = "linear-gradient(135deg,  rgba(50,50,50,1) 0%,rgba(100,100,100,1) 50%,rgba(100,100,100,1) 51%,rgba(50,50,50,1) 100%)";
        };

        function touchkey_onmouseup(touchkey) {
            document.getElementById($(touchkey).attr("touchkey")).style.background = "rgb(100,100,100)";
            document.getElementById($(touchkey).attr("touchkey")).style.background = "-moz-linear-gradient(-45deg,  rgba(100,100,100,1) 0%, rgba(50,50,50,1) 50%, rgba(50,50,50,1) 51%, rgba(100,100,100,1) 100%)";
            document.getElementById($(touchkey).attr("touchkey")).style.background = "-webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(100,100,100,1)), color-stop(50%,rgba(50,50,50,1)), color-stop(51%,rgba(50,50,50,1)), color-stop(100%,rgba(100,100,100,1)))";
            document.getElementById($(touchkey).attr("touchkey")).style.background = "-webkit-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%)";
            document.getElementById($(touchkey).attr("touchkey")).style.background = "-o-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%)";
            document.getElementById($(touchkey).attr("touchkey")).style.background = "-ms-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%)";
            document.getElementById($(touchkey).attr("touchkey")).style.background = "linear-gradient(135deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%)";
        };
    </script>
    <head>

    </head>

	<body style='background:#595959'>
        <form action="db_insert.php" method="get" id="page_form">
            <table cellpadding="0" cellspacing="0" 
                style='background:#595959;
                        height:100%;
                        width:100%'>
                <tr style='height:20pt;
                        background: rgb(100,100,100);
                        background: -moz-linear-gradient(-45deg,  rgba(100,100,100,1) 0%, rgba(50,50,50,1) 50%, rgba(50,50,50,1) 51%, rgba(100,100,100,1) 100%);
                        background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(100,100,100,1)), color-stop(50%,rgba(50,50,50,1)), color-stop(51%,rgba(50,50,50,1)), color-stop(100%,rgba(100,100,100,1)));
                        background: -webkit-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -o-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: -ms-linear-gradient(-45deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        background: linear-gradient(135deg,  rgba(100,100,100,1) 0%,rgba(50,50,50,1) 50%,rgba(50,50,50,1) 51%,rgba(100,100,100,1) 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )'>
                    <td colspan="2" valign=center 
                        style='height:20pt;
                                border-bottom:solid black 4.0pt;
                                padding-left:10;
                                padding-right:10'>
                        <div style='float:left;
                                    font-family:arial;
                                    font-size:18pt;
                                    color:white;
                                    cursor:default'>
                            <b>
                                Inventory
                            </b>
                        </div>
                    </td>
                </tr>
                <tr style='height:250pt'>
                    <td style='border-bottom:solid black 2pt'>
                        <table width='100%'>
                            <td align='center'>
                                <table width='700pt'>
                                    <tr>
                                        <td align='right'>
                                            <label style='font-family:arial;
                                                        font-size:14pt;
                                                        color:white'>
                                                Line:
                                            </label>
                                        </td>
                                        <td align='left'>
                                            <input id='pline'
                                                name='pline'
                                                list="lines" 
                                                value=""
                                                style='width:75pt;
                                                        background:white;
                                                        font-family:arial;
                                                        font-size:14pt;
                                                        text-align:center;
                                                        border-left:solid black 1pt;
                                                        border-top:solid black 1pt;
                                                        border-bottom:solid grey 1pt;
                                                        border-right:solid grey 1pt'/>
                                            <datalist id='lines'>
                                                <?php
                                                    $db_conn = "";
                                                    $db_conn .= "host=dbserver ";
                                                    $db_conn .= "port=6432 ";
                                                    $db_conn .= "dbname=inv_db ";
                                                    $db_conn .= "user=inv_usr ";
                                                    $db_conn .= "password=inv_pwd";

                                                    $db = pg_connect($db_conn);

                                                    $db_query = "";
                                                    $db_query .= "SELECT area_locations ";
                                                    $db_query .= "FROM sb_reports.inv_areas ";

                                                    $result = pg_query($db, $db_query);

                                                    $rowcnt=0;
                                                    while($row=pg_fetch_assoc($result)){;
                                                        $rowcnt += 1;
                                                        
                                                        $locations = explode(",", $row['area_locations']);

                                                        foreach($locations as $location) {
                                                            echo "<option value= '";
                                                            echo $location;
                                                            echo "'>";
                                                        };
                                                    };
                                                ?>
                                            </datalist>
                                        </td>
                                        <td align='right'>
                                            <div style='white-space: nowrap'>
                                                <label style='font-family:arial;
                                                            font-size:14pt;
                                                            color:white'>
                                                    Part Number:
                                                </label>
                                            </div>
                                        </td>
                                        <td align='left'>
                                            <input id="material"
                                                list="materials" 
                                                value=""
                                                style='width:200pt;
                                                        background:white;
                                                        font-family:arial;
                                                        font-size:14pt;
                                                        text-align:center;
                                                        border-left:solid black 1pt;
                                                        border-top:solid black 1pt;
                                                        border-bottom:solid grey 1pt;
                                                        border-right:solid grey 1pt'/>
                                                        
                                            <?php
                                                echo "<datalist id='materials'>";

                                                $db_conn = "";
                                                $db_conn .= "host=dbserver ";
                                                $db_conn .= "port=6432 ";
                                                $db_conn .= "dbname=inv_db ";
                                                $db_conn .= "user=inv_usr ";
                                                $db_conn .= "password=in_pwd";

                                                $db = pg_connect($db_conn);

                                                $db_query = "";
                                                $db_query .= "SELECT * from sb_reports.v_inv_basic_data order by mat_desc";

                                                $result = pg_query($db, $db_query);

                                                while($row=pg_fetch_assoc($result)){
                                                    echo "<option ";
                                                    echo "id=\"" . $row['pn'] . "\" ";
                                                    echo "value=\"" . $row['mat_desc'] . "\" ";
                                                    echo "pn=\"" . $row['pn'] . "\" ";
                                                    echo "pn_desc=\"" . $row['pn_desc'] . "\" ";
                                                    echo "mat_desc=\"" . $row['mat_desc'] . "\" ";
                                                    echo "m_unit=\"" . $row['m_unit'] . "\" ";
                                                    echo "ref_weight=\"" . $row['ref_weight'] . "\" ";
                                                    echo "stub_weight=\"" . $row['stub_weight'] . "\" ";
                                                    echo "ref_value=\"" . $row['ref_value'] . "\"";
                                                    echo ">";
                                                };

                                                echo "</datalist>";
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align='center' colspan='4'
                                            style='padding-top:25pt'>
                                            <label style='font-family:arial;
                                                        font-size:10pt;
                                                        color:darkgrey'>
                                                Part Description:
                                            </label>
                                            <input type="text" 
                                                id="txt_pn_desc"
                                                value=""
                                                readonly
                                                style='width:375pt;
                                                        background:darkgrey;
                                                        font-family:arial;
                                                        font-size:10pt;
                                                        text-align:center;
                                                        border-left:solid black 1pt;
                                                        border-top:solid black 1pt;
                                                        border-bottom:solid grey 1pt;
                                                        border-right:solid grey 1pt'>
                                            
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align='right'
                                            valign='top'
                                            style='font-family:arial;
                                                font-size:14pt;
                                                color:white;
                                                padding-top:3pt'>
                                            <label style='font-family:arial;
                                                        font-size:10pt;
                                                        color:darkgrey'>
                                                Unit:
                                            </label>
                                        </td>
                                        <td align='left'
                                            valign='top'
                                            style='font-family:arial;
                                                font-size:10pt;
                                                color:darkgrey'>
                                            <div style='white-space: nowrap'>
                                                <input id='typ_meters'
                                                    type="radio"
                                                    disabled
                                                    style='cursor:default'>
                                                </input>
                                                <label for='typ_meters' style='cursor:default'>
                                                        meters
                                                </label>
                                                <input id='typ_pieces' 
                                                    type="radio"
                                                    disabled
                                                    style='cursor:default'>
                                                </input>
                                                <label for='typ_pieces' style='cursor:default'>
                                                        pieces
                                                </label>
                                            </div>
                                        </td>
                                        <td align='right'>
                                            <div style='white-space: nowrap'>
                                                <label style='font-family:arial;
                                                            font-size:10pt;
                                                            color:darkgrey'>
                                                    Weight: 
                                                </label>
                                            </div>
                                        </td>
                                        <td align='left'>
                                            <div style='white-space: nowrap'>
                                                <input id='inf_ref_weight' type="text" 
                                                    value=""
                                                    revertvalue=""
                                                    readonly
                                                    style='padding-right:10pt;
                                                            width:80pt;
                                                            font-family:arial;
                                                            font-size:10pt;
                                                            text-align:center;
                                                            background:darkgrey;
                                                        border-left:solid black 1pt;
                                                        border-top:solid black 1pt;
                                                        border-bottom:solid grey 1pt;
                                                        border-right:solid grey 1pt'>
                                                </input>
                                                <label style='font-family:arial;
                                                                font-size:10pt;
                                                                color:darkgrey'>
                                                    gramms 
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align='center'
                                            colspan='2'
                                            valign='top'
                                            style='font-family:arial;
                                                font-size:10pt;
                                                color:darkgrey'>
                                            <div style='white-space: nowrap'>
                                                <label style='font-family:arial;
                                                            font-size:10pt;
                                                            color:darkgrey'>
                                                    Stub Weight:
                                                    <input id='inf_stub_weight' 
                                                        type="text" 
                                                        value=""
                                                        readonly
                                                        style='padding-right:10pt;
                                                                width:80pt;
                                                                font-family:arial;
                                                                font-size:10pt;
                                                                text-align:center;
                                                                background:darkgrey;
                                                        border-left:solid black 1pt;
                                                        border-top:solid black 1pt;
                                                        border-bottom:solid grey 1pt;
                                                        border-right:solid grey 1pt'>
                                                    </input>
                                                </label>
                                            </div>
                                        </td>
                                        <td align='right'>
                                            <div style='white-space: nowrap'>
                                                <label style='font-family:arial;
                                                            font-size:10pt;
                                                            color:darkgrey'>
                                                    equals: 
                                                </label>
                                            </div>
                                        </td>
                                        <td align='left'>
                                            <input id='inf_ref_val' type="text" 
                                                value=""
                                                readonly
                                                style='padding-right:10pt;
                                                        width:80pt;
                                                        font-family:arial;
                                                        font-size:10pt;
                                                        text-align:center;
                                                        background:darkgrey;
                                                        border-left:solid black 1pt;
                                                        border-top:solid black 1pt;
                                                        border-bottom:solid grey 1pt;
                                                        border-right:solid grey 1pt'>
                                            </input>
                                            <label  id='lbl_ref_unit'
                                                    style='font-family:arial;
                                                            font-size:10pt;
                                                            color:darkgrey'>
                                                meters / pieces 
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align='right'
                                            valign='top'
                                            style='padding-top:27pt'>
                                            <label style='font-family:arial;
                                                        font-size:14pt;
                                                        color:white;'>
                                                Weight:
                                            </label>
                                        </td>
                                        <td align='left'
                                            valign='top'
                                            style='padding-top:25pt'>
                                            <input id='meas_weight'
                                                type="text" 
                                                value=""
                                                style='width:75pt;
                                                        background:white;
                                                        font-family:arial;
                                                        font-size:14pt;
                                                        text-align:center;
                                                        border-left:solid black 1pt;
                                                        border-top:solid black 1pt;
                                                        border-bottom:solid grey 1pt;
                                                        border-right:solid grey 1pt'>
                                            
                                            </select>
                                        </td>
                                        <td align='right'
                                            valign='top'
                                            style='padding-top:27pt'>
                                            <div style='white-space: nowrap'>
                                                <label style='font-family:arial;
                                                            font-size:14pt;
                                                            color:white'>
                                                    Equals:
                                                </label>
                                            </div>
                                        </td>
                                        <td align='left'
                                            valign='top'
                                            style='padding-top:25pt'>
                                            <input id='calc_val' type="text" 
                                                value=""
                                                readonly
                                                style='padding-right:10pt;
                                                        background:white;
                                                        width:80pt;
                                                        font-family:arial;
                                                        font-size:14pt;
                                                        text-align:center;
                                                        background:darkgrey;
                                                        border-left:solid black 1pt;
                                                        border-top:solid black 1pt;
                                                        border-bottom:solid grey 1pt;
                                                        border-right:solid grey 1pt'>
                                            </input>
                                            <label  id='lbl_unit'
                                                    style='font-family:arial;
                                                        font-size:14pt;
                                                        color:white'>
                                                meters / pieces
                                            </label>
                                        </td>
                                    </tr>
                                    <tr height='70pt'>
                                        <td colspan='4'
                                            align='center'
                                            valign='bottom'>
                                            <table width='500pt'
                                                height='40pt'
                                                
                                                <tr>
                                                    <td id='SUBMIT' 
                                                        onmousedown='touchkey_onmousedown(this)'
                                                        onmouseup='touchkey_onmouseup(this)'
                                                        onclick='touchkey_onclick(this)'
                                                        touchkey='SUBMIT' 
                                                        readonly
                                                        style='text-align:center;
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
                                                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )'>
                                                        <label style='-webkit-touch-callout: none;
                                                            -webkit-user-select: none;
                                                            -khtml-user-select: none;
                                                            -moz-user-select: none;
                                                            -ms-user-select: none;
                                                            user-select:none;
                                                            font-family:arial;
                                                            font-size:24pt;
                                                            color:white'>
                                                            SUBMIT
                                                        </label>
                                                    </td>
                                                    <td width='100pt'>
                                                    </td>
                                                    <td id='RESET' 
                                                        onmousedown='touchkey_onmousedown(this)'
                                                        onmouseup='touchkey_onmouseup(this)'
                                                        onclick='touchkey_onclick(this)'
                                                        touchkey='RESET' 
                                                        readonly 
                                                        style='text-align:center;
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
                                                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )'>
                                                        <label style='-webkit-touch-callout: none;
                                                            -webkit-user-select: none;
                                                            -khtml-user-select: none;
                                                            -moz-user-select: none;
                                                            -ms-user-select: none;
                                                            user-select:none;
                                                            font-family:arial;
                                                            font-size:24pt;
                                                            color:white'>
                                                            RESET
                                                        </label>
                                                    </td>
                                                </tr>
                                            </table
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </table>
                    </td>
                    <td width='300pt'
                        style='border-left:solid black 1pt;
                            border-bottom:solid black 2pt'>
                        <table width='100%'
                            height='100%'
                            style='padding:10pt'>
                            <tr>
                                <td id='7' 
                                    onmousedown='touchkey_onmousedown(this)'
                                    onmouseup='touchkey_onmouseup(this)'
                                    onclick='touchkey_onclick(this)'
                                    touchkey='7' 
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
                                    <label style='-webkit-touch-callout: none;
                                                -webkit-user-select: none;
                                                -khtml-user-select: none;
                                                -moz-user-select: none;
                                                -ms-user-select: none;
                                                user-select:none;
                                                font-family:arial;
                                                font-size:28pt;
                                                color:white'>
                                        7
                                    </label>
                                </td>
                                <td id='8' 
                                    onmousedown='touchkey_onmousedown(this)'
                                    onmouseup='touchkey_onmouseup(this)'
                                    onclick='touchkey_onclick(this)'
                                    touchkey='8' 
                                    readonly 
                                    style='text-align:center;
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
                                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )'>
                                    <label style='-webkit-touch-callout: none;
                                                -webkit-user-select: none;
                                                -khtml-user-select: none;
                                                -moz-user-select: none;
                                                -ms-user-select: none;
                                                user-select:none;
                                                font-family:arial;
                                        font-size:28pt;
                                        color:white'>
                                        8
                                    </label>
                                </td>
                                <td id='9' 
                                    onmousedown='touchkey_onmousedown(this)'
                                    onmouseup='touchkey_onmouseup(this)'
                                    onclick='touchkey_onclick(this)'
                                    touchkey='9' 
                                    readonly 
                                    style='text-align:center;
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
                                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )'>
                                    <label style='-webkit-touch-callout: none;
                                                -webkit-user-select: none;
                                                -khtml-user-select: none;
                                                -moz-user-select: none;
                                                -ms-user-select: none;
                                                user-select:none;
                                                font-family:arial;
                                        font-size:28pt;
                                        color:white'>
                                        9
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td id='4' 
                                    onmousedown='touchkey_onmousedown(this)'
                                    onmouseup='touchkey_onmouseup(this)'
                                    onclick='touchkey_onclick(this)'
                                    touchkey='4' 
                                    readonly 
                                    style='text-align:center;
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
                                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )'>
                                    <label style='-webkit-touch-callout: none;
                                                -webkit-user-select: none;
                                                -khtml-user-select: none;
                                                -moz-user-select: none;
                                                -ms-user-select: none;
                                                user-select:none;
                                                font-family:arial;
                                                font-size:28pt;
                                                color:white'>
                                        4
                                    </label>
                                </td>
                                <td id='5' 
                                    onmousedown='touchkey_onmousedown(this)'
                                    onmouseup='touchkey_onmouseup(this)'
                                    onclick='touchkey_onclick(this)'
                                    touchkey='5' 
                                    readonly 
                                    style='text-align:center;
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
                                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )'>
                                    <label style='-webkit-touch-callout: none;
                                                -webkit-user-select: none;
                                                -khtml-user-select: none;
                                                -moz-user-select: none;
                                                -ms-user-select: none;
                                                user-select:none;
                                                font-family:arial;
                                                font-size:28pt;
                                                color:white'>
                                        5
                                    </label>
                                </td>
                                <td id='6' 
                                    onmousedown='touchkey_onmousedown(this)'
                                    onmouseup='touchkey_onmouseup(this)'
                                    onclick='touchkey_onclick(this)'
                                    touchkey='6' 
                                    readonly 
                                    style='text-align:center;
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
                                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )'>
                                    <label style='-webkit-touch-callout: none;
                                                -webkit-user-select: none;
                                                -khtml-user-select: none;
                                                -moz-user-select: none;
                                                -ms-user-select: none;
                                                user-select:none;
                                                font-family:arial;
                                                font-size:28pt;
                                                color:white'>
                                        6
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td id='1' 
                                    onmousedown='touchkey_onmousedown(this)'
                                    onmouseup='touchkey_onmouseup(this)'
                                    onclick='touchkey_onclick(this)'
                                    touchkey='1' 
                                    readonly 
                                    style='text-align:center;
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
                                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )'>
                                    <label style='-webkit-touch-callout: none;
                                                -webkit-user-select: none;
                                                -khtml-user-select: none;
                                                -moz-user-select: none;
                                                -ms-user-select: none;
                                                user-select:none;
                                                font-family:arial;
                                                font-size:28pt;
                                                color:white'>
                                        1
                                    </label>
                                </td>
                                <td id='2' 
                                    onmousedown='touchkey_onmousedown(this)'
                                    onmouseup='touchkey_onmouseup(this)'
                                    onclick='touchkey_onclick(this)'
                                    touchkey='2' 
                                    readonly 
                                    style='text-align:center;
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
                                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )'>
                                    <label style='-webkit-touch-callout: none;
                                                -webkit-user-select: none;
                                                -khtml-user-select: none;
                                                -moz-user-select: none;
                                                -ms-user-select: none;
                                                user-select:none;
                                                font-family:arial;
                                                font-size:28pt;
                                                color:white'>
                                        2
                                    </label>
                                </td>
                                <td id='3' 
                                    onmousedown='touchkey_onmousedown(this)'
                                    onmouseup='touchkey_onmouseup(this)'
                                    onclick='touchkey_onclick(this)'
                                    touchkey='3' 
                                    readonly 
                                    style='text-align:center;
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
                                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )'>
                                    <label style='-webkit-touch-callout: none;
                                                -webkit-user-select: none;
                                                -khtml-user-select: none;
                                                -moz-user-select: none;
                                                -ms-user-select: none;
                                                user-select:none;
                                                font-family:arial;
                                                font-size:28pt;
                                                color:white'>
                                        3
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td id='0' 
                                    onmousedown='touchkey_onmousedown(this)'
                                    onmouseup='touchkey_onmouseup(this)'
                                    onclick='touchkey_onclick(this)'
                                    touchkey='0' 
                                    readonly 
                                    style='text-align:center;
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
                                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )'>
                                    <label style='-webkit-touch-callout: none;
                                                -webkit-user-select: none;
                                                -khtml-user-select: none;
                                                -moz-user-select: none;
                                                -ms-user-select: none;
                                                user-select:none;
                                                font-family:arial;
                                                font-size:28pt;
                                                color:white'>
                                        0
                                    </label>
                                </td>
                                <td id='DOT' 
                                    onmousedown='touchkey_onmousedown(this)'
                                    onmouseup='touchkey_onmouseup(this)'
                                    onclick='touchkey_onclick(this)'
                                    touchkey='DOT' 
                                    readonly 
                                    style='text-align:center;
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
                                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )'>
                                    <label style='-webkit-touch-callout: none;
                                                -webkit-user-select: none;
                                                -khtml-user-select: none;
                                                -moz-user-select: none;
                                                -ms-user-select: none;
                                                user-select:none;
                                                font-family:arial;
                                                font-size:28pt;
                                                color:white'>
                                        .
                                    </label>
                                </td>
                                <td id='DEL' 
                                    onmousedown='touchkey_onmousedown(this)'
                                    onmouseup='touchkey_onmouseup(this)'
                                    onclick='touchkey_onclick(this)'
                                    touchkey='DEL' 
                                    readonly 
                                    width='34%'
                                    style='text-align:center;
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
                                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#646464', endColorstr='#323232',GradientType=1 )'>
                                    <label style='-webkit-touch-callout: none;
                                                -webkit-user-select: none;
                                                -khtml-user-select: none;
                                                -moz-user-select: none;
                                                -ms-user-select: none;
                                                user-select:none;
                                                font-family:arial;
                                                font-size:20pt;
                                                color:white'>
                                        Del
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td id='tbl_db' colspan='2' valign='top'>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
