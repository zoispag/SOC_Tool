<?php

if ($_REQUEST["type_fault"]!=NULL && $_REQUEST["type_receivers"]!=NULL)
{
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

    //header("Content-type: image/png");
    $img_str = $_REQUEST["img_str"];

    require '../../../phpmailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;

    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';
    $mail->Host = "otesmtp";
    $mail->Port = 25;

    $mail->setFrom('soc_internet_tv@ote.gr', 'soc_internet_tv, GRC01');

    //Επιλογή παραληπτών.
    if($receivers=='athina') {
        $mail->addAddress('bras-metro@ote.gr', 'DL-GRC01-Τμήμα Υποστήριξης Δικτύου BNG-BRAS-METRO-ATM Σταθερής');
        $mail->addCC('nmc-dataip@ote.gr', 'DL-GRC01-nmc-dataip');
        $mail->addCC('soc_internet_tv@ote.gr', 'soc_internet_tv, GRC01');
    }
    else if($receivers=='thess'){
        $mail->addAddress('ncc-thess-dataip@ote.gr', 'DL-GRC01-ncc-thess-dataip');
        $mail->addCC('bras-metro@ote.gr', 'DL-GRC01-Τμήμα Υποστήριξης Δικτύου BNG-BRAS-METRO-ATM Σταθερής');
        $mail->addCC('nmc-dataip@ote.gr', 'DL-GRC01-nmc-dataip');
        $mail->addCC('soc_internet_tv@ote.gr', 'soc_internet_tv, GRC01');
    }
    else if($receivers=='planning'){
        $mail->addAddress('tvasilopo@ote.gr', 'Vasilopoulos, Theodoros');
        $mail->addCC('johplo2@ote.gr', 'Ploubis, Yannis');
        $mail->addCC('soc_internet_tv@ote.gr', 'soc_internet_tv, GRC01');
    }
    if($cc_mail) { $mail->addCC($cc_mail); }

    if($isp==0) { $isp_f = ''; } else
    if($isp==1) { $isp_f = 'Cyta'; } else
    if($isp==2) { $isp_f = 'Forthnet'; } else
    if($isp==3) { $isp_f = 'Vodafone'; } else
    if($isp==4) { $isp_f = 'Wind'; }

    if($srv==0) { $srv_f = 'SRV1 (ADSL)'; } else
    if($srv==1) { $srv_f = 'SRV2 (30M)'; } else
    if($srv==2) { $srv_f = 'SRV2 (50M)'; } else
    if($srv==3) { $srv_f = '836 (TV)'; } else
    if($srv==4) { $srv_f = '837 (Voice)'; } else
    if($srv==5) { $srv_f = '838 (CPE)'; } else
    if($srv==6) { $srv_f = 'Παραπάνω από ένα'; }

    $mail->isHTML(true);

    //Δημιουργία θέματος.
    if($fault=='wrong_display'){
		$_top = "Διόρθωση αποτύπωσης στα ΠΣ (".$isp_f.", VPU-C, ".$loopnumber.")";
        $mail->Subject = "Διόρθωση αποτύπωσης στα ΠΣ (".$isp_f.", VPU-C, ".$loopnumber.")";
    } else {
		$_top = "XConnect (DSLAM: ".$ems." -- ISP: ".$isp_f.")";
        $mail->Subject = "XConnect (DSLAM: ".$ems." -- ISP: ".$isp_f.")";
    }

    //Δημιουργία λεκτικού.
    $_contact = '(<strong>Βρόχος:</strong> '.$loopnumber;
    if ($sr != '') { $_contact .= ' <strong>• SR:</strong> '.$sr.')'; } else  { $_contact .= ')';}
    if ($now < $kalimera->format('H:i')) { $_prosfonisi='Καλημέρα,'; } else { $_prosfonisi='Καλησπέρα,'; }
    $_bras = '<table class="table table-bordered" style="font-family: monospace; font-size: 11px; border-collapse:collapse" border="1"><tr><td>'.nl2br(str_replace(' ','&nbsp;',$bras)).'</td></tr></table>';
    $_comment = nl2br(str_replace(' ','&nbsp;',$comment));
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
        <table class="table" style="font-size: 13px; font-family:\'Verdana\';">
            <tr><th colspan="3"><strong><u>Info</u></strong></th></tr>
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
		$_path = 'c:/xampp/htdocs/'.str_replace('isp_escalate_mail.php','',$_SERVER['PHP_SELF']);
		$_fname = $_path.'/!attachments/'.uniqid().'.png';
		file_put_contents($_fname, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', base64ToData($img_str))));
		$mail->AddEmbeddedImage($_fname, 'attach_1');
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
    $msg = '<span style="font-size: 13px; font-family:\'Verdana\';">';
    $msg .= $_prosfonisi.'<br /><br />';
    $msg .= $_mainDesc.'<br /><br />';
    if($fault!='wrong_display'){if($loopnumber) {$msg .= $_contact.'<br /><br />';}}
    $msg .= $_info.'<br />';
    if($img_str!='bm9uZQ==') {
		$msg .= '<img style="max-width:300px;" src=\'cid:attach_1\'\/><br /><br />';
    }
    if($bras) {$msg .= $_bras.'<br />';}
    if($_comment) {$msg .= '<table class="table" style="font-size: 13px; font-family:\'Verdana\';"><tr><td style="vertical-align:top;"><strong>Σχόλια:</strong></td><td><i>'.$_comment.'</i></td></tr></table><br />';}
    if($_closure) {$msg .= $_closure.'<br /><br />';}
    $msg .= 'Ευχαριστώ.<br /><br /></span>';
    $msg .= $_footer;
    
    $mail->Body = $msg;
    $mail->send();
	
    if($img_str!='bm9uZQ==') {
	   unlink($_fname);
    }
	
	echo '<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>';	

    //echo $msg;
	echo '
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<small>Απεστάλη επιτυχώς email με θέμα<br /><small><strong>'.$_top.'</strong>.</small></small>
	</div>
	';

} else {
echo '
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		Συμπληρώστε τα απαραίτητα πεδία και δοκιμάστε ξανά.
	</div>
	';
}

?>