<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Alexamara Marina Group Maintenance - Marina Slip</title>
		<link rel="stylesheet" type="text/css" href="../styles.css">
		<link rel="SHORTCUT ICON" href="../mylogo.ico"/>
		<script type="text/javascript" src="../jquery-1.11.3.min.js"></script>
		<script  type='text/javascript'>
			$(document).ready(function(){
				$(".main").hover(function() {
					$(this).attr("src","../buttons/back-main2.JPG");
						}, function() {
					$(this).attr("src","../buttons/back-main.JPG");
				});	
			});
		</script>
	</head>

<body>

		<table class="layout" height="600px" align="center">
			<tr>
				<td class="header">
					<table>
						<tr>
							<td class="header" colspan="2">
								<img alt="header" src="../header.JPG" />
								<a href="../maintenance.html"><img alt="back to maintenance" class="main" src="../buttons/back-main.JPG" /></a>
								<br />
								<h1>Marina Slip</h1>
								<hr style="border-top: dotted 1px;" />
							</td>
						</tr>
						<tr>
							<td align="left">
								<form method="post">
									Enter Slip ID Here: <input name="slip_id" type="text"/>
									<input name="retrieve" type="submit" value="" class="retrieve"/>
									<br /><br />
									
									<?php

										ini_set('display_errors',1);
										error_reporting(E_ALL & ~E_NOTICE);

										if($connection=@mysql_connect('localhost','MM1238','elvis921'))
										{

										}
										
										else
										{
											die('<p>Could not connect to MySQL becuase: <b>' .mysql_error().'</b></p>');
										}

										if(@mysql_select_db("MM1238_PROJECT1",$connection))
										{
											
										}
										
										else
										{
											die('<p>Could not select the MM1238_PROJECT1 database becuase: <b>' .mysql_error().'</b></p>');
										}

									?>

									<?php
										if(isset($_POST['retrieve']))
										{
											
											if(empty($_REQUEST['slip_id']))
											{
												echo '<script type="text/javascript">alert("Please enter a Slip ID");</script>';
											}
											
											else
											{
											$slip_id=$_POST['slip_id'];
											$query = "SELECT * FROM MARINA_SLIP WHERE SLIP_ID = '$slip_id'";

												if($r=mysql_query($query))
												{
													$num_rows =mysql_num_rows($r);
													if($num_rows==0&&!empty($_REQUEST['slip_id']))
													{
														$message = "Invalid Slip ID";
														echo "<script type='text/javascript'>alert('$message');</script>";
													}
													
													else
													{
														$row=mysql_fetch_array($r);
														$id=$row['SLIP_ID'];
														$marina_num=$row['MARINA_NUM'];
														$slip_num=$row['SLIP_NUM'];
														$length=$row['LENGTH'];
														$rental_fee=$row['RENTAL_FEE'];
														$boat_name=$row['BOAT_NAME'];
														$boat_type=$row['BOAT_TYPE'];
														$owner_num=$row['OWNER_NUM'];
														echo "<p>The data for Slip ID ".$id." is displayed below</p>";
													}
												}
											}
										}
									?>

									<?php
										if (isset($_POST['delete']))
										{
											if(empty($_REQUEST['id']))
											{
												$message = "You have not retrieved any data yet";
												echo "<script type='text/javascript'>alert('$message');</script>";
											}
											else
											{
												$id=$_POST['id'];
												$marina_num=$_POST['marina_num'];
												$slip_num=$_POST['slip_num'];
												$length=$_POST['length'];
												$rental_fee=$_POST['rental_fee'];
												$boat_name=$_POST['boat_name'];
												$boat_type=$_POST['boat_type'];
												$owner_num=$_POST['owner_num'];
												$viewquery= "SELECT * FROM MARINA_SLIP WHERE SLIP_ID = '$id'";

												if($r=mysql_query($viewquery))
												{
														echo "<center>";
															echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																<tr bgcolor='black'>
																	<th>Slip ID</th>
																	<th>Marina Number</th>
																	<th>Slip Number</th>
																	<th>Length</th>
																	<th>Rental Fee</th>
																	<th>Boat Name</th>
																	<th>Boat Type</th>										
																	<th>Owner Number</tr>
																</tr>";

																	$row=mysql_fetch_array($r);
																	echo"<p>Deletion successful. <br />The data displayed below has been deleted.</p>";
																	echo"<tr>";
																	echo"<td>" .$row['SLIP_ID'] ."</td>";
																	echo"<td>" .$row['MARINA_NUM'] ."</td>";
																	echo"<td>" .$row['SLIP_NUM'] ."</td>";
																	echo"<td>" .$row['LENGTH'] ."</td>";
																	echo"<td>" .$row['RENTAL_FEE'] ."</td>";
																	echo"<td>" .$row['BOAT_NAME'] ."</td>";
																	echo"<td>" .$row['BOAT_TYPE'] ."</td>";
																	echo"<td>" .$row['OWNER_NUM'] ."</td>";
																echo"</tr>";
															echo "</table>";
														echo"</center>";
														echo"<br /><br />";
												}
												$query = mysql_query("DELETE FROM MARINA_SLIP WHERE SLIP_ID = '$id'");
												$id=NULL;
												$marina_num=NULL;
												$slip_num=NULL;
												$length=NULL;
												$rental_fee=NULL;
												$boat_name=NULL;
												$boat_type=NULL;
												$owner_num=NULL;
											}
										}
									?>

									<?php
									
										if(isset($_POST['modify']))
										{
											if(empty($_REQUEST['id']))
											{
												$message = "You have not retrieved any data yet";
												echo "<script type='text/javascript'>alert('$message');</script>";		
											}
																						
											else
											{
												$id=$_POST['id'];
												$marina_num=$_POST['marina_num'];
												$slip_num=$_POST['slip_num'];
												$length=$_POST['length'];
												$rental_fee=$_POST['rental_fee'];
												$boat_name=$_POST['boat_name'];
												$boat_type=$_POST['boat_type'];
												$owner_num=$_POST['owner_num'];
												
												$viewqueryone="SELECT * FROM MARINA WHERE MARINA_NUM = '$marina_num'";
												$viewquerytwo="SELECT * FROM OWNER WHERE OWNER_NUM = '$owner_num'";
												
												$error = 0;

												if($marina_num==NULL||$slip_num==NULL||$length==NULL||$rental_fee==NULL||$boat_name==NULL||$boat_type==NULL||$owner_num==NULL)
												{
													$message = "You have not filled out all required infomation";
													echo "<script type='text/javascript'>alert('$message');</script>";
													$error++;
												}
												
												if($marina_num!=NULL)
												{
													$r=mysql_query($viewqueryone);
													$num_rows =mysql_num_rows($r);
													if($num_rows==0)
													{
														$message = "You have entered an invalid Marina Number.";
														echo "<script type='text/javascript'>alert('$message');</script>";
														$error++;
													}
												}
												
												if ($owner_num!=NULL)
												{
													$r=mysql_query($viewquerytwo);
													$num_rows =mysql_num_rows($r);
													if($num_rows==0)
													{
														$message = "You have entered an invalid Owner Number.";
														echo "<script type='text/javascript'>alert('$message');</script>";
														$error++;
													}
												}
												
												if(!is_numeric($length)&&$length!=NULL)
												{
													$message = "You have entered an invalid length. Please enter a number value.";
													echo "<script type='text/javascript'>alert('$message');</script>";
													$error++;						
												}
												
												if(!is_numeric($rental_fee)&&$rental_fee!=NULL)
												{
													$message = "You have entered an invalid rental fee. Please enter a number value.";
													echo "<script type='text/javascript'>alert('$message');</script>";
													$error++;						
												}
												
												if ($error != 0)
												{
													echo "<p>The data for Slip ID ".$id." is displayed below</p>";
												}
												
												elseif($error == 0)
												{
												$query = mysql_query("UPDATE MARINA_SLIP SET SLIP_ID ='$id', MARINA_NUM ='$marina_num', SLIP_NUM ='$slip_num', LENGTH ='$length', RENTAL_FEE ='$rental_fee', BOAT_NAME ='$boat_name', BOAT_TYPE ='$boat_type', OWNER_NUM ='$owner_num' WHERE SLIP_ID='$id'");
												$viewquery= "SELECT * FROM MARINA_SLIP WHERE SLIP_ID = '$id'";

													if($r=mysql_query($viewquery))
													{

															echo "<center>";
																echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																	<tr bgcolor='black'>
																		<th>Slip ID</th>
																		<th>Marina Number</th>
																		<th>Slip Number</th>
																		<th>Length</th>
																		<th>Rental Fee</th>
																		<th>Boat Name</th>
																		<th>Boat Type</th>										
																		<th>Owner Number</th>
																	</tr>";

																		$row=mysql_fetch_array($r);
																		echo"<p>Modification successful. <br />The modified data for Slip ID ".$row['SLIP_ID']." is displayed below.</p>";
																		echo"<tr>";
																		echo"<td>" .$row['SLIP_ID'] ."</td>";
																		echo"<td>" .$row['MARINA_NUM'] ."</td>";
																		echo"<td>" .$row['SLIP_NUM'] ."</td>";
																		echo"<td>" .$row['LENGTH'] ."</td>";
																		echo"<td>$" .number_format($row['RENTAL_FEE'],2) ."</td>";
																		echo"<td>" .$row['BOAT_NAME'] ."</td>";
																		echo"<td>" .$row['BOAT_TYPE'] ."</td>";
																		echo"<td>" .$row['OWNER_NUM'] ."</td>";
																	echo"</tr>";
																echo "</table>";
															echo"</center>";
															echo"<br /><br />";
													}
												}												
											}
										}
									?>
									
									<?php

										if(isset($_POST['insert']))
										{
											if(!empty($_REQUEST['id']))
											{
												$message = "Data needs to be cleared before inserting a new entry";
												echo "<script type='text/javascript'>alert('$message');</script>";					
												$slip_id=NULL;
												$marina_num=NULL;
												$slip_num=NULL;
												$length=NULL;
												$rental_fee=NULL;
												$boat_name=NULL;
												$boat_type=NULL;
												$owner_num=NULL;
											}

											else
											{
												$id=$_POST['id'];
												$marina_num=$_POST['marina_num'];
												$slip_num=$_POST['slip_num'];
												$length=$_POST['length'];
												$rental_fee=$_POST['rental_fee'];
												$boat_name=$_POST['boat_name'];
												$boat_type=$_POST['boat_type'];
												$owner_num=$_POST['owner_num'];
												$error = 0;												
												$viewqueryone="SELECT * FROM MARINA WHERE MARINA_NUM = '$marina_num'";
												$viewquerytwo="SELECT * FROM OWNER WHERE OWNER_NUM = '$owner_num'";

												if($marina_num==NULL||$slip_num==NULL||$length==NULL||$rental_fee==NULL||$boat_name==NULL||$boat_type==NULL||$owner_num==NULL)
												{
													$message = "You have not filled out all required infomation";
													echo "<script type='text/javascript'>alert('$message');</script>";
													$error++;
												}

												if($marina_num!=NULL)
												{
													$r=mysql_query($viewqueryone);
													$num_rows =mysql_num_rows($r);
													if($num_rows==0)
													{
														$message = "You have entered an invalid Marina Number.";
														echo "<script type='text/javascript'>alert('$message');</script>";
														$error++;
													}
												}
												
												if ($owner_num!=NULL)
												{
													$r=mysql_query($viewquerytwo);
													$num_rows =mysql_num_rows($r);
													if($num_rows==0)
													{
														$message = "You have entered an invalid Owner Number.";
														echo "<script type='text/javascript'>alert('$message');</script>";
														$error++;
													}
												}
												
												if(!is_numeric($length)&&$length!=NULL)
												{
													$message = "You have entered an invalid length. Please enter a number value.";
													echo "<script type='text/javascript'>alert('$message');</script>";
													$error++;						
												}
												
												if(!is_numeric($rental_fee)&&$rental_fee!=NULL)
												{
													$message = "You have entered an invalid rental fee. Please enter a number value.";
													echo "<script type='text/javascript'>alert('$message');</script>";
													$error++;						
												}
												
												elseif($error == 0)
												{
													$myquery = mysql_query("SELECT MAX(SLIP_ID) FROM MARINA_SLIP");
													$myrow = mysql_fetch_assoc($myquery);	
													$new_id = $myrow['MAX(SLIP_ID)'];
													$new_id = $new_id + 1;

													$query= mysql_query("INSERT INTO MARINA_SLIP VALUES ('$new_id','$marina_num','$slip_num','$length','$rental_fee','$boat_name','$boat_type','$owner_num')");
													$viewquery= "SELECT * FROM MARINA_SLIP WHERE SLIP_ID = '$new_id'";

													if($r=mysql_query($viewquery))
													{

															echo "<center>";
																echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																		<tr bgcolor='black'>
																		<th>Slip ID</th>
																		<th>Marina Number</th>
																		<th>Slip Number</th>
																		<th>Length</th>
																		<th>Rental Fee</th>
																		<th>Boat Name</th>
																		<th>Boat Type</th>										
																		<th>Owner Number</th>
																		</tr>";
																		$row=mysql_fetch_array($r);


																		echo"<p>Insertion successful. <br />The new data for Slip ID ".$row['SLIP_ID']." is displayed below.</p>";
																		echo"<tr>";
																		echo"<td>" .$row['SLIP_ID'] ."</td>";
																		echo"<td>" .$row['MARINA_NUM'] ."</td>";
																		echo"<td>" .$row['SLIP_NUM'] ."</td>";
																		echo"<td>" .$row['LENGTH'] ."</td>";
																		echo"<td>$" .number_format($row['RENTAL_FEE'],2) ."</td>";
																		echo"<td>" .$row['BOAT_NAME'] ."</td>";
																		echo"<td>" .$row['BOAT_TYPE'] ."</td>";
																		echo"<td>" .$row['OWNER_NUM'] ."</td>";
																	echo"</tr>";
																echo "</table>";
															echo"</center>";
															echo"<br /><br />";
															$slip_id=NULL;
															$marina_num=NULL;
															$slip_num=NULL;
															$length=NULL;
															$rental_fee=NULL;
															$boat_name=NULL;
															$boat_type=NULL;
															$owner_num=NULL;
													}		
												}
											}
										}
									?>


									<?php

										if(isset($_POST['reset']))
										{

										}
										
									?>


									<br />
									<input name="id" type="hidden" value="<?php echo $id; ?>"/>
									Marina Number: <input name="marina_num" type="text" value="<?php echo $marina_num; ?>"/><br /><br />
									Slip Number: <input name="slip_num" type="text" value="<?php echo $slip_num; ?>"/><br /><br />
									Length: <input name="length" type="text" value="<?php echo $length; ?>"/><br /><br />
									Rental Fee: <input name="rental_fee" type="text" value="<?php echo $rental_fee; ?>"/><br /><br />
									Boat Name: <input name="boat_name" type="text" value="<?php echo $boat_name; ?>"/><br /><br />
									Boat Type: <input name="boat_type" type="text" value="<?php echo $boat_type; ?>"/><br /><br />
									Owner Number: <input name="owner_num" type="text" value="<?php echo $owner_num; ?>"/><br /><br />

									<input name="modify" type="submit" value="" class="modify" onclick="return confirm('Are you sure you want to modify?')"/>
									<input name="insert" type="submit" value="" class="insert"/>
									<input name="delete" type="submit" value="" class="delete" onclick="return confirm('Are you sure you want to delete?')"/>
									<input name="reset" type="submit" value="" class="clear"/>
								</form>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

	</body>
</html>