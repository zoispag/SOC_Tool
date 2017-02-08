<?php 

    $webpage = $loc;
    $file = './logfile.txt';

    if (($loc != 'Offline DSLAMs') & ($loc != 'Εποπτεία') & ($loc != 'Home'))  {
        $ip = $_SERVER['REMOTE_ADDR'];
        $date = date('d/m/Y G:i:s', strtotime( '1 hour', strtotime (date('d-m-Y G:i:s')) ));
        $agent = $_SERVER['HTTP_USER_AGENT'];
        if ($ip != "172.16.119.145") {
            $fp = fopen($file, 'a');
            fwrite($fp, $ip.' - ['.$date.'] '.$webpage." || ".nameByIP($ip)." ".replaceAgent($agent)." \r\n");
            fclose($fp);
			
        }
    }

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
        array("172.16.119.139","Alexandra Lalaioy"),
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
        array("172.16.119.152","Christoforos Sparaggis"),
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

    function replaceAgent($stag) {
        if($stag=='Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36') {
            return 'Chrome 49.0';
        } else if($stag=='Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36'){
           return 'Chrome 49.0';
        } else if($stag=='Mozilla/5.0 (Windows NT 6.1; rv:44.0) Gecko/20100101 Firefox/44.0') {
           return 'Firefox 44.0.2';
        } else if($stag=='Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; InfoPath.3)') {
           return 'Internet Explorer 8';
        } else if($stag=='Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/20100101 Firefox/38.0') {
           return ' Firefox 38.0';
        } else if($stag=='Mozilla/5.0 (Windows NT 6.1; rv:18.0) Gecko/20100101 Firefox/18.0') {
           return ' Firefox 18.0';
        } else if($stag=='Mozilla/5.0 (Windows NT 5.1; rv:18.0) Gecko/20100101 Firefox/18.0') {
           return ' Firefox 18.0';
        }
        else return $stag;  
    }
?>