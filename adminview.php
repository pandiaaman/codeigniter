<?php
?>
<!DOCTYPE html>
<html>
<head>
<title>ADMIN</title>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
 <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>
<body>
<table id="table_id" class="display">
<thead>
<tr>
	<th>user id</th>
	<th>name</th>
	<th>email</th>
	<th>address</th>
	<th>contact</th>
	<th>flag</th>
	<th>aprrooval</th>
</tr>
</thead>
<tbody>
<?php

//print_r($userArray);
	/*foreach ($userArray as $key=>$value){
		echo"<pre>";
		print_r($value);
		echo"</pre>";
		/*echo '<form method="POST" action="<?php echo base_url().'index.php/welcome/changeflag' ?> ">';
		echo '<button name="aproove" type="submit">approove</button>';
		echo '</form>';*/
	//}
	//if($userArray->num_rows>0){
		foreach($userArray->result() as $row){
			$uid=$row->uid;
		?>
		
	<tr>
	<td><?php echo $row->uid;?> </td>
	<td><?php echo $row->uname;?> </td>
	<td><?php echo $row->uemail;?> </td>
	<td><?php echo $row->uadd;?> </td>
	<td><?php echo $row->uphone;?> </td>
	<td><?php echo $row->flag;?> </td>
	<!--<td><button type="submit" name="approve"> approove</button></td>
	
	<?php //echo'<a href="'.base_url().'index.php/welcome/changeflag/$uid">approove</a>';?>-->
	<td>
	
	<?php echo form_open(base_url().'welcome/changeflag/'.$uid);?>
	<button type="submit">approove</button>
	<?php echo form_close();?>
	<!--<form method="POST" action="<?php// echo base_url().'welcome/changeflag/'.$row->uid?>">
	<button type="submit" name="submit" value="submit">approove</button>
	</form>-->
	
	</td>
	</tr>
	<?php
	}
	
	//}
	/*else{
	?>
	 <tr>
		<td colspan="3">no data</td>
	 </tr>
<?php
	}*/
	echo'<a href="'.base_url().'index.php/welcome/logout">logout</a>';
	?>
</tbody>
</table>
</body>
</html>
<script type="text/javascript">
$(document).ready( function () {
    $(table_id).DataTable();
} );


</script>