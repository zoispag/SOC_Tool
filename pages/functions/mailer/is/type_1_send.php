<?php

if ($_REQUEST["type_fault"]!=NULL && $_REQUEST["type_receivers"]!=NULL)
{

    $now = date('H:i');
    $now = date ('H:i', strtotime( '+1 hours', strtotime ($now) ));

    $kalimera = new DateTime();
    $kalimera->setTime(11,59);
    
	$sr = $_REQUEST["txt_sr"];
	$dslam = $_REQUEST["txt_dslam"];
	$ems = $_REQUEST["txt_ems"];
	$comment = $_REQUEST["txt_comment"];
    $date = $_REQUEST["txt_created"];
    $more_than_one = $_REQUEST["txt_more_than_one"];

    $fault = $_REQUEST["type_fault"];
    $receivers = $_REQUEST["type_receivers"];

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
        $mail->addAddress('zpagoylat@ote.gr', 'Pagoylatos, Zois');
        /*$mail->addAddress('nmc-dataip@ote.gr', 'DL-GRC01-nmc-dataip');
        $mail->addCC('soc_internet_tv@ote.gr', 'soc_internet_tv, GRC01');
        $mail->addCC('soc_tele@ote.gr', 'DL-GRC01-soc_tele');
        $mail->addCC('level_2_support@ote.gr', 'DL-GRC01-level_2_support');
        $mail->addCC('cpenitas@ote.gr', 'Penitas, Christos');
        $mail->addCC('agalanakis@ote.gr', 'Galanakis, Antonios');
        $mail->addCC('gchnarakis@ote.gr', 'Chnarakis, Georgios');*/
    }
    else if($receivers=='thess'){
        $mail->addAddress('zpagoylat@ote.gr', 'Pagoylatos, Zois');
        /*$mail->addAddress('ncc-thess-dataip@ote.gr', 'DL-GRC01-ncc-thess-dataip');
        $mail->addCC('nmc-dataip@ote.gr', 'DL-GRC01-nmc-dataip');
        $mail->addCC('soc_internet_tv@ote.gr', 'soc_internet_tv, GRC01');
        $mail->addCC('soc_tele@ote.gr', 'DL-GRC01-soc_tele');
        $mail->addCC('level_2_support@ote.gr', 'DL-GRC01-level_2_support');
        $mail->addCC('cpenitas@ote.gr', 'Penitas, Christos');
        $mail->addCC('agalanakis@ote.gr', 'Galanakis, Antonios');
        $mail->addCC('gchnarakis@ote.gr', 'Chnarakis, Georgios');*/
    }
    
    $_top = "ΠΙΘΑΝΟ ΠΡΟΒΛΗΜΑ DSLAM ".$ems;

    if($fault==1) { $fault_f = 'Modem δε συγχρονίζει'; } else
    if($fault==2) { $fault_f = 'Συγχρονίζει αλλά δεν παίρνει IP'; } else
    if($fault==3) { $fault_f = 'Συχνές αποσυνδέσεις'; }
    $mail->isHTML(true);

    //Δημιουργία θέματος.
    $mail->Subject = $_top;

    //Δημιουργία λεκτικού.
    if ($now < $kalimera->format('H:i')) { $_prosfonisi='Καλημέρα,'; } else { $_prosfonisi='Καλησπέρα,'; }
    $_date = nl2br(str_replace(' ','&nbsp;',$date));
    $_comment = nl2br(str_replace(' ','&nbsp;',$comment));
    
    $_mainDesc = 'Eμφανίζεται πιθανό πρόβλημα στο D_'.$dslam.'<br />';
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
    $msg = '<span style="font-size: 13px; font-family:\'Verdana\';">';
    $msg .= $_prosfonisi.'<br /><br />';
    $msg .= $_mainDesc.'<br /><br />';
    if($_comment) {$msg .= '<table class="table" style="font-size: 13px; font-family:\'Verdana\';"><tr><td style="vertical-align:top;"><strong>Σχόλια:</strong></td><td><i>'.$_comment.'</i></td></tr></table><br />';}
    $msg .= $_closure.'<br /><br />';
    $msg .= 'Ευχαριστώ.<br /><br /></span>';
    $msg .= $_footer;
    
    $mail->Body = $msg;
    $mail->send();
	
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