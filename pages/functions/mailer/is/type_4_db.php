<?php

    if (($_REQUEST["txt_sr"]!=NULL && $_REQUEST["txt_element"]!=NULL))
    {
        
        // Σύνδεση με τη βάση
        include_once("../connection.php");

        $now = date('Y-m-d H:i:s', strtotime( '+1 hours', strtotime (date('d-m-Y H:i:s')) ));
        $today = date('Y-m-d');

        // Element type = DSLAM
        $element_type = "IPTV";
        // Siebel SR & Element Name
        $sr = $_REQUEST["txt_sr"];
        $element = $_REQUEST["txt_element"];
        $fault = $_REQUEST["type_fault"];
        
        if($fault==1) { $fault_f = 'Σπασίματα εικόνας/ήχου'; } else
        if($fault==2) { $fault_f = 'No DHCP answer'; } else
        if($fault==3) { $fault_f = 'Μαύρη εικόνα'; } else
        if($fault==4) { $fault_f = 'Αδυναμία προβολής καναλιού'; } else
        if($fault==5) { $fault_f = 'Πρόβλημα Replay TV'; } else
        if($fault==6) { $fault_f = 'Άλλο'; }

        //Θέμα
        $_top = "ΠΙΘΑΝΟ ΠΡΟΒΛΗΜΑ IPTV στο DSLAM ".$element." (".$fault_f.")";
        
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