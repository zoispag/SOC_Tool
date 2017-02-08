<?php

$port = $_GET["port"];

echo "<p class='text-info text-right'>Όριο: ". $port ."</p>";

echo "
<style type='text/css'>
	#.right {
	#	border-right:thin solid;
	#	border-color:black;
	#}
	#.left {
	#	border-left:thin solid;
	#	border-color:black;
	#}
	#.top {
	#	border-top:thin solid;
	#	border-color:black;
	#}
	#.bottom {
	#	border-bottom:thin solid;
	#	border-color:black;
	#}
	.title {
		text-align:left;
	}
	.desc {
		text-align:right;
	}
</style>
";

echo "<table class='table table-hover'>";

echo "<tr><td colspan='5'><strong>Huawei MA5600</strong></td><tr/>";

// Huawei MA5600

if ($port < 961 && $port > 0) {
	if ($port % 64 != 0) {
	$MA56s = ($port - $port % 64) / 64;
	$MA56p = ($port % 64) -1;
	if ($port > 448) { $MA56s += 2; }
	} else {
		$MA56s = $port / 64 -1;
		$MA56p = 63;
		if ($port > 449) { $MA56s++; }
	}

	echo "<tr>";
		//echo "<td><input type='radio' name='cardtype' value='o1'></td>";
		echo "<td class='left bottom top'>".$MA56s."</td>";
		echo "<td class='bottom top'>/</td>";
		echo "<td class='right bottom top'>".$MA56p. "</td>";
		echo "<td class='desc'>(ADBF - ADEF)</td>";
	echo "</tr>";
} else {
	echo "<tr><td colspan='5'><p class='text-warning'>Available inputs 1-960</p></td><tr/>";
}

if ($port < 961 && $port > 0) {
	//Huawei MA5600T;
	if ($port % 48 != 0) {
		$MA56T48s = (($port - $port % 48) / 48) +1;
		$MA56T48p = ($port % 48) -1;
	} else {
		$MA56T48s = $port / 48;
		$MA56T48p = 47;
	}

	//Huawei MA5600;
	if ($port % 64 != 0) {
	$MA56T64s = (($port - $port % 64) / 64) +1;
	$MA56T64p = ($port % 64) -1;
	} else {
		$MA56T64s = $port / 64;
		$MA56T64p = 63;
	}

	//Huawei MA5600Tv1;
	if ($port % 24 != 0) {
	$MA56T24s = ($port - $port % 24) / 24 +1;
	$MA56T24p = ($port % 24) -1;
	} else {
		$MA56T24s = $port / 24;
		$MA56T24p = 23;
	}
	
echo "<tr><td colspan='5'><strong>Huawei MA5600T</strong></td><tr/>";

	echo "<tr>";
		//echo "<td><input type='radio' name='cardtype' value='o2'></td>";
		echo "<td class='left bottom top'>".$MA56T64s."</td>";
		echo "<td class='bottom top'>/</td>";
		echo "<td class='right bottom top'>".$MA56T64p. "</td>";
		echo "<td class='desc'>(ADPD - ADQD - ASPB)</td>";
	echo "</tr>";

	echo "<tr>";
		//echo "<td><input type='radio' name='cardtype' value='o3'></td>";
		echo "<td class='left bottom top'>".$MA56T48s."</td>";
		echo "<td class='bottom top'>/</td>";
		echo "<td class='right bottom top'>".$MA56T48p. "</td>";
		echo "<td class='desc'>(VCMM - VDMF)</td>";
	echo "</tr>";

	echo "<tr>";
		//echo "<td><input type='radio' name='cardtype' value='o4'></td>";
		echo "<td class='left bottom top'>".$MA56T24s."</td>";
		echo "<td class='bottom top'>/</td>";
		echo "<td class='right bottom top'>".$MA56T24p. "</td>";
		echo "<td class='desc'>(VDSF)</td>";
	echo "</tr>";
} else {
	echo "<tr><td colspan='5'><p class='text-warning'>Available inputs 1-960</p></td><tr/>";
}

if ($port < 961 && $port > 0) {
	//Huawei MA5603Tv2;
	if ($port % 32 != 0) {
	$MA5603T32s  = ($port - $port % 32) / 32;
	$MA5600T32p = ($port % 32) -1;
	} else {
		$MA5603T32s = $port / 32 -1;
		$MA5600T32p = 31;
	}
	
	//Huawei MA5600;
	if ($port % 64 != 0) {
	$MA5603T64s = (($port - $port % 64) / 64);
	$MA5603T64p = ($port % 64) -1;
	} else {
		$MA5603T64s = $port / 64 -1;
		$MA5603T64p = 63;
	}
	
	//Huawei MA5600T;
	if ($port % 48 != 0) {
		$MA5603T48s = (($port - $port % 48) / 48);
		$MA5603T48p = ($port % 48) -1;
	} else {
		$MA5603T48s = $port / 48 -1;
		$MA5603T48p = 47;
	}
	
	if ($MA5603T48s>5) {$MA5603T48s++;}
	
	//Huawei MA5600Tv1;
	if ($port % 24 != 0) {
	$MA5603T24s = ($port - $port % 24) / 24;
	$MA5603T24p = ($port % 24) -1;
	} else {
		$MA5603T24s = $port / 24 -1;
		$MA5603T24p = 23;
	}

// Huawei MA5600Tv2

echo "<tr><td colspan='5'><strong>Huawei MA5603Tv2</strong></td><tr/>";

echo "<tr>";
	//echo "<td><input type='radio' name='cardtype' value='o5'></td>";
	echo "<td class='left bottom top'>".$MA5603T32s."</td>";
	echo "<td class='bottom top'>/</td>";
	echo "<td class='right bottom top'>".$MA5600T32p. "</td>";
	echo "<td class='desc'>(ADEF - ADLF)</td>";
echo "</tr>";

echo "<tr>";
	//echo "<td><input type='radio' name='cardtype' value='o6'></td>";
	echo "<td class='left bottom top'>".$MA5603T64s."</td>";
	echo "<td class='bottom top'>/</td>";
	echo "<td class='right bottom top'>".$MA5603T64p. "</td>";
	echo "<td class='desc'>(ADPD - ADQD - ASPB)</td>";
echo "</tr>";

echo "<tr>";
	//echo "<td><input type='radio' name='cardtype' value='o7'></td>";
	echo "<td class='left bottom top'>".$MA5603T48s."</td>";
	echo "<td class='bottom top'>/</td>";
	echo "<td class='right bottom top'>".$MA5603T48p. "</td>";
	echo "<td class='desc'>(VCMM - VDMF)</td>";
echo "</tr>";

echo "<tr>";
	//echo "<td><input type='radio' name='cardtype' value='o8'></td>";
	echo "<td class='left bottom top'>".$MA5603T24s."</td>";
	echo "<td class='bottom top'>/</td>";
	echo "<td class='right bottom top'>".$MA5603T24p. "</td>";
	echo "<td class='desc'>(VDSF)</td>";
echo "</tr>";

} else {
	echo "<tr><td colspan='5'><p class='text-warning'>Available inputs 1-960</p></td><tr/>";
}
// Huawei MA5616

echo "<tr><td colspan='5'><strong>Huawei MA5616</strong></td><tr/>";

if ($port < 129 && $port > 0) {
	//Huawei MA5616 Slot 1-4 - 32 ports	
	if ($port % 32 != 0) {
	$MA5616v32s  = ($port - $port % 32) / 32 +1;
	$MA5616v32p = ($port % 32) -1;
	} else {
		$MA5616v32s = $port / 32;
		$MA5616v32p = 31;
	}
	
echo "<tr>";
	//echo "<td><input type='radio' name='cardtype' value='o9'></td>";
	echo "<td class='left bottom top'>".$MA5616v32s."</td>";
	echo "<td class='bottom top'>/</td>";
	echo "<td class='right bottom top'>".$MA5616v32p. "</td>";
	echo "<td class='desc'>(ADLF)</td>";
echo "</tr>";

} else {
	echo "<tr><td colspan='5'><p class='text-warning'>Available inputs 1-128</p></td><tr/>";
}

echo "<tr><td clospan='5'></td></tr>";
echo "<tr><td colspan='5'><strong>Alcatel-Lucent ISAM</strong></td><tr/>";

//ISAM ALU;
if ($port < 481 && $port > 0) {
	if ($port % 48 != 0) {
		$alu = ($port - $port % 48) / 48 +1;
		$alup = ($port % 48);
		if ($alu < 9) { $alu2 = 9-$alu; } else if ($alu == 9) { $alu2 = 10; } else if ($alu == 10) { $alu2 = 9; }
		
	} else {
		$alu = $port / 48;
		$alup = 48;
		if ($alu < 9) { $alu2 = 9-$alu; } else if ($alu == 9) { $alu2 = 10; } else if ($alu == 10) { $alu2 = 9; }
	}
	
	echo "<tr>";
		//echo "<td><input type='radio' name='cardtype' value='o10'></td>";
		echo "<td class='left bottom top'>".$alu."</td>";
		echo "<td class='bottom top'>/</td>";
		echo "<td class='right bottom top'>".$alup. "</td>";
		echo "<td class='desc'>(ALU) - (on Siebel: ".$alu2."/".$alup.")</td>";
	echo "</tr>";

	echo "<tr>";
		//echo "<td><input type='radio' name='cardtype' value='o10'></td>";
		echo "<td class='left bottom top'>".$alu."</td>";
		echo "<td class='bottom top'>/</td>";
		echo "<td class='right bottom top'>".$alup. "</td>";
		echo "<td class='desc'>(ALC)</td>";
	echo "</tr>";

} else {
	echo "<tr><td colspan='5'><p class='text-warning'>Available inputs 1-480</p></td><tr/>";
}

echo "<tr><td clospan='5'></td></tr>";
echo "<tr><td colspan='5'><strong>Marak-ZTE</strong></td><tr/>";

//Marak
if ($port < 4289 && $port > 0) {
	$marakr = 1;
	$marakd = 1;
	$mrc = "black";
	if ($port < 449) {
		if ($port % 32 != 0) {
		$marakp = ($port - $port % 32) / 32 +2;
		$maraks = ($port % 32);
		if (($port > 193) AND ($port < 225)) { $marakp++; } else if (($port > 225) && ($port < 449)) { $marakp++; $marakp++; }
		} else {
			$marakp = $port / 32 +1;
			$maraks = 32;
		}
	} else if ($port < 961) {
		$marakr++;
		$mrc = "red";
		if (($port-448) % 32 != 0) {
		$marakp = (($port-448) - ($port-448) % 32) / 32 +2;
		$maraks = (($port-448) % 32);
		} else {
			$marakp = ($port-448) / 32 +1;
			$maraks = 32;
		}
	} else if ($port < 1409) {
		$marakd++;
		$mrc = "red";
		if (($port-960) % 32 != 0) {
		$marakp = (($port-960) - ($port-960) % 32) / 32 +2;
		$maraks = (($port-960) % 32);
		} else {
			$marakp = ($port-960) / 32 +1;
			$maraks = 32;
		}
	} else if ($port < 1921) {
		$marakr++;
		$marakd++;
		$mrc = "red";
		if (($port-1408) % 32 != 0) {
		$marakp = (($port-1408) - ($port-1408) % 32) / 32 +2;
		$maraks = (($port-1408) % 32);
		} else {
			$marakp = ($port-1408) / 32 +1;
			$maraks = 32;
		}
	} else if ($port < 2369) {
		$marakd++;$marakd++;
		$mrc = "red";
		if (($port-1920) % 32 != 0) {
		$marakp = (($port-1920) - ($port-1920) % 32) / 32 +2;
		$maraks = (($port-1920) % 32);
		} else {
			$marakp = ($port-1920) / 32 +1;
			$maraks = 32;
		}
	} else if ($port < 2881) {
		$marakd++;$marakd++;
		$marakr++;
		$mrc = "red";
		if (($port-2368) % 32 != 0) {
		$marakp = (($port-2368) - ($port-2368) % 32) / 32 +2;
		$maraks = (($port-2368) % 32);
		} else {
			$marakp = ($port-2368) / 32 +1;
			$maraks = 32;
		}
	} else if ($port < 3329) {
		$marakd++;$marakd++;$marakd++;
		$mrc = "red";
		if (($port-2880) % 32 != 0) {
		$marakp = (($port-2880) - ($port-2880) % 32) / 32 +2;
		$maraks = (($port-2880) % 32);
		} else {
			$marakp = ($port-2880) / 32 +1;
			$maraks = 32;
		}
	} else if ($port < 3841) {
		$marakd++;$marakd++;$marakd++;
		$marakr++;
		$mrc = "red";
		if (($port-3328) % 32 != 0) {
		$marakp = (($port-3328) - ($port-3328) % 32) / 32 +2;
		$maraks = (($port-3328) % 32);
		} else {
			$marakp = ($port-3328) / 32 +1;
			$maraks = 32;
		}
	} else if ($port < 4289) {
		$marakd++;$marakd++;$marakd++;$marakd++;
		$mrc = "red";
		if (($port-3840) % 32 != 0) {
		$marakp = (($port-3840) - ($port-3840) % 32) / 32 +2;
		$maraks = (($port-3840) % 32);
		} else {
			$marakp = ($port-3840) / 32 +1;
			$maraks = 32;
		}
	} 
	
	echo "<tr>";
		echo "<td class='left bottom top'>".$marakp."</td>";
		echo "<td class='bottom top'>/</td>";
		echo "<td class='right bottom top'>".$maraks. "</td>";
		echo "<td class='desc'><font color='".$mrc."'>(#".$marakd.") Rack: ".$marakr."</font></td>";
	echo "</tr>";	
} else {
	echo "<tr><td colspan='5'><p class='text-warning'>Available inputs 1-4288</p></td><tr/>";
}

echo "<tr class='erow'><td clospan='5'></td></tr>";
echo "<tr><td colspan='5'><strong>Siemens</strong></td><tr/>";

//Siemens 1-960 2-8 10-17
if ($port < 961 && $port > 0) {
	if ($port % 64 != 0) {
	$siep = ($port - $port % 64) / 64 +2;
	$sies = ($port % 64);
	if ($port > 448) { $siep++; }
	} else {
		$siep = $port / 64 +1;
		$sies = 64;
	}
	
	echo "<tr>";
		echo "<td class='left bottom top'>".$siep."</td>";
		echo "<td class='bottom top'>/</td>";
		echo "<td class='right bottom top'>".$sies. "</td>";
		echo "<td class='desc'>(SUADSL:64PX)</td>";
	echo "</tr>";	
} else {
	echo "<tr><td colspan='5'><p class='text-warning'>Available inputs 1-960</p></td><tr/>";
}

echo "<tr><td colspan='5'><strong>Siemens Mini</strong></td><tr/>";

//Siemens 32
if ($port < 33 && $port > 0) {
	if ($port % 32 != 0) {
	$siemp = ($port - $port % 32) / 32 +2;
	$siems = ($port % 32);
	} else {
		$siemp = $port / 32 +1;
		$siems = 32;
	}
	
	echo "<tr>";
		echo "<td class='left bottom top'>".$siemp."</td>";
		echo "<td class='bottom top'>/</td>";
		echo "<td class='right bottom top'>".$siems. "</td>";
		echo "<td class='desc'>(PDIMAE1CA:32P)</td>";
	echo "</tr>";	
} else {
	echo "<tr><td colspan='5'><p class='text-warning'>Available inputs 1-32</p></td><tr/>";
}

echo "<tr class='erow'><td clospan='5'></td></tr>";
echo "<tr><td colspan='5'><strong>IBAS 48P</strong></td><tr/>";

//IBAS 48 (1-8 & 11-18) 
if ($port < 769 && $port > 0) {
	if ($port % 48 != 0) {
	$ibasp = ($port - $port % 48) / 48 +1;
	$ibass = ($port % 48);
		if ($port > 384) { $ibasp++; $ibasp++; } 
	} else {
		$ibasp = $port / 48;
		$ibass = 48;
	}
	
	echo "<tr>";
		echo "<td class='left bottom top'>".$ibasp."</td>";
		echo "<td class='bottom top'>/</td>";
		echo "<td class='right bottom top'>".$ibass. "</td>";
		echo "<td class='desc'></td>";
	echo "</tr>";	
} else {
	echo "<tr><td colspan='5'><p class='text-warning'>Available inputs 1-768</p></td><tr/>";
}

echo "<tr><td colspan='5'><strong>IBAS Mini</strong></td><tr/>";

//IBAS 32 (1-8 & 11-18) 
if ($port < 513 && $port > 0) {
	if ($port % 32 != 0) {
	$ibasmp = ($port - $port % 32) / 32 +1;
	$ibasms = ($port % 32);
		if ($port > 256) { $ibasmp++; $ibasmp++; } 
	} else {
		$ibasmp = $port / 32;
		$ibasms = 32;
	}
	
	echo "<tr>";
		echo "<td class='left bottom top'>".$ibasmp."</td>";
		echo "<td class='bottom top'>/</td>";
		echo "<td class='right bottom top'>".$ibasms. "</td>";
		echo "<td class='desc'></td>";
	echo "</tr>";	
} else {
	echo "<tr><td colspan='5'><p class='text-warning'>Available inputs 1-512</p></td><tr/>";
}

echo "<tr class='erow'><td clospan='5'></td></tr>";
echo "<tr><td colspan='5'><strong>Alcatel</strong></td><tr/>";

//alcatel 
if ($port < 2305 && $port > 0) {
	$alcr = 1;
	$arc = "black";
	if ($port < 769) {
		if ($port % 48 != 0) {
		$alcp = ($port - $port % 48) / 48 +1;
		$alcs = ($port % 48);
		} else {
			$alcp = $port / 48;
			$alcs = 48;
		}
	} else if ($port < 1537) {
		$alcr++;
		$arc = "red";
		if (($port-768) % 48 != 0) {
		$alcp = (($port-768) - ($port-768) % 48) / 48 +1;
		$alcs = (($port-768) % 48);
		} else {
			$alcp = ($port-768) / 48;
			$alcs = 48;
		}
	} else {
		$alcr++; $alcr++;
		$arc = "red";
		if (($port-1536) % 48 != 0) {
		$alcp = (($port-1536) - ($port-1536) % 48) / 48 +1;
		$alcs = (($port-1536) % 48);
		} else {
			$alcp = ($port-1536) / 48;
			$alcs = 48;
		}
	}
	
	echo "<tr>";
		echo "<td class='left bottom top'>".$alcp."</td>";
		echo "<td class='bottom top'>/</td>";
		echo "<td class='right bottom top'>".$alcs. "</td>";
		echo "<td class='desc'><font color='".$arc."'>Subrack: ".$alcr."</font> (on Siebel: ".($alcp+3)."/".$alcs.")</td>";
	echo "</tr>";	
} else {
	echo "<tr><td colspan='5'><p class='text-warning'>Available inputs 1-2304</p></td><tr/>";
}

echo "<tr><td colspan='5'><strong>Alcatel Mini</strong></td><tr/>";

//alcatel mini (1-5) 
if ($port < 121 && $port > 0) {
	if ($port % 24 != 0) {
	$alcmp = ($port - $port % 24) / 24 +1;
	$alcms = ($port % 24);
	} else {
		$alcmp = $port / 24;
		$alcms = 24;
	}
	
	echo "<tr>";
		echo "<td class='left bottom top'>".$alcmp."</td>";
		echo "<td class='bottom top'>/</td>";
		echo "<td class='right bottom top'>".$alcms. "</td>";
		echo "<td class='desc'>(on Siebel: ".($alcmp+3)."/".$alcms.")</td>";
	echo "</tr>";	
} else {
	echo "<tr><td colspan='5'><p class='text-warning'>Available inputs 1-120</p></td><tr/>";
}

echo "</table>";

?>