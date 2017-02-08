<?php

    if (($_REQUEST["type_fault"]!='wrong_display') && ($_REQUEST["type_fault"]!='xconnect_other'))
    {
        
        // Σύνδεση με τη βάση
        include_once("../connection.php");

        $now = date('Y-m-d H:i:s', strtotime( '+1 hours', strtotime (date('d-m-Y H:i:s')) ));
        $today = date('Y-m-d');

        // Siebel SR, Full EMS Name & πληροφορία BRAS του Siebel
        $sr = $_REQUEST["txt_sr"];
        $ems = $_REQUEST["txt_ems"];
        $hop = $_REQUEST["txt_hop"];

        // Όνομα παρόχου
        $isp = $_REQUEST["txt_isp"];
        if($isp==0) { $isp_f = ''; } else
        if($isp==1) { $isp_f = 'Cyta'; } else
        if($isp==2) { $isp_f = 'Forthnet'; } else
        if($isp==3) { $isp_f = 'Vodafone'; } else
        if($isp==4) { $isp_f = 'Wind'; }

        //Περιγραφή προβλήματος
        $fault = $_REQUEST["type_fault"];
        if($fault=='xconnect_down') {$_fault = 'XConnect Down'; } else
        if($fault=='xconnect_unresolved') {$_fault = 'Unresolved XConnect'; } else
        if($fault=='no_xconnect') {$_fault = 'No XConnect'; } else
        if($fault=='xconnect_mismatch') {$_fault = 'VLAN Mismatch'; } else
        if($fault=='xconnect_wrong') {$_fault = 'Wrong XConnect'; } else
        if($fault=='xconnect_traffic') {$_fault = 'XConnect Traffic'; } else
        if($fault=='xconnect_unidentified') {$_fault = 'Unidentified XConnect'; }

        //Θέμα
        $_top = "XConnect (DSLAM: ".$ems." -- ISP: ".$isp_f.")";
        
        // Δημιουργία SQL Query string
        $sql= "
            INSERT INTO vpu
            ( date, subject, ems, hop, isp, sr, fault )
            VALUES
            ( '".$today."','".$_top."','".$ems."','".$hop."','".$isp_f."','".$sr."','".$_fault."' ) 
        ";
        
        // Εκτέλεση SQL query
        if ($conn->query($sql) === TRUE ) {
            // do nothing!
        }	else	{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        // Kλείσιμο σύνδεσης
        $conn->close();

    } else {

        // μη γράψεις στη βάση αν είναι για διόρθωση ή για άλλη βλάβη

    }

?>