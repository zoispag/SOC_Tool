<?php
//include connection file 
include_once("connection.php");
$sql = "SELECT * FROM packages";
$queryRecords = mysqli_query($conn, $sql) or die("error to fetch employees data");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<script type="text/javascript" src="jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="bootstrap.min.css"/>
<title>Packages Editor</title>
</head>
<body>
<div class="container" style="padding:50px 100px;">
<h1>Packages Editor</h1>
<div id="msg" class="alert"></div>
<table id="employee_grid" class="table table-condensed table-hover table-striped bootgrid-table" width="60%" cellspacing="0">
	<thead>
		<tr>
			<th>IP</th>
			<th>Family</th>
			<th>Cinema</th>
			<th>Sports</th>
			<th>Full Light</th>
			<th>Full</th>
			<th>Adult Add-on</th>
			<th>OPAP</th>
			<th>Xoroi Estiasis</th>
			<th>Xoroi Estiasis (NoSport)</th>
		</tr>
	</thead>
   <tbody id="_editable_table">
      <?php foreach($queryRecords as $res) :?>
      <tr data-row-id="<?php echo $res['id'];?>">
         <td class="editable-col" contenteditable="true" col-index='0' oldVal ="<?php echo $res['ChannelIP'];?>"><?php echo $res['ChannelIP'];?></td>
         <td class="editable-col" contenteditable="true" col-index='1' oldVal ="<?php echo $res['FamilyPack'];?>"><?php echo $res['FamilyPack'];?></td>
         <td class="editable-col" contenteditable="true" col-index='2' oldVal ="<?php echo $res['CinemaPack'];?>"><?php echo $res['CinemaPack'];?></td>
         <td class="editable-col" contenteditable="true" col-index='3' oldVal ="<?php echo $res['SportsPack'];?>"><?php echo $res['SportsPack'];?></td>
         <td class="editable-col" contenteditable="true" col-index='4' oldVal ="<?php echo $res['FullPackLight'];?>"><?php echo $res['FullPackLight'];?></td>
         <td class="editable-col" contenteditable="true" col-index='5' oldVal ="<?php echo $res['FullPack'];?>"><?php echo $res['FullPack'];?></td>
         <td class="editable-col" contenteditable="true" col-index='6' oldVal ="<?php echo $res['AdultAddOn'];?>"><?php echo $res['AdultAddOn'];?></td>
         <td class="editable-col" contenteditable="true" col-index='7' oldVal ="<?php echo $res['OPAP'];?>"><?php echo $res['OPAP'];?></td>
         <td class="editable-col" contenteditable="true" col-index='8' oldVal ="<?php echo $res['XoroiEstiasis'];?>"><?php echo $res['XoroiEstiasis'];?></td>
		 <td class="editable-col" contenteditable="true" col-index='9' oldVal ="<?php echo $res['XoroiEstiasisNoSport'];?>"><?php echo $res['XoroiEstiasisNoSport'];?></td>
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