<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Alexamara Marina Group Reporting - Marina Slip</title>
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
								<h1>Marina Slip Queries</h1>
								<hr style="border-top: dotted 1px;" />
							</td>
						</tr>


						<tr>
							<td align="left">
								<form method="post">
									<p style="font-size:15px;">To look up information about a Marina Slip, enter the Marina Slip ID below.</p>
									Slip ID: <input name="slip_id" type="text"/>
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
											if(empty($_REQUEST['slip_id']))
											{
												echo '<script type="text/javascript">alert("Please enter a Slip ID Number");</script>';
											}
											else 
											{
											$slip_id=$_POST['slip_id'];										
											$query = "SELECT * FROM MARINA_SLIP
											WHERE SLIP_ID= '$slip_id'";

												if($r=mysql_query($query))
												{
													$num_rows =mysql_num_rows($r);
													if($num_rows==0&&!empty($_REQUEST['slip_id']))
													{
														$message = "Invalid Slip ID number";
														echo "<script type='text/javascript'>alert('$message');</script>";
													}
													else
													{

															echo "<center>";
																echo "<table border = '5' cellpadding = '5' style='font-size:12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																	<tr bgcolor='black'>
																		<th>Marina Number</th>
																		<th>Slip Number</th>
																		<th>Length</th>
																		<th>Rental Fee</th>
																		<th>Boat Name</th>
																		<th>Boat Type</th>
																		<th>Owner Numberr</th>
																	</tr>";
																		$row=mysql_fetch_array($r);
																		echo"<p>The data for Slip ID ".$row['SLIP_ID']." is displayed below.</p>";
																		echo"<tr>";
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
												}
											}
										}
									?>

									<?php
										if (isset($_POST['list_all']))
										{
											$query = "SELECT * FROM MARINA_SLIP";			
											$r=mysql_query($query);		
												echo "<a name='here'></a>";
												echo "<center>";
												echo "<table border = '5' cellpadding = '5' style='font-size:12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
													<tr bgcolor='black'>
														<th>Slip ID</th>
														<th>Marina Number</th>
														<th>Slip Number</th>
														<th>Length</th>
														<th>Rental Fee</th>
														<th>Boat Name</th>
														<th>Boat Type</th>
														<th>Owner Numberr</th>
													</tr>";
												echo"<p>All of the information for every Marina Slip is displayed below.</p>";
													while($row=mysql_fetch_array($r))
													{
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
													}
												echo "</table>";
											echo"</center>";
											echo"<br /><br />";
										}
									?>
									
									<br />				
									<input name="list_all" type="submit" onclick="window.location.hash='here';" value="" class="list_all"/>
									<input name="reset" type="submit" value="" class="clear"/>
									<hr style="border-top: dotted 1px;" />
								</form>
							</td>
						</tr>
						<tr>
							<td align="left">
								<form method="post">
									<p style="font-size:15px;">To look up the information of boats based on boat length, select a symbol below and enter the boat length.</p>
									Boat length
									<select name="selected" width="200px">
										<option value="none">Choose One...</option>
										<option value="greater">></option>
										<option value="greater_equal">>=</option>
										<option value="less"><</option>
										<option value="less_equal"><=</option>
										<option value="equal">=</option>
										<option value="not_equal">!=</option>
									</select>
									<input name="length" maxlength="2" size="2" type="text"/>
									<input name="list_slips" type="submit" onclick="window.location.hash='goHere';" value="" class="list"/>
									<br /><br />

									<?php
										if(isset($_POST['list_slips']))
										{
											if(empty($_REQUEST['length']))
											{
												echo "<a name='goHere'></a>";
												echo '<script type="text/javascript">alert("Please enter a length");</script>';
											}
											else 
											{
												
												$length=$_POST['length'];
												$selected=$_POST['selected'];
												if($selected=='none')
												{
													echo "<a name='goHere'></a>";
													$message = "Please choose a symbol";
													echo "<script type='text/javascript'>alert('$message');</script>";
												}
												if(!is_numeric($length)&&$length!=NULL)
												{
													echo "<a name='goHere'></a>";
													$message = "You have entered an invalid length. Please enter a numeric value.";
													echo "<script type='text/javascript'>alert('$message');</script>";				
												}
												else	
												{
													switch($selected)
													{
														case 'greater':
															$query = "SELECT MARINA.NAME, OWNER.LAST_NAME, FIRST_NAME, MARINA_SLIP.SLIP_NUM, BOAT_NAME, BOAT_TYPE, RENTAL_FEE
															FROM MARINA, OWNER, MARINA_SLIP
															WHERE MARINA_SLIP.LENGTH > '$length'
															AND MARINA.MARINA_NUM = MARINA_SLIP.MARINA_NUM
															AND OWNER.OWNER_NUM = MARINA_SLIP.OWNER_NUM";
															if($r=mysql_query($query))
															{
																$num_rows = mysql_num_rows($r);
																if($num_rows==0)
																{
																	echo "<a name='goHere'></a>";
																	echo "<p style='text-align:center;'>There are no boats greater than ". $length ." feet.</p>";
																}
																else
																{	
																	echo "<a name='goHere'></a>";
																	echo "<center>";
																	echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																			<tr bgcolor='black'>
																			<th>Slip Number</th>
																			<th>Location</th>
																			<th>Boat Name</th>
																			<th>Boat Tyoe</th>
																			<th>Owner</th>
																			<th>Rental Fee</th>
																			</tr>";
																				echo"<p>The information for all boats greater than ". $length ." feet<br/>are displayed below.</p>";
																				while($row=mysql_fetch_array($r))
																				{
																					echo"<tr>";
																					echo"<td>" .$row['SLIP_NUM'] ."</td>";
																					echo"<td>" .$row['NAME'] ."</td>";
																					echo"<td>" .$row['BOAT_NAME'] ."</td>";
																					echo"<td>" .$row['BOAT_TYPE'] ."</td>";
																					echo"<td>" .$row['FIRST_NAME']. " ". $row['LAST_NAME']."</td>";
																					echo"<td>$" .number_format($row['RENTAL_FEE'],2) ."</td>";
																					echo"</tr>";
																				}
																		echo "</table>";
																	echo"</center>";
																	echo"<br /><br />";
																}
															}
															break;
															
														case 'greater_equal':
															$query = "SELECT MARINA.NAME, OWNER.LAST_NAME, FIRST_NAME, MARINA_SLIP.SLIP_NUM, BOAT_NAME, BOAT_TYPE, RENTAL_FEE
															FROM MARINA, OWNER, MARINA_SLIP
															WHERE MARINA_SLIP.LENGTH >= '$length'
															AND MARINA.MARINA_NUM = MARINA_SLIP.MARINA_NUM
															AND OWNER.OWNER_NUM = MARINA_SLIP.OWNER_NUM";
															if($r=mysql_query($query))
															{
																$num_rows = mysql_num_rows($r);
																if($num_rows==0)
																{
																	echo "<a name='goHere'></a>";
																	echo "<p style='text-align:center;'>There are no boats greater than or equal to ". $length ." feet.</p>";
																}
																else
																{	
																	echo "<a name='goHere'></a>";
																	echo "<center>";
																	echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																			<tr bgcolor='black'>
																			<th>Slip Number</th>
																			<th>Location</th>
																			<th>Boat Name</th>
																			<th>Boat Tyoe</th>
																			<th>Owner</th>
																			<th>Rental Fee</th>
																			</tr>";
																				echo"<p>The information for all boats greater than or equal to ". $length ." feet<br/>are displayed below.</p>";
																				while($row=mysql_fetch_array($r))
																				{
																					echo"<tr>";
																					echo"<td>" .$row['SLIP_NUM'] ."</td>";
																					echo"<td>" .$row['NAME'] ."</td>";
																					echo"<td>" .$row['BOAT_NAME'] ."</td>";
																					echo"<td>" .$row['BOAT_TYPE'] ."</td>";
																					echo"<td>" .$row['FIRST_NAME']. " ". $row['LAST_NAME']."</td>";
																					echo"<td>$" .number_format($row['RENTAL_FEE'],2) ."</td>";
																					echo"</tr>";
																				}
																		echo "</table>";
																	echo"</center>";
																	echo"<br /><br />";
																}
															}
															break;
															
														case 'less':
															$query = "SELECT MARINA.NAME, OWNER.LAST_NAME, FIRST_NAME, MARINA_SLIP.SLIP_NUM, BOAT_NAME, BOAT_TYPE, RENTAL_FEE
															FROM MARINA, OWNER, MARINA_SLIP
															WHERE MARINA_SLIP.LENGTH < '$length'
															AND MARINA.MARINA_NUM = MARINA_SLIP.MARINA_NUM
															AND OWNER.OWNER_NUM = MARINA_SLIP.OWNER_NUM";
															if($r=mysql_query($query))
															{
																$num_rows = mysql_num_rows($r);
																if($num_rows==0)
																{
																	echo "<a name='goHere'></a>";
																	echo "<p style='text-align:center;'>There are no boats less than ". $length ." feet.</p>";
																}
																else
																{	
																	echo "<a name='goHere'></a>";
																	echo "<center>";
																	echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																			<tr bgcolor='black'>
																			<th>Slip Number</th>
																			<th>Location</th>
																			<th>Boat Name</th>
																			<th>Boat Tyoe</th>
																			<th>Owner</th>
																			<th>Rental Fee</th>
																			</tr>";
																				echo"<p>The information for all boats less than ". $length ." feet<br/>are displayed below.</p>";
																				while($row=mysql_fetch_array($r))
																				{
																					echo"<tr>";
																					echo"<td>" .$row['SLIP_NUM'] ."</td>";
																					echo"<td>" .$row['NAME'] ."</td>";
																					echo"<td>" .$row['BOAT_NAME'] ."</td>";
																					echo"<td>" .$row['BOAT_TYPE'] ."</td>";
																					echo"<td>" .$row['FIRST_NAME']. " ". $row['LAST_NAME']."</td>";
																					echo"<td>$" .number_format($row['RENTAL_FEE'],2) ."</td>";
																					echo"</tr>";
																				}
																		echo "</table>";
																	echo"</center>";
																	echo"<br /><br />";
																}
															}
															break;
															
														case 'less_equal':
															$query = "SELECT MARINA.NAME, OWNER.LAST_NAME, FIRST_NAME, MARINA_SLIP.SLIP_NUM, BOAT_NAME, BOAT_TYPE, RENTAL_FEE
															FROM MARINA, OWNER, MARINA_SLIP
															WHERE MARINA_SLIP.LENGTH <= '$length'
															AND MARINA.MARINA_NUM = MARINA_SLIP.MARINA_NUM
															AND OWNER.OWNER_NUM = MARINA_SLIP.OWNER_NUM";
															if($r=mysql_query($query))
															{
																$num_rows = mysql_num_rows($r);
																if($num_rows==0)
																{
																	echo "<a name='goHere'></a>";
																	echo "<p style='text-align:center;'>There are no boats less than or equal to ". $length ." feet.</p>";
																}
																else
																{	
																	echo "<a name='goHere'></a>";
																	echo "<center>";
																	echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																			<tr bgcolor='black'>
																			<th>Slip Number</th>
																			<th>Location</th>
																			<th>Boat Name</th>
																			<th>Boat Tyoe</th>
																			<th>Owner</th>
																			<th>Rental Fee</th>
																			</tr>";
																				echo"<p>The information for all boats less thanor equal to ". $length ." feet<br/>are displayed below.</p>";
																				while($row=mysql_fetch_array($r))
																				{
																					echo"<tr>";
																					echo"<td>" .$row['SLIP_NUM'] ."</td>";
																					echo"<td>" .$row['NAME'] ."</td>";
																					echo"<td>" .$row['BOAT_NAME'] ."</td>";
																					echo"<td>" .$row['BOAT_TYPE'] ."</td>";
																					echo"<td>" .$row['FIRST_NAME']. " ". $row['LAST_NAME']."</td>";
																					echo"<td>$" .number_format($row['RENTAL_FEE'],2) ."</td>";
																					echo"</tr>";
																				}
																		echo "</table>";
																	echo"</center>";
																	echo"<br /><br />";
																}
															}
															break;
															
														case 'equal':
															$query = "SELECT MARINA.NAME, OWNER.LAST_NAME, FIRST_NAME, MARINA_SLIP.SLIP_NUM, BOAT_NAME, BOAT_TYPE, RENTAL_FEE
															FROM MARINA, OWNER, MARINA_SLIP
															WHERE MARINA_SLIP.LENGTH = '$length'
															AND MARINA.MARINA_NUM = MARINA_SLIP.MARINA_NUM
															AND OWNER.OWNER_NUM = MARINA_SLIP.OWNER_NUM";
															if($r=mysql_query($query))
															{
																$num_rows = mysql_num_rows($r);
																if($num_rows==0)
																{
																	echo "<p style='text-align:center;'>There are no boats equal to ". $length ." feet.</p>";
																}
																else
																{	
																	echo "<a name='goHere'></a>";
																	echo "<center>";
																	echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																			<tr bgcolor='black'>
																			<th>Slip Number</th>
																			<th>Location</th>
																			<th>Boat Name</th>
																			<th>Boat Tyoe</th>
																			<th>Owner</th>
																			<th>Rental Fee</th>
																			</tr>";
																				echo"<p>The information for all boats equal to ". $length ." feet<br/>are displayed below.</p>";
																				while($row=mysql_fetch_array($r))
																				{
																					echo"<tr>";
																					echo"<td>" .$row['SLIP_NUM'] ."</td>";
																					echo"<td>" .$row['NAME'] ."</td>";
																					echo"<td>" .$row['BOAT_NAME'] ."</td>";
																					echo"<td>" .$row['BOAT_TYPE'] ."</td>";
																					echo"<td>" .$row['FIRST_NAME']. " ". $row['LAST_NAME']."</td>";
																					echo"<td>$" .number_format($row['RENTAL_FEE'],2) ."</td>";
																					echo"</tr>";
																				}
																		echo "</table>";
																	echo"</center>";
																	echo"<br /><br />";
																}
															}
															break;
															
														case 'not_equal':
															$query = "SELECT MARINA.NAME, OWNER.LAST_NAME, FIRST_NAME, MARINA_SLIP.SLIP_NUM, BOAT_NAME, BOAT_TYPE, RENTAL_FEE
															FROM MARINA, OWNER, MARINA_SLIP
															WHERE MARINA_SLIP.LENGTH <> '$length'
															AND MARINA.MARINA_NUM = MARINA_SLIP.MARINA_NUM
															AND OWNER.OWNER_NUM = MARINA_SLIP.OWNER_NUM";
															if($r=mysql_query($query))
															{
																$num_rows = mysql_num_rows($r);
																if($num_rows==0)
																{
																	echo "<p style='text-align:center;'>There are no boats not equal to ". $length ." feet.</p>";
																}
																else
																{	
																	echo "<a name='goHere'></a>";
																	echo "<center>";
																	echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																			<tr bgcolor='black'>
																			<th>Slip Number</th>
																			<th>Location</th>
																			<th>Boat Name</th>
																			<th>Boat Tyoe</th>
																			<th>Owner</th>
																			<th>Rental Fee</th>
																			</tr>";
																				echo"<p>The information for all boats not equal to ". $length ." feet<br/>are displayed below.</p>";
																				while($row=mysql_fetch_array($r))
																				{
																					echo"<tr>";
																					echo"<td>" .$row['SLIP_NUM'] ."</td>";
																					echo"<td>" .$row['NAME'] ."</td>";
																					echo"<td>" .$row['BOAT_NAME'] ."</td>";
																					echo"<td>" .$row['BOAT_TYPE'] ."</td>";
																					echo"<td>" .$row['FIRST_NAME']. " ". $row['LAST_NAME']."</td>";
																					echo"<td>$" .number_format($row['RENTAL_FEE'],2) ."</td>";
																					echo"</tr>";
																				}
																		echo "</table>";
																	echo"</center>";
																	echo"<br /><br />";
																}
															}
															break;
													}
												}
											}
										}
									?>
									
									<br />				
									<input name="reset" type="submit" value="" class="clear"/>
									<hr style="border-top: dotted 1px;" />
								</form>
							</td>
						</tr>
						<tr>
							<td align="left">
								<form method="post">
									<p style="font-size:15px;">To look up the information of boats based on if a boat is between two lengths, enter the boat lengths below.</p>
									Boat length is between
									<input name="length" maxlength="2" size="2" type="text"/>
									ft and
									<input name="length2" maxlength="2" size="2" type="text"/>
									ft
									<input name="list_slips2" type="submit" onclick="window.location.hash='goHere2';" value="" class="list"/>
									<br /><br />

									<?php
										if(isset($_POST['list_slips2']))
										{
											if(empty($_REQUEST['length'])||empty($_REQUEST['length2']))
											{
												echo "<a name='goHere2'></a>";
												echo '<script type="text/javascript">alert("Please make sure you fill in both length fields");</script>';
											}
											else 
											{
												$length=$_POST['length'];
												$length2=$_POST['length2'];
												if((!is_numeric($length)&&$length!=NULL)||(!is_numeric($length2)&&$length2!=NULL))
												{
													echo "<a name='goHere2'></a>";
													$message = "You have entered an invalid length. Please enter a numeric value.";
													echo "<script type='text/javascript'>alert('$message');</script>";
												}
												else	
												{
													$query = "SELECT MARINA.NAME, OWNER.LAST_NAME, FIRST_NAME, MARINA_SLIP.SLIP_NUM, BOAT_NAME, BOAT_TYPE, RENTAL_FEE
													FROM MARINA, OWNER, MARINA_SLIP
													WHERE MARINA_SLIP.LENGTH BETWEEN $length AND $length2
													AND MARINA.MARINA_NUM = MARINA_SLIP.MARINA_NUM
													AND OWNER.OWNER_NUM = MARINA_SLIP.OWNER_NUM";
													if($r=mysql_query($query))
													{
														$num_rows = mysql_num_rows($r);
														if($num_rows==0)
														{
															echo "<a name='goHere2'></a>";
															echo "<p style='text-align:center;'>There are no boats between ". $length ." and " . $length2 . " feet.</p>";
														}
														else
														{	
															echo "<a name='goHere2'></a>";
															echo "<center>";
															echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																	<tr bgcolor='black'>
																	<th>Slip Number</th>
																	<th>Location</th>
																	<th>Boat Name</th>
																	<th>Boat Tyoe</th>
																	<th>Owner</th>
																	<th>Rental Fee</th>
																	</tr>";
																		echo"<p>The information for all boats between ". $length ." and " . $length2 . " feet<br/>are displayed below.</p>";
																		while($row=mysql_fetch_array($r))
																		{
																			echo"<tr>";
																			echo"<td>" .$row['SLIP_NUM'] ."</td>";
																			echo"<td>" .$row['NAME'] ."</td>";
																			echo"<td>" .$row['BOAT_NAME'] ."</td>";
																			echo"<td>" .$row['BOAT_TYPE'] ."</td>";
																			echo"<td>" .$row['FIRST_NAME']. " ". $row['LAST_NAME']."</td>";
																			echo"<td>$" .number_format($row['RENTAL_FEE'],2) ."</td>";
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