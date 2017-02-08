<?php

    if (($_REQUEST["txt_sr"]!=NULL && $_REQUEST["txt_element"]!=NULL))
    {
        
        // Σύνδεση με τη βάση
        include_once("../connection.php");

        $now = date('Y-m-d H:i:s', strtotime( '+1 hours', strtotime (date('d-m-Y H:i:s')) ));
        $today = date('Y-m-d');

        // Element type = DSLAM
        $element_type = strtoupper($_REQUEST["txt_type"]);
        // Siebel SR & Element Name
        $sr = $_REQUEST["txt_sr"];
        $element = $_REQUEST["txt_element"];

        //Θέμα
        $_top = "ΠΙΘΑΝΟ ΠΡΟΒΛΗΜΑ ".$element_type." ".$element;
        
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