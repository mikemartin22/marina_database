<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Alexamara Marina Group Reporting - Service Request</title>
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
								<h1>Service Request Queries</h1>
								<hr style="border-top: dotted 1px;" />
							</td>
						</tr>


						<tr>
							<td align="left">
								<form method="post">
									<p style="font-size:15px;">To look up information regarding a Service Request, enter the Service ID below.</p>
									Service ID: <input name="service_id" type="text"/>
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
															echo "<a name='righthere'></a>";
															echo "<center>";
																echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																	<tr bgcolor='black'>
																		<th>Slip ID</th>
																		<th>Category Number</th>
																		<th>Description</th>
																		<th>Status</th>
																		<th>Estimated Hours</th>
																		<th>Spent Hours</th>
																		<th>Next Service Date</th>
																	</tr>";
																		$row=mysql_fetch_array($r);
																		echo"<p>The data for Service ID ".$row['SERVICE_ID']." is displayed below.</p>";
																		echo"<tr>";
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
										if (isset($_POST['list_all']))
										{
											$query = "SELECT * FROM SERVICE_REQUEST";			
											$r=mysql_query($query);
												echo "<a name='go'></a>";
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
												echo"<p>All of the information for every Service Request is displayed below.</p>";
													while($row=mysql_fetch_array($r))
													{
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
									<p style="font-size:15px;">To view all open requests, click the button below.<br/><br/>
									<input name="list_open" type="submit" value="" onclick="window.location.hash='gorighthere';" class="list"/>
									<br /><br />

									<?php
										if(isset($_POST['list_open']))
										{
											$query = "SELECT * FROM SERVICE_REQUEST
											WHERE STATUS= 'open'";

											$r=mysql_query($query);
												echo "<a name='gorighthere'></a>";
												echo "<center>";
													echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
														<tr bgcolor='black'>
															<th>Service ID</th>
															<th>Slip ID</th>
															<th>Category Number</th>
															<th>Description</th>
															<th>Estimated Hours</th>
															<th>Spent Hours</th>
															<th>Next Service Date</th>
														</tr>";
														echo"<p>All open requests are displayed below.</p>";
															while($row=mysql_fetch_array($r))
															{
																echo"<tr>";
																echo"<td>" .$row['SERVICE_ID'] ."</td>";
																echo"<td>" .$row['SLIP_ID'] ."</td>";
																echo"<td>" .$row['CATEGORY_NUM'] ."</td>";
																echo"<td>" .$row['DESCRIPTION'] ."</td>";
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