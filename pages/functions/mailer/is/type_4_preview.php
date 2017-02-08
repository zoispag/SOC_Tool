<?php

if ($_REQUEST["type_fault"]!=NULL && $_REQUEST["type_receivers"]!=NULL)
{
    
    // Σύνδεση με τη βάση
    include_once("../connection.php");
    
    function dataToImage($data) {
        return "<img src=".base64ToData($data)." width='100%'/>";
    }

    function base64ToData($base64_string) {
        $data = str_replace('url("','',base64_decode($base64_string));
        $data = str_replace('")','',$data);
        return $data;
    }

    $now = date('H:i');
    $now = date ('H:i', strtotime( '+1 hours', strtotime ($now) ));

    $kalimera = new DateTime();
    $kalimera->setTime(11,59);
    
	$sr = $_REQUEST["txt_sr"];
	$dslam = $_REQUEST["txt_dslam"];
	$ems = $_REQUEST["txt_ems"];
	$comment = $_REQUEST["txt_comment"];
    $date = $_REQUEST["txt_created"];

    $fault = $_REQUEST["type_fault"];
    $receivers = $_REQUEST["type_receivers"];
    
    $img_agama = $_REQUEST["img_agama"];
    $img_str = $_REQUEST["img_str"];
    
    $found_ems = '';
    $sql_ems = "SELECT * FROM faults WHERE element = '".$ems."'";
    $result = $conn->query($sql_ems);
    
    if ($result->num_rows >0) {
        $found_ems .= 'Για το <strong>'.$ems.'</strong> έχουν σταλεί τα εξής mail:<br/>';
        while($row = $result->fetch_assoc()) {
            $found_ems .= date("d-m-Y",strtotime($row["date"])).' <i class="fa fa-arrow-right fa-fw"></i> <strong>'.$row["subject"].'</strong><br/>';
        }
    }
    
    $conn->close();
    
    $_alerts = '';
    
    if ($found_ems!='') {
        $_alerts .= '
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <small>'.$found_ems.'</small>
            </div>
        ';
    }

    $_top = '<table><tr><td style="min-width:45px;">From:</td><td><strong><a >soc_internet_tv, GRC01</a></strong></td></tr>';

	if($receivers=='athina') {
		$_top .= '<tr><td>To:</td><td><strong><a >DL-GRC01-nmc-dataip</a></strong></td></tr>
		<tr><td>CC:</td><td><strong><a >soc_internet_tv, GRC01</a></strong>; <strong><a >Penitas, Christos</a></strong>; <strong><a >Galanakis, Antonios</a></strong>; <strong><a >Chnarakis, Georgios</a></strong>; <strong><a >DL-GRC01-level_2_support</a></strong>; <strong><a >DL-GRC01-soc_tele</a></strong></td></tr></table>
		';
    }
    else if($receivers=='thess'){
		$_top .= '<tr><td>To:</td><td><strong><a >DL-GRC01-ncc-thess-dataip</a></strong></td></tr>
		<tr><td style="vertical-align:top;">CC:</td><td><strong><a >DL-GRC01-nmc-dataip</a></strong>; <strong><a >soc_internet_tv, GRC01</a></strong>; <strong><a >Penitas, Christos</strong>; <strong><a >Galanakis, Antonios</a></strong>; <strong><a >Chnarakis, Georgios</a></strong>; <strong><a >DL-GRC01-level_2_support</a></strong>; <strong><a >DL-GRC01-soc_tele</a></strong></td></tr></table>
		';
    }
    
    if($fault==1) { $fault_f = 'Σπασίματα εικόνας/ήχου'; } else
    if($fault==2) { $fault_f = 'No DHCP answer'; } else
    if($fault==3) { $fault_f = 'Μαύρη εικόνα'; } else
    if($fault==4) { $fault_f = 'Αδυναμία προβολής καναλιού'; } else
    if($fault==5) { $fault_f = 'Πρόβλημα Replay TV'; } else
    if($fault==6) { $fault_f = 'Άλλο'; }
	
	$_top .= '<hr />';

    $_top .= "<strong>ΠΙΘΑΝΟ ΠΡΟΒΛΗΜΑ IPTV στο DSLAM ".$ems." (".$fault_f.")</strong><br />";
	
	$_top .= '<hr />';

    //Δημιουργία λεκτικού.
    if ($now < $kalimera->format('H:i')) { $_prosfonisi='Καλημέρα,'; } else { $_prosfonisi='Καλησπέρα,'; }
    $_date = nl2br(str_replace(' ','&nbsp;',$date));
    $_comment = nl2br(str_replace(' ','&nbsp;',$comment));
    
    if ($fault<4) { $_mainDesc = 'Eμφανίζεται πιθανό πρόβλημα multicast ροής στο D_<strong>'.$dslam.'</strong><br />'; }
    else  { $_mainDesc = 'Eμφανίζεται πιθανό πρόβλημα IPTV στο D_<strong>'.$dslam.'</strong><br />'; }
    $_mainDesc .= 'Εκκρεμούν βλάβες με σύμπτωμα «'.$fault_f.'».<br />';
    $_mainDesc .= 'Σας προωθείται το SR: '.$sr.'<br />';
    $_mainDesc .= 'Ημερομηνία & ώρα έναρξης: '.$date.'';
    $_closure = 'Παρακαλώ για τους ελέγχους σας.';
    
        //Εικόνα
    if($img_str!='bm9uZQ==') {
        $_img = dataToImage($img_str);
    }
    
        //Εικόνα
    if($img_agama!='bm9uZQ==') {
        $_agama = dataToImage($img_agama);
    }

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
    if($img_agama!='bm9uZQ==') {
        $msg .= $_agama.'<br /><br />';
    }
    if($img_str!='bm9uZQ==') {
        $msg .= $_img.'<br /><br />';
    }
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