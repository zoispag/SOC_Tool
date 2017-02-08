<?php
    
    $isi = $_GET["isi"];
	$isp = $_GET["isp"];
	$isb = $_GET["isb"];
	
    $voi = $_GET["voi"];
	$vop = $_GET["vop"];
	$vob = $_GET["vob"];
	
    $tei = $_GET["tei"];
	$tep = $_GET["tep"];
	$teb = $_GET["teb"];

    //Mail Function
    require '../../phpmailer/PHPMailerAutoload.php';

    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date('d/m/Y G:i', strtotime( '1 hour', strtotime (date('d-m-Y G:i')) ));

    $system = date('d-m-Y G:i:s');
    $system = date ('d/m/Y G:i:s', strtotime( '+1 hours', strtotime ($system) ));

    $mail = new PHPMailer;

    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';
    $mail->Host = "otesmtp";
    $mail->Port = 25;

    $mail->setFrom('soc_internet_tv@ote.gr', 'soc_internet_tv, GRC01');
    $mail->addAddress('smix@ote.gr', 'Michopoulos, Sotirios');
    $mail->addCC('gpapadiotis@ote.gr', 'Papadiotis, Georgios');
    $mail->addCC('lxylaggour@ote.gr', 'Xylaggouras, Lefteris');
    $mail->addCC('zpagoylat@ote.gr', 'Pagoylatos, Zois');
    $mail->isHTML(true);
    $mail->Subject = "Realtime Ticketing Statistics ".$date;

    $msg = 'Η κατάσταση βλαβών έχει ως εξής: <br /><br />';
    $msg.= '<div>
                <style>
                    table { border-collapse: collapse; }
                    table, th, td { border: solid #ccc 1px; }
					.is { color: darkblue; }
					.vobb { color: darkmagenta; }
					.tdm { color: darkgreen; }
                </style>
                <table class="table table-bordered table-striped table-hover" style="font-size:17px; color:#000; font-weight: bold;  font-family: Verdana; text-align:center;">
					<tr>
						<td colspan="4">Realtime Ticketing Statistics ('.$system.')</td>
                    </tr>
					<tr>
						<td></td>
						<td>In</td>
						<td>Processed</td>
						<td>BackLog</td>
					</tr>
					<tr class="is">
						<td>IS/TV</td>
						<td>'.$isi.'</td>
						<td>'.$isp.'</td>
						<td>'.$isb.'</td>
					</tr>
					<tr class="vobb">
						<td>VoBB</td>
						<td>'.$voi.'</td>
						<td>'.$vop.'</td>
						<td>'.$vob.'</td>
					</tr>
					<tr class="tdm">
						<td>TDM</td>
						<td>'.$tei.'</td>
						<td>'.$tep.'</td>
						<td>'.$teb.'</td>
					</tr>
                </table>
            </div>
            <br />Ευχαριστώ.';

    $mail->Body    = $msg;
    $mail->send();
	
	echo '<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>';

?>