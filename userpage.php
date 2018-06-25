<?php
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<table>
<tr>
	<th>user id</th>
	<th>name</th>
	<th>email</th>
	<th>password</th>
</tr>
<?php

foreach($userArray->result() as $row){
		?>
		
	<tr>
	<td><?php echo $row->uid;?> </td>
	<td><?php echo $row->uname;?> </td>
	<td><?php echo $row->uemail;?> </td>
	<td><?php echo $row->upass;?> </td>
	</tr>
	
	<?php
	}
	echo'<a href="'.base_url().'index.php/welcome/logout">logout</a>';
	//}
	/*else{
	?>
	 <tr>
		<td colspan="3">no data</td>
	 </tr>
<?php
	}*/
	
	?>
</table>
</body>
</html>