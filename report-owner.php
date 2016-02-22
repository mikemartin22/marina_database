<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Alexamara Marina Group Reporting - Owner</title>
		<link rel="stylesheet" type="text/css" href="../styles.css">
		<link rel="SHORTCUT ICON" href="../mylogo.ico"/>
		<script type="text/javascript" src="../jquery-1.11.3.min.js"></script>
		<script  type='text/javascript'>
			$(document).ready(function(){
				$(".report").hover(function() {
					$(this).attr("src","../buttons/back-report2.JPG");
						}, function() {
					$(this).attr("src","../buttons/back-report.JPG");
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
								<a href="../reporting.html"><img alt="back to reporting" class="report" src="../buttons/back-report.JPG" /></a>
								<br />
								<h1>Owner Queries</h1>
								<hr style="border-top: dotted 1px;" />
							</td>
						</tr>


						<tr>
							<td align="left">
								<form method="post">
									<p style="font-size:15px;">To look up information about an Owner, enter the Owner Number below.</p>
									Owner Number: <input name="owner_num" type="text"/>
									<input name="list" type="submit" value="" class="list"/>
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
										if(isset($_POST['list']))
										{
											if(empty($_REQUEST['owner_num']))
											{
												echo '<script type="text/javascript">alert("Please enter a Owner Number");</script>';
											}
											else 
											{
											$owner_num=$_POST['owner_num'];										
											$query = "SELECT * FROM OWNER
											WHERE OWNER_NUM= '$owner_num'";

												if($r=mysql_query($query))
												{
													$num_rows =mysql_num_rows($r);
													if($num_rows==0&&!empty($_REQUEST['owner_num']))
													{
														$message = "Invalid Owner Number";
														echo "<script type='text/javascript'>alert('$message');</script>";
													}
													else
													{

															echo "<center>";
																echo "<table border = '5' cellpadding = '5' style='font-size:12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																	<tr bgcolor='black'>
																	<th>Last Name</th>
																	<th>First Name</th>
																	<th>Address</th>
																	<th>City</th>
																	<th>State</th>
																	<th>Zip</th>
																	</tr>";
																		$row=mysql_fetch_array($r);
																		echo"<p>The data for owner number ".$row['OWNER_NUM']." is displayed below.</p>";
																		echo"<tr>";
																		echo"<td>" .$row['LAST_NAME'] ."</td>";
																		echo"<td>" .$row['FIRST_NAME'] ."</td>";
																		echo"<td>" .$row['ADDRESS'] ."</td>";
																		echo"<td>" .$row['CITY'] ."</td>";
																		echo"<td>" .$row['STATE'] ."</td>";
																		echo"<td>" .$row['ZIP'] ."</td>";
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
										if (isset($_POST['list_all']))
										{
											$query = "SELECT * FROM OWNER";			
											$r=mysql_query($query);	
												echo "<a name='go'></a>";
												echo "<center>";
												echo "<table border = '5' cellpadding = '5' style='font-size:12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
													<tr bgcolor='black'>
														<th>Owner Number</th>
														<th>Last Name</th>
														<th>First Name</th>
														<th>Address</th>
														<th>City</th>
														<th>State</th>
														<th>Zip</th>
													</tr>";
												echo"<p>All of the information for every Owner is displayed below.</p>";
													while($row=mysql_fetch_array($r))
													{
														echo"<tr>";
														echo"<td>" .$row['OWNER_NUM'] ."</td>";
														echo"<td>" .$row['LAST_NAME'] ."</td>";
														echo"<td>" .$row['FIRST_NAME'] ."</td>";
														echo"<td>" .$row['ADDRESS'] ."</td>";
														echo"<td>" .$row['CITY'] ."</td>";
														echo"<td>" .$row['STATE'] ."</td>";
														echo"<td>" .$row['ZIP'] ."</td>";
														echo"</tr>";
													}
												echo "</table>";
											echo"</center>";
											echo"<br /><br />";
										}
									?>
									
									<br />				
									<input name="list_all" type="submit" onclick="window.location.hash='go';" value="" class="list_all"/>
									<input name="reset" type="submit" value="" class="clear"/>
									<hr style="border-top: dotted 1px;" />
								</form>
							</td>
						</tr>
						<tr>
							<td align="left">
								<form method="post">
									<p style="font-size:15px;">To look up the status of an Owners boat, enter the Owner Number below.</p>
									Owner Number: <input name="owner_num2" type="text"/>
									<input name="list_boats" onclick="window.location.hash='gohere';" type="submit" value="" class="list"/>
									<br /><br />

									<?php
										if(isset($_POST['list_boats']))
										{
											if(empty($_REQUEST['owner_num2']))
											{
												echo '<script type="text/javascript">alert("Please enter an Owner Number");</script>';
											}
											else 
											{
												
												$owner_num2=$_POST['owner_num2'];
												$letters = substr($owner_num2, 0, 2);
												strtoupper($letters);
												$numbers = substr($owner_num2, 2, 4);
												$owner_num2=$letters.$numbers;
												$query = "SELECT * FROM OWNER
												WHERE OWNER_NUM= '$owner_num2'";
												if($r=mysql_query($query))
												{
													$num_rows =mysql_num_rows($r);
													if($num_rows==0&&!empty($_REQUEST['owner_num2']))
													{
														$message = "Invalid Owner number";
														echo "<script type='text/javascript'>alert('$message');</script>";
													}
													else	
													{
														$query2 = "SELECT OWNER.LAST_NAME, FIRST_NAME, MARINA_SLIP.BOAT_NAME, RENTAL_FEE, SERVICE_REQUEST.DESCRIPTION, STATUS, EST_HOURS, SPENT_HOURS, NEXT_SERVICE_DATE FROM OWNER, MARINA_SLIP, SERVICE_REQUEST 
														WHERE OWNER.OWNER_NUM= '$owner_num2'
														AND OWNER.OWNER_NUM = MARINA_SLIP.OWNER_NUM
														AND MARINA_SLIP.SLIP_ID = SERVICE_REQUEST.SLIP_ID";
														$query3 = "SELECT LAST_NAME, FIRST_NAME, MARINA_SLIP.BOAT_NAME, BOAT_TYPE, RENTAL_FEE FROM OWNER, MARINA_SLIP WHERE OWNER.OWNER_NUM = '$owner_num2' AND OWNER.OWNER_NUM = MARINA_SLIP.OWNER_NUM";
														$r3=mysql_query($query3);
														if($r2=mysql_query($query2))
														{
																	$num_rows = mysql_num_rows($r2);
																	if($num_rows==0)
																	{
																		$row2=mysql_fetch_array($r3);
																		echo "<a name='gohere'></a>";
																		echo "<p style='text-align:center;'>".$row2['FIRST_NAME']. " ". $row2['LAST_NAME']." currently has no service requests, their boat information is displayed below.</p>";
																		echo "<center>";
																		echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																				<tr bgcolor='black'>
																				<th>Boat Name</th>
																				<th>Boat Type</th>
																				<th>Rental Fee</th>
																				</tr>";	
																				echo"<tr>";
																				echo"<td>" .$row2['BOAT_NAME'] ."</td>";
																				echo"<td>" .$row2['BOAT_TYPE'] ."</td>"; 
																				echo"<td>$" .number_format($row2['RENTAL_FEE'],2) ."</td>";
																				echo"</tr>";
																		echo "</table>";
																		echo"</center>";
																		echo"<br /><br />";																	}
																	else
																	{	
																		echo "<a name='gohere'></a>";
																		echo "<center>";
																		echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																				<tr bgcolor='black'>
																				<th>Boat Name</th>
																				<th>Rental Fee</th>
																				<th>Description</th>
																				<th>Status</th>
																				<th>Estimated Hours</th>
																				<th>Spent Hours</th>
																				<th>Next Service Date</th>
																				</tr>";
																					$row2=mysql_fetch_array($r3);
																					echo"<p>The status for all boats owned by ".$row2['FIRST_NAME']. " ". $row2['LAST_NAME']." <br/>are displayed below.</p>";
																					while($row=mysql_fetch_array($r2))
																					{
																						echo"<tr>";
																						echo"<td>" .$row['BOAT_NAME'] ."</td>";
																						echo"<td>$" .number_format($row['RENTAL_FEE'],2) ."</td>";
																						echo"<td>" .$row['DESCRIPTION'] ."</td>";
																						echo"<td>" .$row['STATUS'] ."</td>";
																						echo"<td>" .$row['EST_HOURS'] ."</td>";
																						echo"<td>" .$row['SPENT_HOURS'] ."</td>";
																						echo"<td>" .$row['NEXT_SERVICE_DATE'] ."</td>";
																						echo"</tr>";
																					}
																			echo "</table>";
																		echo"</center>";
																		echo"<br /><br />";
																	}
														}
													}
												}
											}
										}
									?>

									<?php
										if (isset($_POST['list_all_boats']))
										{
											$query = "SELECT OWNER.LAST_NAME, FIRST_NAME, MARINA_SLIP.BOAT_NAME, RENTAL_FEE, SERVICE_REQUEST.DESCRIPTION, STATUS, EST_HOURS, SPENT_HOURS, NEXT_SERVICE_DATE FROM OWNER, MARINA_SLIP, SERVICE_REQUEST 
											WHERE OWNER.OWNER_NUM = MARINA_SLIP.OWNER_NUM
											AND MARINA_SLIP.SLIP_ID = SERVICE_REQUEST.SLIP_ID ORDER BY FIRST_NAME ASC";
											$r=mysql_query($query);
												echo "<a name='here'></a>";
												echo "<center>";
												echo "<table width='700px' border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
													<tr bgcolor='black'>
													<th>Owner's Name</th>
													<th>Boat Name</th>
													<th>Rental Fee</th>
													<th>Description</th>
													<th>Status</th>
													<th>Estimated Hours</th>
													<th>Spent Hours</th>
													<th>Next Service Date</th>
													</tr>";
												echo"The status of every boat is displayed below.</p>";
													while($row=mysql_fetch_array($r))
													{
														echo"<tr>";
														echo"<td>" .$row['FIRST_NAME'] . " ".$row['LAST_NAME']. "</td>";
														echo"<td>" .$row['BOAT_NAME'] ."</td>";
														echo"<td>$" .number_format($row['RENTAL_FEE'],2) ."</td>";
														echo"<td>" .$row['DESCRIPTION'] ."</td>";
														echo"<td>" .$row['STATUS'] ."</td>";
														echo"<td>" .$row['EST_HOURS'] ."</td>";
														echo"<td>" .$row['SPENT_HOURS'] ."</td>";
														echo"<td>" .$row['NEXT_SERVICE_DATE'] ."</td>";
														echo"</tr>";
													}
												echo "</table>";
											echo"</center>";
											echo"<br /><br />";
										}
									?>

									<?php
										
										if (isset($_POST['reset']))
										{
											
										}
										
									?>
									
									<br />				
									<input name="list_all_boats" onclick="window.location.hash='here';" type="submit" value="" class="list_all"/>
									<input name="reset" type="submit" value="" class="clear"/>
									<hr style="border-top: dotted 1px;" />
								</form>
							</td>
						</tr>

					</table>
				</td>
			</tr>
		</table>

	</body>
</html>