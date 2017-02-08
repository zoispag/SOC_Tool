<?php
//include connection file 
include_once("connection.php");
$sql = "SELECT * FROM channels";
$queryRecords = mysqli_query($conn, $sql) or die("error to fetch employees data");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<script type="text/javascript" src="jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="bootstrap.min.css"/>
<title>Channel List Editor</title>
</head>
<body>
<div class="container" style="padding:50px 250px;">
<h1>Channel List Editor</h1>
<div id="msg" class="alert"></div>
<table id="employee_grid" class="table table-condensed table-hover table-striped bootgrid-table" width="60%" cellspacing="0">
	<thead>
		<tr>
			<th>IP</th>
			<th>List No.</th>
			<th>Logo</th>
			<th>Channel Name</th>
			<th>Platform</th>
			<th>Quality</th>
			<th>HDC Protection</th>
			<th>Encryption</th>
			<th>Bouquet</th>
			<th>Delete</th>
		</tr>
	</thead>
   <tbody id="_editable_table">
      <?php foreach($queryRecords as $res) :?>
      <tr data-row-id="<?php echo $res['id'];?>">
         <td class="editable-col" contenteditable="true" col-index='0' oldVal ="<?php echo $res['ChannelIP'];?>"><?php echo $res['ChannelIP'];?></td>
         <td class="editable-col" contenteditable="true" col-index='1' oldVal ="<?php echo $res['ChannelListNo'];?>"><?php echo $res['ChannelListNo'];?></td>
         <td class="editable-col" contenteditable="true" col-index='2' oldVal ="<?php echo $res['ChannelLogo'];?>"><?php echo $res['ChannelLogo'];?></td>
         <td class="editable-col" contenteditable="true" col-index='3' oldVal ="<?php echo $res['ChannelName'];?>"><?php echo $res['ChannelName'];?></td>
         <td class="editable-col" contenteditable="true" col-index='4' oldVal ="<?php echo $res['ChannelPlatform'];?>"><?php echo $res['ChannelPlatform'];?></td>
         <td class="editable-col" contenteditable="true" col-index='5' oldVal ="<?php echo $res['ChannelQuality'];?>"><?php echo $res['ChannelQuality'];?></td>
         <td class="editable-col" contenteditable="true" col-index='6' oldVal ="<?php echo $res['ChannelHDCP'];?>"><?php echo $res['ChannelHDCP'];?></td>
         <td class="editable-col" contenteditable="true" col-index='7' oldVal ="<?php echo $res['ChannelEncryption'];?>"><?php echo $res['ChannelEncryption'];?></td>
         <td class="editable-col" contenteditable="true" col-index='8' oldVal ="<?php echo $res['ChannelBouquet'];?>"><?php echo $res['ChannelBouquet'];?></td>
		 <td class="delete-row" style="text-align:center;"><img src="delete.png" width="30%"></td>
      </tr>
	  <?php endforeach;?>
   </tbody>
</table>
</div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	$('td.editable-col').on('focusout', function() {
		data = {};
		data['val'] = $(this).text();
		data['id'] = $(this).parent('tr').attr('data-row-id');
		data['index'] = $(this).attr('col-index');
	    if($(this).attr('oldVal') === data['val'])
		return false;
		
		$.ajax({   
				  
					type: "POST",  
					url: "server.php",  
					cache:false,  
					data: data,
					dataType: "json",				
					success: function(response)  
					{   
						//$("#loading").hide();
						if(response.status) {
							$("#msg").removeClass('alert-danger');
							$("#msg").addClass('alert-success').html(response.msg);
						} else {
							$("#msg").removeClass('alert-success');
							$("#msg").addClass('alert-danger').html(response.msg);
						}
					}   
				});
	});
	$('td.delete-row').click(function(){
		alert(""+$(this).parent('tr').attr('data-row-id')+"");
	});
});

</script>