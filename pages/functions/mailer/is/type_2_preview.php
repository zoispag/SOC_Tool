<?php

if ($_REQUEST["type_fault"]!=NULL && $_REQUEST["type_receivers"]!=NULL)
{
    
    // Σύνδεση με τη βάση
    include_once("../connection.php");

    $now = date('H:i');
    $now = date ('H:i', strtotime( '+1 hours', strtotime ($now) ));

    $kalimera = new DateTime();
    $kalimera->setTime(11,59);
    
	$sr = $_REQUEST["txt_sr"];
	$bras_type = strtoupper($_REQUEST["txt_type"]);
	$bras = $_REQUEST["txt_bras"];
	$comment = $_REQUEST["txt_comment"];
    $date = $_REQUEST["txt_created"];
    $more_than_one = $_REQUEST["txt_more_than_one"];

    $fault = $_REQUEST["type_fault"];
    $receivers = $_REQUEST["type_receivers"];
    
    $found_bras = '';
    $sql_bras = "SELECT * FROM faults WHERE element = '".$bras."'";
    $result = $conn->query($sql_bras);
    
    if ($result->num_rows >0) {
        $found_bras .= 'Για το '.$bras_type.' <strong>'.$bras.'</strong> έχουν σταλεί τα εξής mail:<br/>';
        while($row = $result->fetch_assoc()) {
            $found_bras .= date("d-m-Y",strtotime($row["date"])).' <i class="fa fa-arrow-right fa-fw"></i> <strong>'.$row["subject"].'</strong><br/>';
        }
    }
    
    $conn->close();
    
    $_alerts = '';
    
    if ($found_bras!='') {
        $_alerts .= '
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <small>'.$found_bras.'</small>
            </div>
        ';
    }

    $_top = '<table><tr><td style="min-width:45px;">From:</td><td><strong><a >soc_internet_tv, GRC01</a></strong></td></tr>';

	if($receivers=='athina') {
		$_top .= '<tr><td>To:</td><td><strong><a >DL-GRC01-nmc-dataip</a></strong></td></tr>
		<tr><td>CC:</td><td><strong><a >DL-GRC01-Τμήμα Υποστήριξης Δικτύου BNG-BRAS-METRO-ATM Σταθερής</a></strong>; <strong><a >soc_internet_tv, GRC01</a></strong>; <strong><a >Penitas, Christos</a></strong>; <strong><a >Galanakis, Antonios</a></strong>; <strong><a >Chnarakis, Georgios</a></strong>; <strong><a >DL-GRC01-level_2_support</a></strong>; <strong><a >DL-GRC01-soc_tele</a></strong></td></tr></table>
		';
    }
    else if($receivers=='thess'){
		$_top .= '<tr><td>To:</td><td><strong><a >DL-GRC01-ncc-thess-dataip</a></strong></td></tr>
		<tr><td style="vertical-align:top;">CC:</td><td><strong><a >DL-GRC01-nmc-dataip</a></strong>; <strong><a >DL-GRC01-Τμήμα Υποστήριξης Δικτύου BNG-BRAS-METRO-ATM Σταθερής</a></strong>; <strong><a >soc_internet_tv, GRC01</a></strong>; <strong><a >Penitas, Christos</strong>; <strong><a >Galanakis, Antonios</a></strong>; <strong><a >Chnarakis, Georgios</a></strong>; <strong><a >DL-GRC01-level_2_support</a></strong>; <strong><a >DL-GRC01-soc_tele</a></strong></td></tr></table>
		';
    }
	
	$_top .= '<hr />';

    $_top .= "<strong>ΠΙΘΑΝΟ ΠΡΟΒΛΗΜΑ ".$bras_type." ".$bras."</strong><br />";
	
	$_top .= '<hr />';

    if($fault==1) { $fault_f = 'Συγχρονίζει αλλά δεν παίρνει IP'; } else
    if($fault==2) { $fault_f = 'Αδυναμία Εμφάνισης Σελίδων'; } else
    if($fault==3) { $fault_f = 'Χαμηλές ταχύτητες'; } else
    if($fault==4) { $fault_f = 'Μαύρη εικόνα'; } else
    if($fault==5) { $fault_f = 'Νο DCHP answer'; } else
    if($fault==6) { $fault_f = 'Σπασίματα εικόνας/ήχου'; }

    //Δημιουργία λεκτικού.
    if ($now < $kalimera->format('H:i')) { $_prosfonisi='Καλημέρα,'; } else { $_prosfonisi='Καλησπέρα,'; }
    $_date = nl2br(str_replace(' ','&nbsp;',$date));
    $_comment = nl2br(str_replace(' ','&nbsp;',$comment));
    
    $_mainDesc = 'Eμφανίζεται πιθανό πρόβλημα στον '.$bras_type.' <strong>'.$bras.'</strong><br />';
    if ($more_than_one) {$_mainDesc .= 'Εκκρεμούν βλάβες με σύμπτωμα «'.$fault_f.'».<br />';}
    else {$_mainDesc .= 'Εκκρεμεί 1 βλάβη με σύμπτωμα «'.$fault_f.'».<br />';}
    $_mainDesc .= 'Σας προωθείται το SR: '.$sr.'<br />';
    $_mainDesc .= 'Ημερομηνία & ώρα έναρξης: '.$date.'';
    $_closure = 'Παρακαλώ για τους ελέγχους σας.';

    //Υπογραφή.
    $_footer = '
    <small style="font-family:Tahoma;color:grey;"><small><small><i>(αυτοματοποιημένο email μέσω SOC Tools)</i></small><br />
    <br />
    -- <br />
    <br />
    <strong>Τμήμα Υποστήριξης & Διαχείρισης Υπηρεσιών Ιnternet & TV Σταθερής</strong><br />
    Υποδιεύθυνση Υποστήριξης & Διαχείρισης Υπηρεσιών Οικιακών Πελατών Σταθερής & Κινητής<br />
    Διεύθυνση Διαχείρισης Δικτύου & Υπηρεσιών Σταθερής & Κινητής<br />
    email: <a href="mailto:soc_internet_tv@ote.gr">soc_internet_tv@ote.gr</a><br />
    Telephone: 2106333870<br /></small></small>
    ';

    //Δημιουργία κυρίως κειμένου.
    $msg = $_alerts;
	$msg .= $_top;
    $msg .= '<span style="font-size: 13px; font-family:\'Verdana\';">';
    $msg .= $_prosfonisi.'<br /><br />';
    $msg .= $_mainDesc.'<br /><br />';
    if($_comment) {$msg .= '<table class="table" style="font-size: 13px; font-family:\'Verdana\';"><tr><td style="vertical-align:top;"><strong>Σχόλια:</strong></td><td><i>'.$_comment.'</i></td></tr></table><br />';}
    $msg .= $_closure.'<br /><br />';
    $msg .= 'Ευχαριστώ.<br /><br /></span>';
    $msg .= $_footer;
	
	echo '<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>';	

    echo $msg;

} else {
echo '
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<small><strong>Δεν έχουν συμπληρωθεί τα απαραίτητα πεδία για να δημιουργηθεί προεπισκόπηση.</strong></small>
	</div>
	';
}

?>