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
    
    $loopnumber = $_REQUEST["txt_cli"];
	$sr = $_REQUEST["txt_sr"];
	$isp = $_REQUEST["txt_isp"];
	$dslam = $_REQUEST["txt_dslam"];
	$ems = $_REQUEST["txt_ems"];
	$srv = $_REQUEST["txt_srv"];
	$comment = $_REQUEST["txt_comment"];
    $asr = $_REQUEST["txt_asr"];
	$hop = $_REQUEST["txt_hop"];
    $cc_mail = $_REQUEST["cc_mail"];

    $fault = $_REQUEST["type_fault"];
    $receivers = $_REQUEST["type_receivers"];
    $bras = $_REQUEST["txt_bras"];
    
    $found_ems = '';
    $sql_ems = "SELECT * FROM vpu WHERE ems = '".$ems."'";
    $result = $conn->query($sql_ems);
    
    if ($result->num_rows >0) {
        $found_ems .= 'ΠΡΟΣΟΧΗ: Για το <strong>D_'.$dslam.'</strong> έχουν σταλεί mail με θέμα<br />';
        while($row = $result->fetch_assoc()) {
            $found_ems .= '<strong>'.$row["subject"].'</strong> στις <strong>'.date("d-m-Y",strtotime($row["date"])).'</strong><br />';
        }
    }
    
    $found_hop = '';
    $sql_hop = "SELECT * FROM vpu WHERE hop = '".$hop."'";
    $result = $conn->query($sql_hop);
    
    if ($result->num_rows >0) {
        $found_hop .= 'ΠΡΟΣΟΧΗ: Για το element <strong>'.$hop.'</strong> έχουν σταλεί τα εξής mail:<br/>';
        while($row = $result->fetch_assoc()) {
            $found_hop .= date("d-m-Y",strtotime($row["date"])).' <i class="fa fa-arrow-right fa-fw"></i> <strong>'.$row["subject"].'</strong><br/>';
        }
    }
    
    $conn->close();
    
    $_alerts = '';
    
    if ($found_ems!='') {
        $_alerts .= '
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <small>'.$found_ems.'</small>
            </div>
        ';
    }
    
    if ($found_hop!='') {
        $_alerts .= '
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <small>'.$found_hop.'</small>
            </div>
        ';
    }

    $img_str = $_REQUEST["img_str"];

    $_top = '<table><tr><td style="min-width:45px;">From:</td><td><strong><a >soc_internet_tv, GRC01</a></strong></td></tr>';

	if($receivers=='athina') {
		$_top .= '<tr><td>To:</td><td><strong><a >DL-GRC01-Τμήμα Υποστήριξης Δικτύου BNG-BRAS-METRO-ATM Σταθερής</a></strong></td></tr>
		<tr><td>CC:</td><td><strong><a >DL-GRC01-nmc-dataip</a></strong>; <strong><a >soc_internet_tv, GRC01</a></strong>'.($cc_mail ? '; <strong><a >'.$cc_mail.'</a></strong>' : '').'
        </td></tr></table>
		';
    }
    else if($receivers=='thess'){
		$_top .= '<tr><td>To:</td><td><strong><a >DL-GRC01-ncc-thess-dataip</a></strong></td></tr>
		<tr><td>CC:</td><td><strong><a >DL-GRC01-Τμήμα Υποστήριξης Δικτύου BNG-BRAS-METRO-ATM Σταθερής</a></strong>; <strong><a >DL-GRC01-nmc-dataip</a></strong>; <strong><a >soc_internet_tv, GRC01</a></strong>'.($cc_mail ? '; <strong><a >'.$cc_mail.'</a></strong>' : '').'
        </td></tr></table>
		';
    }
    else if($receivers=='planning'){
		$_top .= '<tr><td>To:</td><td><strong><a >Vasilopoulos, Theodoros</a></strong></td></tr>
		<tr><td>CC:</td><td><strong><a >Ploubis, Yannis</a></strong>; <strong><a >soc_internet_tv, GRC01</a></strong>'.($cc_mail ? '; <strong><a >'.$cc_mail.'</a></strong>' : '').'
        </td></tr></table>
		';
    }
    
	$_top .= '<hr />';

    if($isp==0) { $isp_f = ''; } else
    if($isp==1) { $isp_f = 'Cyta'; } else
    if($isp==2) { $isp_f = 'Forthnet'; } else
    if($isp==3) { $isp_f = 'Vodafone'; } else
    if($isp==4) { $isp_f = 'Wind'; }
	
    if($fault=='wrong_display'){
        $_top .= "<strong>Διόρθωση αποτύπωσης στα ΠΣ (".$isp_f.", VPU-C, ".$loopnumber.")</strong><br />";
    } else {
        $_top .= "<strong>XConnect (DSLAM: ".$ems." -- ISP: ".$isp_f.")</strong><br />";
    }
	
	$_top .= '<hr />';

    if($srv==0) { $srv_f = 'SRV1 (ADSL)'; } else
    if($srv==1) { $srv_f = 'SRV2 (30M)'; } else
    if($srv==2) { $srv_f = 'SRV2 (50M)'; } else
    if($srv==3) { $srv_f = '836 (TV)'; } else
    if($srv==4) { $srv_f = '837 (Voice)'; } else
    if($srv==5) { $srv_f = '838 (CPE)'; } else
    if($srv==6) { $srv_f = 'Παραπάνω από ένα'; }

    //Δημιουργία λεκτικού.
    $_contact = '(<strong>Βρόχος:</strong> '.$loopnumber;
    if ($sr != '') { $_contact .= ' <strong>• SR:</strong> '.$sr.')'; } else  { $_contact .= ')';}
    if ($now < $kalimera->format('H:i')) { $_prosfonisi='Καλημέρα,'; } else { $_prosfonisi='Καλησπέρα,'; }
    $_bras = '<table class="table table-bordered" style="font-family: monospace; font-size: 11px; border-collapse:collapse" border="1"><tr><td>'.nl2br(str_replace(' ','&nbsp;',$bras)).'</td></tr></table>';
    $_comment = nl2br(str_replace(' ','&nbsp;',$comment));
	//$_comment = $comment;
    if($fault!='wrong_display')
    {
        $_mainDesc='Υπάρχει δηλωμένη βλάβη ευρυζωνικότητας παρόχου '.$isp_f.' με σύμπτωμα «No IP», όπου κατά τον έλεγχο διαπιστώθηκε ότι ';
        //-- Δε φέρνει αποτέλεσμα.
        if($fault=='no_xconnect')
        {
            $_mainDesc .= 'η εντολή XConnect στο BRAStool <u>δεν φέρνει αποτέλεσμα</u>.<br />';
            if($asr){ $_mainDesc .= 'Πρόκειται για κύκλωμα VPU-C που εξυπηρετείται από τον <strong>'.$asr.'</strong> στο D_<strong>'.$dslam.'</strong>.'; } else { $_mainDesc .= 'Πρόκειται για κύκλωμα VPU-C στο D_<strong>'.$dslam.'</strong>.'; }
            $_closure = 'Παρακαλώ για έλεγχο κατασκευής και παραμετροποίησης του XConnect.';
        
        } else if ($fault=='xconnect_down')
        {
            $_mainDesc .= 'το <u>state του Xconnect είναι down</u>.<br />';
			if($asr){ $_mainDesc .= 'Πρόκειται για κύκλωμα VPU-C που εξυπηρετείται από τον <strong>'.$asr.'</strong> στο D_<strong>'.$dslam.'</strong>.'; } else { $_mainDesc .= 'Πρόκειται για κύκλωμα VPU-C στο D_<strong>'.$dslam.'</strong>.'; }
            $_closure = 'Παρακαλώ για τους ελέγχους σας.';
        } else if ($fault=='xconnect_unresolved')
        {
            $_mainDesc .= 'το <u>state του Xconnect είναι unresolved</u>.<br />';
			if($asr){ $_mainDesc .= 'Πρόκειται για κύκλωμα VPU-C που εξυπηρετείται από τον <strong>'.$asr.'</strong> στο D_<strong>'.$dslam.'</strong>.'; } else { $_mainDesc .= 'Πρόκειται για κύκλωμα VPU-C στο D_<strong>'.$dslam.'</strong>.'; }
            $_closure = 'Παρακαλώ για τους ελέγχους σας.';
        } else if ($fault=='xconnect_traffic')
        {
            $_mainDesc .= 'για το κατασκευασμένο XConnect δεν υπάρχει <u>αμφίδρομη δρομολόγηση μεταξύ τερματικού εξοπλισμού ΟΤΕ και παρόχου</u>.<br />';
			if($asr){ $_mainDesc .= 'Πρόκειται για κύκλωμα VPU-C που εξυπηρετείται από τον <strong>'.$asr.'</strong> στο D_<strong>'.$dslam.'</strong>.'; } else { $_mainDesc .= 'Πρόκειται για κύκλωμα VPU-C στο D_<strong>'.$dslam.'</strong>.'; }
            $_closure = 'Παρακαλώ για τους απαραίτητους ελέγχους δρομολόγησης και παραμετροποίησης.';
        } else if ($fault=='xconnect_mismatch')
        {
            $_mainDesc .= 'υπάρχει <u>mismatch</u> στα S-VLAN μεταξύ των αποτυπωμένων στοιχείων στα Π.Σ. και του κατασκευασμένου XConnect.<br />';
			if($asr){ $_mainDesc .= 'Πρόκειται για κύκλωμα VPU-C που εξυπηρετείται από τον <strong>'.$asr.'</strong> στο D_<strong>'.$dslam.'</strong>.'; } else { $_mainDesc .= 'Πρόκειται για κύκλωμα VPU-C στο D_<strong>'.$dslam.'</strong>.'; }
            $_closure = 'Παρακαλώ για την ενημέρωση μας ως προς το σωστό SVLAN.';
        } else if ($fault=='xconnect_wrong')
        {
            $_mainDesc = 'Υπάρχει δηλωμένη βλάβη ευρυζωνικότητας παρόχου '.$isp_f.' με σύμπτωμα «No IP», όπου κατά τον έλεγχο διαπιστώθηκε λανθασμένη παραμετροποίηση του XConnect.<br />';
			if($asr){ $_mainDesc .= 'Πρόκειται για κύκλωμα VPU-C που εξυπηρετείται από τον <strong>'.$asr.'</strong> στο D_<strong>'.$dslam.'</strong>.'; } else { $_mainDesc .= 'Πρόκειται για κύκλωμα VPU-C στο D_<strong>'.$dslam.'</strong>.'; }
            $_closure = 'Παρακαλώ για τις ενέργειές σας.';
        } else if ($fault=='xconnect_unidentified')
        {
            $_mainDesc = 'Υπάρχει δηλωμένη βλάβη ευρυζωνικότητας παρόχου '.$isp_f.' με σύμπτωμα «No IP», όπου δεν έχουμε τη δυνατότητα να επιβεβαιώσουμε αν η παραμετροποιήση μέχρι και το τελευταίο σημείο ευθύνης OTE είναι ορθή.<br />
        Πρόκειται για κύκλωμα VPU-C στο D_<strong>'.$dslam.'</strong>.';
            $_closure = 'Παρακαλώ για τους ελέγχους σας.';
        } else if ($fault=='xconnect_other')
        {
            $_mainDesc = 'Υπάρχει δηλωμένη βλάβη ευρυζωνικότητας παρόχου '.$isp_f.' στο D_<strong>'.$dslam.'</strong>.';
            $_closure = 'Παρακαλώ για τους ελέγχους σας.';
        }
    } else {
        $_mainDesc = 'Παρακαλώ για την αποτύπωση της σωστής πληροφορίας στα Π.Σ. για το '.$loopnumber;
        $_closure = '';
    }

    //Info
    $_info = '
        <table class="table" style="font-size: 13px; font-family:\'Verdana\'; max-width:300px;">
            <tr><th style="text-align:center" colspan="3"><strong><u>Info</u></strong></th></tr>
            <tr><td style="text-align:right"><strong>DSLAM</strong></td><td>&nbsp;</td><td>'.$dslam.'</td></tr>';
    if ($hop != '') { $_info .= '
            <tr><td style="text-align:right"><strong>ΟΚΣΥΑ 1<sup>st</sup>hop</strong></td><td>&nbsp;</td><td>'.$hop.'</td></tr>'; }
    $_info .= '
            <tr><td style="text-align:right"><strong>Πάροχος</strong></td><td>&nbsp;</td><td>'.$isp_f.'</td></tr>
            <tr><td style="text-align:right"><strong>Service</strong></td><td>&nbsp;</td><td>'.$srv_f.'</td></tr>
        </table>';

    //Εικόνα
    if($img_str!='bm9uZQ==') {
        $_img = dataToImage($img_str);
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
    if($fault!='wrong_display'){if($loopnumber) {$msg .= $_contact.'<br /><br />';}}
    $msg .= $_info.'<br />';
    if($img_str!='bm9uZQ==') {
        $msg .= $_img.'<br /><br />';
    }
    if($bras) {$msg .= $_bras.'<br />';}
    if($_comment) {$msg .= '<table class="table" style="font-size: 13px; font-family:\'Verdana\';"><tr><td style="vertical-align:top;"><strong>Σχόλια:</strong></td><td><i>'.$_comment.'</i></td></tr></table><br />';}
    if($_closure) {$msg .= $_closure.'<br /><br />';}
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