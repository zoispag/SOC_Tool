<?php
    
    $tvi = $_GET["tvi"];

    //Mail Function
    require '../../phpmailer/PHPMailerAutoload.php';

    $date = date('d/m/Y', strtotime( '1 hour', strtotime (date('d-m-Y')) ));

    $mail = new PHPMailer;

    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';
    $mail->Host = "otesmtp";
    $mail->Port = 25;

    $mail->setFrom('statistics@ote.gr', 'Statistics Reporter');
    $mail->addAddress('gmoschonis@ote.gr', 'Moschonisios, Georgios');
    $mail->addAddress('zpagoylat@ote.gr', 'Pagoylatos, Zois');

    $mail->isHTML(true);
    $mail->Subject = "Daily TV Faults Report ".$date;

    $msg = 'Καλησπέρα, <br /><br />';
    $msg.= 'Σήμερα '.$date.', δηλώθηκαν <strong>'.$tvi.'</strong> βλάβες IPTV.';
    $msg.= '<br /><br />Ευχαριστώ.';

    $mail->Body    = $msg;
    $mail->send();

?>