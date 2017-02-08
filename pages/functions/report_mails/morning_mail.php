<?php
    
    $isb = $_GET["isb"];
    $isi = $_GET["isi"];
    $socInternetBack = $_GET["socInternetBack"];
    $socInternetIn = $_GET["socInternetIn"];
    $tvb = $_GET["tvb"];
    $tvi = $_GET["tvi"];
    $wsb = $_GET["wsb"];
    $wsi = $_GET["wsi"];
    $vob = $_GET["vob"];
    $voi = $_GET["voi"];
    $socTeleBack = $_GET["socTeleBack"];
    $socTeleIn = $_GET["socTeleIn"];
    $teb = $_GET["teb"];
    $tei = $_GET["tei"];

    //Mail Function
    require '../../phpmailer/PHPMailerAutoload.php';

    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date('d/m/Y G:i', strtotime( '1 hour', strtotime (date('d-m-Y G:i')) ));

    $mail = new PHPMailer;

    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';
    $mail->Host = "otesmtp";
    $mail->Port = 25;

    $mail->setFrom('soc_internet_tv@ote.gr', 'soc_internet_tv, GRC01');
    $mail->addAddress('soc_internet_tv@ote.gr', 'soc_internet_tv, GRC01');
    $mail->isHTML(true);
    $mail->Subject = "SOC STATISTICS ".$date;

    $msg = 'Καλημέρα, <br /><br />';
    $msg.= '<div class="col-lg-offset-3 col-lg-6 text-center">
                <style>
                    table { border-collapse: collapse; }
                    table, th, td { border: solid #ccc 1px; }
                    .red { color: darkred; }
                </style>
                <table style="font-size:18px; color:#2f4f4f; font-family: Verdana;">
                    <tr>
                        <td></td>
                        <th>Backlog</td>
                        <th>L1->L2</td>
                        <th>Total</td>
                    </tr>
                    <tr>
                        <th>Internet</th>
                            <td>'.$isb.'</td>
                            <td>'.$isi.'</td>
                            <td rowspan="3"><b>Backlog: </b>'.$socInternetBack.'<br><b>L1-> L2: </b>'.$socInternetIn.'</td>
                        </tr>
                        <tr>
                            <th>IPTV</th>
                            <td>'.$tvb.'</td>
                            <td>'.$tvi.'</td>
                        </tr>
                        <tr>
                            <th>Wholesales</th>
                            <td>'.$wsb.'</td>
                            <td>'.$wsi.'</td>
                        </tr>
                        <tr>
                            <th>VoBB</th>
                            <td>'.$vob.'</td>
                            <td>'.$voi.'</td>
                            <td rowspan="2"><b>Backlog: </b>'.$socTeleBack.'<br><b>L1-> L2: </b>'.$socTeleIn.'</td>
                        </tr>
                        <tr>
                            <th>Telephony</th>
                            <td>'.$teb.'</td>
                            <td>'.$tei.'</td>
                        </tr>
                    </table>
                </div>
            <br />Ευχαριστώ.';

    $mail->Body    = $msg;
    $mail->send();

?>