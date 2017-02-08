<?php

//ARGOL_DREPANO_D_HUA_10000
if ($val == '10000') {
    $found++;
    $cactiID = [('10000.GigabitEthernet0/0/1')=>'64916'];
}

//ATTIC_PENTELI_D_ALU_13714_KV
if ($val == '13714') {
    $found++;
    $cactiID = [
        ('13714.GigabitEthernet0/5/0/0')=>'88533',
        ('13714.Bundle-Ether15000.2501')=>'124838',
        ('13714.Bundle-Ether15000.2502')=>'124839'
    ];
}
if (($val == '13714.GigabitEthernet0/5/0/0') || ($val == '13714.1')) {
    $found++;
    $cactiID = [('13714.GigabitEthernet0/5/0/0')=>'88533'];
}
if (($val == '13714.Bundle-Ether15000.2501') || ($val == '13714.2501')) {
    $found++;
    $cactiID = [('13714.Bundle-Ether15000.2501')=>'124838'];
}
if (($val == '13714.Bundle-Ether15000.2502') || ($val == '13714.2502')) {
    $found++;
    $cactiID = [('13714.Bundle-Ether15000.2502')=>'124839'];
}

//ATTIC_GIROKOMIO_D_HUA_14000
if ($val == '14000') {
    $found++;
    $cactiID = [
        ('14000.GigabitEthernet3/1/8')=>'82167',
        ('14000.Bundle-Ether1.2551')=>'154454',
        ('14000.Bundle-Ether1.2552')=>'154455'
    ];
}
if (($val == '14000.GigabitEthernet3/1/8') || ($val == '14000.1')) {
    $found++;
    $cactiID = [('14000.GigabitEthernet3/1/8')=>'82167'];
}
if (($val == '14000.Bundle-Ether1.2551') || ($val == '14000.2551')) {
    $found++;
    $cactiID = [('14000.Bundle-Ether1.2551')=>'154454'];
}
if (($val == '14000.Bundle-Ether1.2552') || ($val == '14000.2552')) {
    $found++;
    $cactiID = [('14000.Bundle-Ether1.2552')=>'154455'];
}

//ATTIC_CHALANDRI_D_ALU_15000_KV
if ($val == '15000') {
    $found++;
    $cactiID = [('15000.GigabitEthernet0/3/1/4')=>'120037'];
}

//THESS_THERMI_D_HUA_16000_KV
if ($val == '16000') {
    $found++;
    $cactiID = [('16000.GigabitEthernet300/0/0/37')=>'151309'];
}

?>