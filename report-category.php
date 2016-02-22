<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Alexamara Marina Group Reporting - Service Category</title>
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
								<h1>Service Category Queries</h1>
								<hr style="border-top: dotted 1px;" />
							</td>
						</tr>


						<tr>
							<td align="left">
								<form method="post">
									<p style="font-size:15px;">To look up the description of a Service Category, enter the Category Number below.</p>
									Category Number: <input name="category_num" type="text"/>
									<input name="list" type="submit" value="" onclick="window.location.hash='righthere';" class="list"/>
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
											if(empty($_REQUEST['category_num']))
											{
												echo '<script type="text/javascript">alert("Please enter a Marina Number");</script>';
											}
											else 
											{
											$category_num=$_POST['category_num'];
											$query = "SELECT * FROM SERVICE_CATEGORY
											WHERE CATEGORY_NUM= '$category_num'";

												if($r=mysql_query($query))
												{
													$num_rows =mysql_num_rows($r);
													if($num_rows==0&&!empty($_REQUEST['category_num']))
													{
														$message = "Invalid Category number";
														echo "<script type='text/javascript'>alert('$message');</script>";
													}
													else
													{
															echo "<a name='righthere'></a>";
															echo "<center>";
																echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																	<tr bgcolor='black'>
																		<th>Category Description</th>
																	</tr>";
																		$row=mysql_fetch_array($r);
																		echo"<p>The data for Category number ".$row['CATEGORY_NUM']." is displayed below.</p>";
																		echo"<tr>";
																		echo"<td>" .$row['CATEGORY_DESCRIPTION'] ."</td>";
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
											$query = "SELECT * FROM SERVICE_CATEGORY";			
											$r=mysql_query($query);
												echo "<a name='go'></a>";
												echo "<center>";
												echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
													<tr bgcolor='black'>
														<th>Category Number</th>
														<th>Description</th>
													</tr>";
												echo"<p>All of the information for every Service Category is displayed below.</p>";
													while($row=mysql_fetch_array($r))
													{
														echo"<tr>";
														echo"<td>" .$row['CATEGORY_NUM'] ."</td>";
														echo"<td>" .$row['CATEGORY_DESCRIPTION'] ."</td>";
														echo"</tr>";
													}
												echo "</table>";
											echo"</center>";
											echo"<br /><br />";
										}
									?>
									
									<br />				
									<input name="list_all" type="submit" value="" onclick="window.location.hash='go';" class="list_all"/>
									<input name="reset" type="submit" value="" class="clear"/>
									<hr style="border-top: dotted 1px;" />
								</form>
							</td>
						</tr>
						<tr>
							<td align="left">
								<form method="post">
									<p style="font-size:15px;">To look up all requests based on thier service category, enter the Category Number below.</p>
									Category Number: <input name="category_num2" type="text"/>
									<input name="list_requests" type="submit" onclick="window.location.hash='gohere';" value="" class="list"/>
									<br /><br />

									<?php
										if(isset($_POST['list_requests']))
										{
											if(empty($_REQUEST['category_num2']))
											{
												echo '<script type="text/javascript">alert("Please enter a Category Number");</script>';
											}
											else 
											{
												$category_num2=$_POST['category_num2'];
												$query = "SELECT * FROM SERVICE_CATEGORY
												WHERE CATEGORY_NUM= '$category_num2'";
												if($r=mysql_query($query))
												{
													$num_rows =mysql_num_rows($r);
													if($num_rows==0&&!empty($_REQUEST['category_num2']))
													{
														$message = "Invalid Category number";
														echo "<script type='text/javascript'>alert('$message');</script>";
													}
													else	
													{
														$query2 = "SELECT MARINA.NAME, MARINA_SLIP.SLIP_NUM, BOAT_NAME, OWNER.FIRST_NAME, LAST_NAME, 
														SERVICE_REQUEST.CATEGORY_NUM, DESCRIPTION, STATUS, EST_HOURS, SPENT_HOURS, NEXT_SERVICE_DATE 
														FROM MARINA, MARINA_SLIP, OWNER, SERVICE_REQUEST
														WHERE SERVICE_REQUEST.CATEGORY_NUM= '$category_num2' AND MARINA.MARINA_NUM = MARINA_SLIP.MARINA_NUM 
														AND MARINA_SLIP.OWNER_NUM = OWNER.OWNER_NUM AND MARINA_SLIP.SLIP_ID = SERVICE_REQUEST.SLIP_ID";
														$query3 = "SELECT * FROM SERVICE_CATEGORY WHERE CATEGORY_NUM = '$category_num2'";
														$r3=mysql_query($query3);
														if($r2=mysql_query($query2))
														{
																	echo "<a name='gohere'></a>";
																	echo "<center>";
																		echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																			<tr bgcolor='black'>
																			<th>Boat Name</th>
																			<th>Owner</th>
																			<th>Location</th>
																			<th>Slip Number</th>
																			<th>Description</th>
																			<th>Status</th>
																			<th>Estimated Hours</th>
																			<th>Spent Hours</th>
																			<th>Next Service Date</th>
																			</tr>";
																				$row2=mysql_fetch_array($r3);
																				echo"<p>The boats that are being serviced for ".$row2['CATEGORY_DESCRIPTION']." <br/>are displayed below.</p>";
																				while($row=mysql_fetch_array($r2))
																				{
																					echo"<tr>";
																					echo"<td>" .$row['BOAT_NAME'] ."</td>";
																					echo"<td>" .$row['FIRST_NAME'] . " " .$row['LAST_NAME'] ."</td>";
																					echo"<td>" .$row['NAME'] ."</td>";
																					echo"<td>" .$row['SLIP_NUM'] ."</td>";
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
									?>

									<?php
										if (isset($_POST['list_all_requests']))
										{
											$query = "SELECT MARINA.NAME, MARINA_SLIP.SLIP_NUM, BOAT_NAME, OWNER.FIRST_NAME, LAST_NAME, 
											SERVICE_REQUEST.CATEGORY_NUM, DESCRIPTION, STATUS, EST_HOURS, SPENT_HOURS, NEXT_SERVICE_DATE, SERVICE_CATEGORY.CATEGORY_DESCRIPTION
											FROM MARINA, MARINA_SLIP, OWNER, SERVICE_REQUEST, SERVICE_CATEGORY
											WHERE MARINA.MARINA_NUM = MARINA_SLIP.MARINA_NUM AND SERVICE_CATEGORY.CATEGORY_NUM = SERVICE_REQUEST.CATEGORY_NUM
											AND MARINA_SLIP.OWNER_NUM = OWNER.OWNER_NUM AND MARINA_SLIP.SLIP_ID = SERVICE_REQUEST.SLIP_ID";
											$r=mysql_query($query);	
												echo "<a name='here'></a>";
												echo "<center>";
												echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
													<tr bgcolor='black'>
													<th>Service Description</th>
													<th>Boat Name</th>
													<th>Owner</th>
													<th>Location</th>
													<th>Slip Number</th>
													<th>Description</th>
													<th>Status</th>
													<th>Estimated Hours</th>
													<th>Spent Hours</th>
													<th>Next Service Date</th>
													</tr>";
												echo "All boats that are being serviced are displayed below.</p>";
													while($row=mysql_fetch_array($r))
													{
														echo"<tr>";
														echo"<td>" .$row['CATEGORY_DESCRIPTION'] ."</td>";
														echo"<td>" .$row['BOAT_NAME'] ."</td>";
														echo"<td>" .$row['FIRST_NAME'] . " " .$row['LAST_NAME'] ."</td>";
														echo"<td>" .$row['NAME'] ."</td>";
														echo"<td>" .$row['SLIP_NUM'] ."</td>";
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
									<input name="list_all_requests" type="submit" onclick="window.location.hash='here';" value="" class="list_all"/>
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