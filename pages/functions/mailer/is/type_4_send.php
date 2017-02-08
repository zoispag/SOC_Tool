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
    
	$sr = $_REQUEST["txt_sr"];
	$dslam = $_REQUEST["txt_dslam"];
	$ems = $_REQUEST["txt_ems"];
	$comment = $_REQUEST["txt_comment"];
    $date = $_REQUEST["txt_created"];

    $fault = $_REQUEST["type_fault"];
    $receivers = $_REQUEST["type_receivers"];
    
    $img_agama = $_REQUEST["img_agama"];
    $img_str = $_REQUEST["img_str"];

    require '../../../phpmailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;

    $mail->isSMTP();
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
    
    $mail->isHTML(true);
    
    if($fault==1) { $fault_f = 'Σπασίματα εικόνας/ήχου'; } else
    if($fault==2) { $fault_f = 'No DHCP answer'; } else
    if($fault==3) { $fault_f = 'Μαύρη εικόνα'; } else
    if($fault==4) { $fault_f = 'Αδυναμία προβολής καναλιού'; } else
    if($fault==5) { $fault_f = 'Πρόβλημα Replay TV'; } else
    if($fault==6) { $fault_f = 'Άλλο'; }
    
    $_top = "ΠΙΘΑΝΟ ΠΡΟΒΛΗΜΑ IPTV στο DSLAM ".$ems." (".$fault_f.")";

    //Δημιουργία θέματος.
    $mail->Subject = $_top;

    //Δημιουργία λεκτικού.
    if ($now < $kalimera->format('H:i')) { $_prosfonisi='Καλημέρα,'; } else { $_prosfonisi='Καλησπέρα,'; }
    $_date = nl2br(str_replace(' ','&nbsp;',$date));
    $_comment = nl2br(str_replace(' ','&nbsp;',$comment));
    
    $_mainDesc = 'Eμφανίζεται πιθανό πρόβλημα multicast ροής στο D_<strong>'.$dslam.'</strong><br />';
    $_mainDesc .= 'Εκκρεμούν βλάβες με σύμπτωμα «'.$fault_f.'».<br />';
    $_mainDesc .= 'Σας προωθείται το SR: '.$sr.'<br />';
    $_mainDesc .= 'Ημερομηνία & ώρα έναρξης: '.$date.'';
    $_closure = 'Παρακαλώ για τους ελέγχους σας.';
    
    //Εικόνα
    if($img_agama!='bm9uZQ==') {
		$_path = 'c:/xampp/htdocs/'.str_replace('type_4_send.php','',$_SERVER['PHP_SELF']);
		$_fname = $_path.'/!attachments/'.uniqid().'.png';
		file_put_contents($_fname, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', base64ToData($img_agama))));
		$mail->AddEmbeddedImage($_fname, 'attach_1');
    }
    
    //Εικόνα
    if($img_str!='bm9uZQ==') {
		$_path = 'c:/xampp/htdocs/'.str_replace('type_4_send.php','',$_SERVER['PHP_SELF']);
		$_fname2 = $_path.'/!attachments/'.uniqid().'.png';
		file_put_contents($_fname2, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', base64ToData($img_str))));
		$mail->AddEmbeddedImage($_fname2, 'attach_2');
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
    if($_comment) {$msg .= '<table class="table" style="font-size: 13px; font-family:\'Verdana\';"><tr><td style="vertical-align:top;"><strong>Σχόλια:</strong></td><td><i>'.$_comment.'</i></td></tr></table><br />';}
    if($img_agama!='bm9uZQ==') {
		$msg .= '<img style="max-width:600px;" src=\'cid:attach_1\'\/><br /><br />';
    }
    if($img_str!='bm9uZQ==') {
		$msg .= '<img style="max-width:600px;" src=\'cid:attach_2\'\/><br /><br />';
    }
    $msg .= $_closure.'<br /><br />';
    $msg .= 'Ευχαριστώ.<br /><br /></span>';
    $msg .= $_footer;
    
    $mail->Body = $msg;
    $mail->send();
    
    if($img_agama!='bm9uZQ==') {
	   unlink($_fname);
    }
    
    if($img_str!='bm9uZQ==') {
	   unlink($_fname2);
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