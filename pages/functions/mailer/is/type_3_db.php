<?php

    if (($_REQUEST["txt_sr"]!=NULL && $_REQUEST["txt_element"]!=NULL))
    {
        
        // Σύνδεση με τη βάση
        include_once("../connection.php");

        $now = date('Y-m-d H:i:s', strtotime( '+1 hours', strtotime (date('d-m-Y H:i:s')) ));
        $today = date('Y-m-d');

        // Element type = DSLAM
        $element_type = "CARD";
        // Siebel SR & Element Name
        $sr = $_REQUEST["txt_sr"];
        $ems = $_REQUEST["txt_element"];
        $slot = $_REQUEST["txt_slot"];
        
        $element = $ems.' (SLOT '.$slot.')';

        //Θέμα
        $_top = "ΠΙΘΑΝΟ ΠΡΟΒΛΗΜΑ DSLAM ".$element;
        
        // Δημιουργία SQL Query string
        $sql= "
            INSERT INTO faults
            ( date, elm_type, subject, element, sr )
            VALUES
            ( '".$today."','".$element_type."','".$_top."','".$element."','".$sr."' ) 
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