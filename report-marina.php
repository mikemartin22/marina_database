<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Alexamara Marina Group Reporting - Marina</title>
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
								<h1>Marina Queries</h1>
								<hr style="border-top: dotted 1px;" />
							</td>
						</tr>


						<tr>
							<td align="left">
								<form method="post">
									<p style="font-size:15px;">To look up all information about a Marina, enter the Marina Number below.</p>
									Marina Number: <input name="marina_num" type="text"/>
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
											if(empty($_REQUEST['marina_num']))
											{
												echo '<script type="text/javascript">alert("Please enter a Marina Number");</script>';
											}
											else 
											{
											$marina_num=$_POST['marina_num'];
											$query = "SELECT * FROM MARINA
											WHERE MARINA_NUM= '$marina_num'";

												if($r=mysql_query($query))
												{
													$num_rows =mysql_num_rows($r);
													if($num_rows==0&&!empty($_REQUEST['marina_num']))
													{
														$message = "Invalid Marina number";
														echo "<script type='text/javascript'>alert('$message');</script>";
													}
													else
													{

															echo "<center>";
																echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																	<tr bgcolor='black'>
																		<th>Marina Name</th>
																		<th>Address</th>
																		<th>City</th>
																		<th>State</th>
																		<th>Zip</th>
																	</tr>";
																		$row=mysql_fetch_array($r);
																		echo"<p>The data for marina number ".$row['MARINA_NUM']." is displayed below.</p>";
																		echo"<tr>";
																		echo"<td>" .$row['NAME'] ."</td>";
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
											$query = "SELECT * FROM MARINA";			
											$r=mysql_query($query);											
												echo "<center>";
												echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
													<tr bgcolor='black'>
														<th>Marina Number</th>
														<th>Marina Name</th>
														<th>Address</th>
														<th>City</th>
														<th>State</th>
														<th>Zip</th>
													</tr>";
												echo"<p>All of the information for both Marinas are displayed below.</p>";
													while($row=mysql_fetch_array($r))
													{
														echo"<tr>";
														echo"<td>" .$row['MARINA_NUM'] ."</td>";
														echo"<td>" .$row['NAME'] ."</td>";
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
									<input name="list_all" type="submit" value="" class="list_all"/>
									<input name="reset" type="submit" value="" class="clear"/>
									<hr style="border-top: dotted 1px;" />
								</form>
							</td>
						</tr>
						<tr>
							<td align="left">
								<form method="post">
									<p style="font-size:15px;">To look up all boats in a specific Marina, enter the Marina Number below.</p>
									Marina Number: <input name="marina_num2" type="text"/>
									<input name="list_boats" type="submit" onclick="window.location.hash='gohere';" value="" class="list"/>
									<br /><br />

									<?php
										if(isset($_POST['list_boats']))
										{
											if(empty($_REQUEST['marina_num2']))
											{
												echo '<script type="text/javascript">alert("Please enter a Marina Number");</script>';
											}
											else 
											{
												$marina_num2=$_POST['marina_num2'];
												$query = "SELECT * FROM MARINA
												WHERE MARINA_NUM= '$marina_num2'";
												if($r=mysql_query($query))
												{
													$num_rows =mysql_num_rows($r);
													if($num_rows==0&&!empty($_REQUEST['marina_num2']))
													{
														$message = "Invalid Marina number";
														echo "<script type='text/javascript'>alert('$message');</script>";
													}
													else	
													{
														$query2 = "SELECT SLIP_NUM, BOAT_NAME, BOAT_TYPE, OWNER.FIRST_NAME, LAST_NAME FROM MARINA_SLIP, OWNER
														WHERE MARINA_NUM= '$marina_num2' AND MARINA_SLIP.OWNER_NUM = OWNER.OWNER_NUM";
														$query3 = "SELECT NAME FROM MARINA WHERE MARINA_NUM = '$marina_num2'";
														$r3=mysql_query($query3);
														if($r2=mysql_query($query2))
														{
																	echo "<a name='gohere'></a>";
																	echo "<center>";
																		echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																			<tr bgcolor='black'>
																			<th>Slip Number</th>
																			<th>Boat Name</th>
																			<th>Boat Type</th>
																			<th>Owner's Name</th>
																			</tr>";
																				$row2=mysql_fetch_array($r3);
																				echo"<p>The boats that are located in ".$row2['NAME']." Marina <br/>are displayed below.</p>";
																				while($row=mysql_fetch_array($r2))
																				{
																					echo"<tr>";
																					echo"<td>" .$row['SLIP_NUM'] ."</td>";
																					echo"<td>" .$row['BOAT_NAME'] ."</td>";
																					echo"<td>" .$row['BOAT_TYPE'] ."</td>";
																					echo"<td>" .$row['FIRST_NAME'] . " " .$row['LAST_NAME'] ."</td>";
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
									?>

									<?php
										if (isset($_POST['list_all_boats']))
										{
											$query = "SELECT MARINA_NUM, SLIP_NUM, BOAT_NAME, BOAT_TYPE, OWNER.FIRST_NAME, LAST_NAME FROM MARINA_SLIP, OWNER
											WHERE OWNER.OWNER_NUM = MARINA_SLIP.OWNER_NUM";			
											$r=mysql_query($query);	
												echo "<a name='here'></a>";
												echo "<center>";
												echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
													<tr bgcolor='black'>
													<th>Marina Number</th>
													<th>Slip Number</th>
													<th>Boat Name</th>
													<th>Boat Type</th>
													<th>Owner's Name</th>
													</tr>";
												echo"All boats located within both Marinas are displayed below.</p>";
													while($row=mysql_fetch_array($r))
													{
														echo"<tr>";
														echo"<td>" .$row['MARINA_NUM'] ."</td>";
														echo"<td>" .$row['SLIP_NUM'] ."</td>";
														echo"<td>" .$row['BOAT_NAME'] ."</td>";
														echo"<td>" .$row['BOAT_TYPE'] ."</td>";
														echo"<td>" .$row['FIRST_NAME'] . " " .$row['LAST_NAME'] ."</td>";
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
									<input name="list_all_boats" type="submit" onclick="window.location.hash='here';" value="" class="list_all"/>
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