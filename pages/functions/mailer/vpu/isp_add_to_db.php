<?php

    if (($_REQUEST["txt_sub"]!=NULL) && ($_REQUEST["txt_ems"]!=NULL) && ($_REQUEST["txt_hop"]!=NULL) && ($_REQUEST["txt_isp"]!=NULL) && ($_REQUEST["txt_sr"]!=NULL) && ($_REQUEST["type_fault"]!=NULL))
    {
        
        // Σύνδεση με τη βάση
        include_once("../connection.php");

        //$now = date('Y-m-d H:i:s', strtotime( '+1 hours', strtotime (date('d-m-Y H:i:s')) ));
        //$today = date('Y-m-d');

        // Θέμα, Siebel SR, Full EMS Name & πληροφορία BRAS του Siebel
        $date = $_REQUEST["txt_date"];
		$_top = $_REQUEST["txt_sub"];
        $ems = $_REQUEST["txt_ems"];
        $hop = $_REQUEST["txt_hop"];
		$isp_f = $_REQUEST["txt_isp"];
        $sr = $_REQUEST["txt_sr"];
		$_fault = $_REQUEST["type_fault"];
        
        // Δημιουργία SQL Query string
        $sql= "
            INSERT INTO vpu
            ( date, subject, ems, hop, isp, sr, fault )
            VALUES
            ( '".$date."','".$_top."','".$ems."','".$hop."','".$isp_f."','".$sr."','".$_fault."' ) 
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