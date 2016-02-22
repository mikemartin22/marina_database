<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Alexamara Marina Group Maintenance - Service Request</title>
		<link rel="stylesheet" type="text/css" href="../styles.css"/>
		<link rel="SHORTCUT ICON" href="../mylogo.ico"/>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"/>
		<script type='text/javascript' src="//code.jquery.com/jquery-1.10.2.js"></script>
  		<script type='text/javascript' src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css"/>
		<script type='text/javascript'> 
			$(document).ready(function() { 
				$("#datepicker").datepicker();	
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
								<a href="../maintenance.html"><img alt="" class="main"/></a>
								<br />
								<h1>Service Request</h1>
								<hr style="border-top: dotted 1px;" />
							</td>
						</tr>
						<tr>
							<td align="left">
								<form method="post">
									Enter Service ID Number Here: <input name="service_id" type="text"/>
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
											if(empty($_REQUEST['service_id']))
											{
												echo '<script type="text/javascript">alert("Please enter a Service ID");</script>';
											}
											
											else
											{
												$service_id=$_POST['service_id'];
												$query = "SELECT * FROM SERVICE_REQUEST
												WHERE SERVICE_ID= '$service_id'";

												if($r=mysql_query($query))
												{
													$num_rows =mysql_num_rows($r);
													if($num_rows==0&&!empty($_REQUEST['service_id']))
													{
														$message = "Invalid Service ID";
														echo "<script type='text/javascript'>alert('$message');</script>";
													}
													
													else
													{
														$row=mysql_fetch_array($r);
														$id=$row['SERVICE_ID'];
														$slip_id=$row['SLIP_ID'];
														$category_num=$row['CATEGORY_NUM'];
														$description=$row['DESCRIPTION'];
														$status=$row['STATUS'];
														$est_hours=$row['EST_HOURS'];
														$spent_hours=$row['SPENT_HOURS'];
														$next_service_date=$row['NEXT_SERVICE_DATE'];
														echo "<p>The data for Service ID ".$id." is displayed below</p>";
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
												$slip_id=$_POST['slip_id'];
												$category_num=$_POST['category_num'];
												$description=$_POST['description'];
												$status=$_POST['status'];
												$est_hours=$_POST['est_hours'];
												$spent_hours=$_POST['spent_hours'];
												$next_service_date=$_POST['next_service_date'];
												$viewquery= "SELECT * FROM SERVICE_REQUEST WHERE SERVICE_ID = '$id'";

												if($r=mysql_query($viewquery))
												{
														echo "<center>";
															echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																<tr bgcolor='black'>
																	<th>Service ID</th>
																	<th>Slip ID</th>
																	<th>Category Number</th>
																	<th>Description</th>
																	<th>Status</th>
																	<th>Estimated Hours</th>
																	<th>Spent Hours</th>
																	<th>Next Service Date</th>
																</tr>";

																	$row=mysql_fetch_array($r);
																	echo"<p>Deletion successful. <br />The data displayed below has been deleted.</p>";
																	echo"<tr>";
																	echo"<td>" .$row['SERVICE_ID'] ."</td>";
																	echo"<td>" .$row['SLIP_ID'] ."</td>";
																	echo"<td>" .$row['CATEGORY_NUM'] ."</td>";
																	echo"<td>" .$row['DESCRIPTION'] ."</td>";
																	echo"<td>" .$row['STATUS'] ."</td>";
																	echo"<td>" .$row['EST_HOURS'] ."</td>";
																	echo"<td>" .$row['SPENT_HOURS'] ."</td>";
																	echo"<td>" .$row['NEXT_SERVICE_DATE'] ."</td>";
																echo"</tr>";
															echo "</table>";
														echo"</center>";
														echo"<br /><br />";
												}
												$query = mysql_query("DELETE FROM SERVICE_REQUEST WHERE SERVICE_ID = '$id'");
												$id=NULL;
												$slip_id=NULL;
												$category_num=NULL;
												$description=NULL;
												$status=NULL;
												$est_hours=NULL;
												$spent_hours=NULL;
												$next_service_date=NULL;
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
												$slip_id=$_POST['slip_id'];
												$category_num=$_POST['category_num'];
												$description=$_POST['description'];
												$status=$_POST['status'];
												$est_hours=$_POST['est_hours'];
												$spent_hours=$_POST['spent_hours'];
												$next_service_date=$_POST['next_service_date'];
												
												$viewqueryone="SELECT * FROM SERVICE_REQUEST WHERE SLIP_ID = '$slip_id'";
												$viewquerytwo="SELECT * FROM SERVICE_REQUEST WHERE CATEGORY_NUM = '$category_num'";
												
												$error = 0;
												
												if($slip_id==NULL||$category_num==NULL||$description==NULL||$status==NULL||$est_hours==NULL||$spent_hours==NULL||$next_service_date==NULL)
												{
													$message = "You have not filled out all required infomation";
													echo "<script type='text/javascript'>alert('$message');</script>";
													$error++;
												}
												
												if($slip_id!=NULL)
												{
													$r=mysql_query($viewqueryone);
													$num_rows =mysql_num_rows($r);
													if($num_rows==0)
													{
														$message = "You have entered an invalid Slip ID.";
														echo "<script type='text/javascript'>alert('$message');</script>";
														$error++;
													}
												}
												
												if ($category_num!=NULL)
												{
													$r=mysql_query($viewquerytwo);
													$num_rows =mysql_num_rows($r);
													if($num_rows==0)
													{
														$message = "You have entered an invalid Category Number.";
														echo "<script type='text/javascript'>alert('$message');</script>";
														$error++;
													}
												}
												
												if(!is_numeric($est_hours)&&$est_hours!=NULL)
												{
													$message = "You have entered an invalid for estimated hours. Please enter a number value.";
													echo "<script type='text/javascript'>alert('$message');</script>";
													$error++;						
												}
												
												if(!is_numeric($spent_hours)&&$spent_hours!=NULL)
												{
													$message = "You have entered an invalid value for spent hours. Please enter a number value.";
													echo "<script type='text/javascript'>alert('$message');</script>";
													$error++;						
												}
												
												if ($error != 0)
												{
													echo "<p>The data for Service ID ".$id." is displayed below</p>";
												}												
												elseif($error == 0)
												{
													$query = mysql_query("UPDATE SERVICE_REQUEST SET SERVICE_ID ='$id', CATEGORY_NUM ='$category_num', DESCRIPTION ='$description', STATUS ='$status', EST_HOURS ='$est_hours', SPENT_HOURS ='$spent_hours', NEXT_SERVICE_DATE ='$next_service_date' WHERE SERVICE_ID='$id'");
													$viewquery= "SELECT * FROM SERVICE_REQUEST WHERE SERVICE_ID = '$id'";
													
													if($r=mysql_query($viewquery))
													{
															echo "<center>";
																echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																	<tr bgcolor='black'>
																		<th>Service ID</th>
																		<th>Slip ID</th>
																		<th>Category Number</th>
																		<th>Description</th>
																		<th>Status</th>
																		<th>Estimated Hours</th>
																		<th>Spent Hours</th>
																		<th>Next Service Date</th>
																	</tr>";

																		$row=mysql_fetch_array($r);
																		echo"<p>Modification successful. <br />The modified data for Service ID ".$row['SERVICE_ID']." is displayed below.</p>";
																		echo"<tr>";
																		echo"<td>" .$row['SERVICE_ID'] ."</td>";
																		echo"<td>" .$row['SLIP_ID'] ."</td>";
																		echo"<td>" .$row['CATEGORY_NUM'] ."</td>";
																		echo"<td>" .$row['DESCRIPTION'] ."</td>";
																		echo"<td>" .$row['STATUS'] ."</td>";
																		echo"<td>" .$row['EST_HOURS'] ."</td>";
																		echo"<td>" .$row['SPENT_HOURS'] ."</td>";
																		echo"<td>" .$row['NEXT_SERVICE_DATE'] ."</td>";
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
												$id=NULL;
												$slip_id=NULL;
												$category_num=NULL;
												$description=NULL;
												$status=NULL;
												$est_hours=NULL;
												$spent_hours=NULL;
												$next_service_date=NULL;	
											}
																						
											else
											{
												$id=$_POST['id'];
												$slip_id=$_POST['slip_id'];
												$category_num=$_POST['category_num'];
												$description=$_POST['description'];
												$status=$_POST['status'];
												$est_hours=$_POST['est_hours'];
												$spent_hours=$_POST['spent_hours'];
												$next_service_date=$_POST['next_service_date'];
												
												$viewqueryone="SELECT * FROM SERVICE_REQUEST WHERE SLIP_ID = '$slip_id'";
												$viewquerytwo="SELECT * FROM SERVICE_REQUEST WHERE CATEGORY_NUM = '$category_num'";
												
												$error = 0;
												
												if($slip_id==NULL||$category_num==NULL||$description==NULL||$status==NULL||$est_hours==NULL||$spent_hours==NULL||$next_service_date==NULL)
												{
													$message = "You have not filled out all required infomation";
													echo "<script type='text/javascript'>alert('$message');</script>";
													$error++;
												}												
												
												if($slip_id!=NULL)
												{
													$r=mysql_query($viewqueryone);
													$num_rows =mysql_num_rows($r);
													if($num_rows==0)
													{
														$message = "You have entered an invalid Slip ID.";
														echo "<script type='text/javascript'>alert('$message');</script>";
														$error++;
													}
												}
												
												if ($category_num!=NULL)
												{
													$r=mysql_query($viewquerytwo);
													$num_rows =mysql_num_rows($r);
													if($num_rows==0)
													{
														$message = "You have entered an invalid Category Number.";
														echo "<script type='text/javascript'>alert('$message');</script>";
														$error++;
													}
												}
												
												if(!is_numeric($est_hours)&&$est_hours!=NULL)
												{
													$message = "You have entered an invalid for estimated hours. Please enter a number value.";
													echo "<script type='text/javascript'>alert('$message');</script>";
													$error++;						
												}
												
												if(!is_numeric($spent_hours)&&$spent_hours!=NULL)
												{
													$message = "You have entered an invalid value for spent hours. Please enter a number value.";
													echo "<script type='text/javascript'>alert('$message');</script>";
													$error++;						
												}
												
												elseif($error == 0)
												{
													$myquery = mysql_query("SELECT MAX(SERVICE_ID) FROM SERVICE_REQUEST");
													$myrow = mysql_fetch_assoc($myquery);	
													$new_id = $myrow['MAX(SERVICE_ID)'];
													$new_id = $new_id + 1;
													
													$query= mysql_query("INSERT INTO SERVICE_REQUEST VALUES ('$new_id','$slip_id','$category_num','$description','$status','$est_hours','$spent_hours','$next_service_date')");

													$viewquery= "SELECT * FROM SERVICE_REQUEST WHERE SERVICE_ID = '$new_id'";

													if($r=mysql_query($viewquery))
													{
														echo "<center>";
															echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																<tr bgcolor='black'>
																	<th>Service ID</th>
																	<th>Slip ID</th>
																	<th>Category Number</th>
																	<th>Description</th>
																	<th>Status</th>
																	<th>Estimated Hours</th>
																	<th>Spent Hours</th>
																	<th>Next Service Date</th>
																</tr>";
																	$row=mysql_fetch_array($r);


																	echo"<p>Insertion successful. <br />The new data for Service ID ".$row['SERVICE_ID']." is displayed below.</p>";
																	echo"<tr>";
																	echo"<td>" .$row['SERVICE_ID'] ."</td>";
																	echo"<td>" .$row['SLIP_ID'] ."</td>";
																	echo"<td>" .$row['CATEGORY_NUM'] ."</td>";
																	echo"<td>" .$row['DESCRIPTION'] ."</td>";
																	echo"<td>" .$row['STATUS'] ."</td>";
																	echo"<td>" .$row['EST_HOURS'] ."</td>";
																	echo"<td>" .$row['SPENT_HOURS'] ."</td>";
																	echo"<td>" .$row['NEXT_SERVICE_DATE'] ."</td>";
																echo"</tr>";
															echo "</table>";
														echo"</center>";
														echo"<br /><br />";
														$id=NULL;
														$slip_id=NULL;
														$category_num=NULL;
														$description=NULL;
														$status=NULL;
														$est_hours=NULL;
														$spent_hours=NULL;
														$next_service_date=NULL;
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
									Slip ID: <input name="slip_id" type="text" value="<?php echo $slip_id; ?>"/><br /><br />
									Category Number: <input name="category_num" type="text" value="<?php echo $category_num; ?>"/><br /><br />
									Description: <textarea name="description" rows="4" cols="50"><?php echo $description; ?></textarea><br /><br />
									Status: <textarea name="status" rows="4" cols="50"><?php echo $status; ?></textarea><br /><br />
									Estimated Hours: <input name="est_hours" type="text" value="<?php echo $est_hours; ?>"/><br /><br />
									Spent Hours: <input name="spent_hours" type="text" value="<?php echo $spent_hours; ?>"/><br /><br />
									Next Service Date: <input name="next_service_date" type="text" id="datepicker" value="<?php echo $next_service_date; ?>"/><br /><br />

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