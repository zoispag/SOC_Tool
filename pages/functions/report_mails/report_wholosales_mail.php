<?php
    
    $wsi = $_GET["wsi"];

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
    $mail->addAddress('zpagoylat@ote.gr', 'Pagoylatos, Zois');
    $mail->addAddress('ikampaxis@ote.gr', 'Kampaxis, Iraklis');
    $mail->addCC('smix@ote.gr', 'Michopoulos, Sotirios');
    $mail->addCC('gpapadiotis@ote.gr', 'Papadiotis, Georgios');
    $mail->addCC('lxylaggour@ote.gr', 'Xylaggouras, Lefteris');

    $mail->isHTML(true);
    $mail->Subject = "Daily Wholesales Faults Report ".$date;

    $msg = 'Καλησπέρα, <br /><br />';
    $msg.= 'Σήμερα '.$date.', δηλώθηκαν <strong>'.$wsi.'</strong> βλάβες παρόχων.';
    $msg.= '<br /><br />Ευχαριστώ.';

    $mail->Body    = $msg;
        $mail->send();

?>