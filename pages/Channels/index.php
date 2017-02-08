
<script type="text/javascript" src="jquery-1.11.1.min.js"></script>
<title>Channel Tool</title>

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<style>
	a.mailme:link { color: black; text-decoration: none; }
	a.mailme:hover { color: teal; text-decoration: underline; }
</style>

<table>
	<tr>
		<td style="width:390px; padding-left:20px">
			<table style="font-size:15px; font-family:Sans-serif; font-weight:600;">
				<tr>
					<td>Broadcast IP:</td>
					<td>
						<input type="text" class="Searchable" id="ChannelIP" placeholder="e.g. 225.10.11.148" name="ChannelIP">
					</td>
				</tr>
				<tr>
					<td>List No:</td>
					<td>
						<input type="text" class="Searchable" id="ChannelNumber" placeholder="e.g. 301" name="ChannelNumber">
					</td>
				</tr>
				<tr>
					<td>Name:</td>
					<td>
						<input type="text" class="Searchable" id="ChannelName" placeholder="e.g. OTE Cinema 1" name="ChannelName">
					</td>
				</tr>
				<tr>
					<td>Platform:</td>
					<td>
						<select class="Searchable" id="Platform">
							<option value="all">All Platforms</option>
							<option value="Ericsson">Ericsson</option>
							<option value="Huawei">Huawei</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Quality:</td>
					<td>
						<select class="Searchable" id="Quality">
							<option value="all">All Definitions</option>
							<option value="SD">Standard Definition</option>
							<option value="HD">High Definition</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>HDCP/RET:</td>
					<td>
						<select class="Searchable" id="HDCP">
							<option value="all"> </option>
							<option value="Enabled">Enabled</option>
							<option value="Disabled">Disabled</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Encryption:</td>
					<td>
						<select class="Searchable" id="Encryption">
							<option value="all"> </option>
							<option value="Encrypted">Encrypted</option>
							<option value="Unencrypted">Unencrypted</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Bouquet:</td>
					<td>
						<select class="Searchable" id="Bouquet">
							<option value="all">Όλα τα κανάλια</option>
							<option value="Greek">Ελληνικά</option>
							<option value="Cinema">Ταινίες & Σειρές</option>
							<option value="Sports">Αθλητικά</option>
							<option value="Documentary">Ντοκιμαντέρ</option>
							<option value="Entertainment">Ψυχαγωγικά</option>
							<option value="Kids">Παιδικά</option>
							<option value="Music">Μουσικά</option>
							<option value="News">Ειδησεογραφικά</option>
							<option value="Adult">Ενηλίκων</option>
							<option value="Promo/Fake">Promo/Fake</option>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
					<td>Sort by:</td>
					<td>
						<select class="Searchable" id="SortBy">
							<option value="ChannelListNo">ListNo</option>
							<option value="ChannelIP">IP</option>
							<option value="ChannelName">Name</option>
							<option value="ChannelPlatform">Platform</option>
							<option value="ChannelQuality">Quality</option>
							<option value="ChannelHDCP">HDCP</option>
							<option value="ChannelEncryption">Encryption</option>
							<option value="ChannelBouquet">Bouquet</option>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<select class="Searchable" id="ascsesc">
							<option value="ASC">Ascending</option>
							<option value="DESC">Descending</option>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
					<td colspan="2" style="font-weight:normal; font-size:12px; font-style:italic; font-family:Sans-serif;">Για αναζήτηση στατιστικών μέσω Agama εισάγετε</td>
				</tr>
				<tr>
					<td style="font-weight:normal; font-size:12px; font-style:italic; font-family:Sans-serif;">κωδικό DSLAM</td>
					<td>
						<input type="text" class="Searchable" id="probecode" placeholder="DSLAM Code" name="probecode">
					</td>
				</tr>
			</table>
			<button id="searchChannels">Search</button><button style="visibility:hidden" id="clearSearch">Clear</button>
		</td>
		<td style="width:300px">
			<x style="font-size:12px; font-family:Sans-serif;">
				<div style="text-align:right"><strong><font style="font-size:16px">Channel Tool</font></strong><br>
				<font style="font-size:9px">by <a class="mailme" title="Mail me" href="mailto:zpagoylat@ote.gr">Zois Pagoulatos</a></font></div>
				<br><br>
				Με τo <strong>Channel Tool</strong> μπορείτε να κάνετε αναζητήση στα κανάλια της υπηρεσίας IPTV.
				<br><br>
				Σαν αποτέλεσμα επιστρέφονται όλες οι χρήσιμες πληροφορίες για τα κανάλια που πληρούν τα κριτήρια, τα οποία επιλέχθηκαν.
				<br><br>
				Εάν πληκτρολογηθεί αριθμός DSLAM, επιστρέφεται η εικόνα του καναλιού για το συγκεκριμένο DSLAM στο Agama, ενώ αν το πεδίο μείνει κενό, επιστρέφεται για όλα τα Domains.<br><br>
					<style>
						#agamadiv { color:darkred; font-size:10px; text-decoration: none; }
						a.agamarequest:link { color:darkred; text-decoration: underline; }
						a.agamarequest:visited { color:darkred; text-decoration: underline; }
					</style>
					<div id='agamadiv'><a class='agamarequest' target='_blank' href='http://172.28.128.106:8800/'>Απαιτείται login στο Agama για την εύρυθμη λειτουργία.</a></div>
				<br><br><br>
			</x>
		</td>
	</tr>
</table>
<div id="container"></div>

<script type="text/javascript">

$(document).ready(function(){
	$("#searchChannels").click(function(){
		//alert($temp);
		$("#clearSearch").attr("style", "visibility:visible");
		$("#container").empty();
		$("#container").delay(1000).load("filterquery.php?cIP="+$("#ChannelIP").val()+"&cName="+$("#ChannelName").val().replace(/\s+/g, '%')+"&cNo="+$("#ChannelNumber").val()+"&cPl="+$("#Platform").val()+"&cQu="+$("#Quality").val()+"&cHd="+$("#HDCP").val()+"&cEn="+$("#Encryption").val()+"&cBo="+$("#Bouquet").val()+"&cSo="+$("#SortBy").val()+"&cSW="+$("#ascsesc").val()+"&probeRequest="+$("#probecode").val());
		
	});
	
	$("#clearSearch").click(function(){
		$("#container").empty();
		$("#ChannelIP").val("").empty();
		$("#ChannelName").val("").empty();
		$("#ChannelNumber").val("").empty();
		$("#Platform").val("all");
		$("#Quality").val("all");
		$("#HDCP").val("all");
		$("#Encryption").val("all");
		$("#Bouquet").val("all");
		$("#probecode").val("").empty();
		$("#SortBy").val("ChannelListNo");
		$("#ascsesc").val("ASC");
		$("#clearSearch").attr("style", "visibility:hidden");
	});
	
	$(".Searchable").keypress(function(e){
		if(e.keyCode==13)
			$("#searchChannels").click();
	});
	
});

</script>