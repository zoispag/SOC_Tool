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

    $wsi = $_GET["wsi"];
    $tvi = $_GET["tvi"];

    //Mail Function
    require '../../phpmailer/PHPMailerAutoload.php';

    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date('d/m/Y G:i:s', strtotime( '1 hour', strtotime (date('d-m-Y G:i:s')) ));

    $mail = new PHPMailer;

    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';
    $mail->Host = "otesmtp";
    $mail->Port = 25;

    $mail->setFrom('statistics@ote.gr', 'SOC Mailer');
    $mail->addAddress('zpagoylat@ote.gr', 'Zois Pagoulatos');
    $mail->isHTML(true);
    $msg = nameByIP($ip)." ".$ip." submitted statistics at ".$date."<br/><br/>";
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
						<td colspan="4">Ticketing Statistics</td>
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
            <br />
            &bull; Δηλώθηκαν <strong>'.$wsi.'</strong> βλάβες παρόχων.
            <br />
            &bull; Δηλώθηκαν <strong>'.$tvi.'</strong> βλάβες IPTV.';


    $mail->Subject = "Statistics submitted via Bootstrap ".$date;
    $mail->Body    = $msg;
    $mail->send();

    function nameByIP($ipaddress) {

        $iptable = array 
        (
        array("172.16.119.129","Pinelopi Aggelopoulou"),
        array("172.16.119.130","Iraklis Kampaxis"),
        array("172.16.119.132","Giannis Chrisanthakopoulos"),
        array("172.16.119.133","Haris Komninos"),
        array("172.16.119.135","Paschalis Siskos"),
        array("172.16.119.136","Mpampis Tziritas"),
        array("172.16.119.137","Grigoris Chronopoulos"),
        array("172.16.119.138","Ilias Kalampoukis"),
        array("172.16.119.139","Tzeni Papageorgioy"),
        array("172.16.119.140","Nikos Grigoropoulos"),
        array("172.16.119.141","Vasilis Ioannoy"),
        array("172.16.119.142","Vaggelis Ninos"),
        array("172.16.119.143","Michalis Tsalamandris"),
        array("172.16.119.144","Nikos Choremiotis"),
        array("172.16.119.145","Zois Pagoulatos"),
        array("172.16.119.147","Sofia Markopoulou"),
        array("172.16.119.148","Marinela Kirkou"),
        array("172.16.119.149","Giorgos Papadiotis"),
        array("172.16.119.151","Giorgos Moschonisios"),
        array("172.16.119.152","Tzeni Papageorgiou"),
        array("172.16.119.154","Giannis Reras"),
        array("172.16.119.157","Spyros Ferentinos"),
        array("172.16.119.185","Stavros Gkousis"),
        array("172.16.119.193","Stathis Takmakis"),
        array("172.16.119.195","Eudoksia Foti"),
        array("172.16.119.196","Eva Remoundou"),
        array("172.16.119.198","Kostas Chatzis"),
        array("172.16.119.199","Chara Balabanou"),
        array("172.16.119.200","Stavros Gkousis"),
        array("172.16.119.201","Pinelopi Aggelopoulou"),
        array("172.16.119.204","Giorgos Katounis"),
        array("172.16.119.207","Panagiotis Paspalas"),
        array("172.16.119.209","Sotiris Lois"),
        array("172.16.119.229","Dimitris Papadatos"),
        array("172.16.119.230","Thanos Giamarelos"),
        array("172.16.119.231","Nikos Sfakiotis"),
        array("172.16.119.235","Dimitris Groumpas"),
        array("172.16.119.237","Antonis Manitas"),
        array("172.16.119.239","Giorgos Michalakopoulos")
        );

        foreach ($iptable as $key => $val) {
            if ($val[0] === $ipaddress) {
                    return "(".$val[1].")";
            }
        }
        return null;
    }

?>