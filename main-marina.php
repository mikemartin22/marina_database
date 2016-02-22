<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Alexamara Marina Group Maintenance - Marina</title>
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
								<h1>Marina</h1>
								<hr style="border-top: dotted 1px;" />
							</td>
						</tr>


						<tr>
							<td align="left">
								<form method="post">
									Enter Marina Number Here: <input name="marina_num" type="text"/>
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
														$row=mysql_fetch_array($r);
														$num=$row['MARINA_NUM'];
														$name=$row['NAME'];
														$address=$row['ADDRESS'];
														$city=$row['CITY'];
														$state=$row['STATE'];
														$zip=$row['ZIP'];
														echo "<p>The data for Marina Number ".$num." is displayed below</p>";
													}
												}
											}
										}
									?>

									<?php
										if (isset($_POST['delete']))
										{
											if(empty($_REQUEST['num']))
											{
												$message = "You have not retrieved any data yet";
												echo "<script type='text/javascript'>alert('$message');</script>";		
											}
											else
											{
												$num=$_POST['num'];
												$name=$_POST['name'];
												$address=$_POST['address'];
												$city=$_POST['city'];
												$state=$_POST['state'];
												$zip=$_POST['zip'];
												$viewquery= "SELECT * FROM MARINA WHERE MARINA_NUM = '$num'";

												if($r=mysql_query($viewquery))
												{
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
																	$row=mysql_fetch_array($r);
																	echo"<p>Deletion successful. <br />The data displayed below has been deleted.</p>";
																	echo"<tr>";
																	echo"<td>" .$row['MARINA_NUM'] ."</td>";
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
												$query = mysql_query("DELETE FROM MARINA WHERE MARINA_NUM = '$num'");
												$num=NULL;
												$name=NULL;
												$address=NULL;
												$city=NULL;
												$state=NULL;
												$zip=NULL;
											}

										}
									?>

									<?php
										if(isset($_POST['modify']))
										{
											if(empty($_REQUEST['num']))
											{
												$message = "You have not retrieved any data yet";
												echo "<script type='text/javascript'>alert('$message');</script>";		
											}
											
											else
											{
												$num=$_POST['num'];
												$name=$_POST['name'];
												$address=$_POST['address'];
												$city=$_POST['city'];
												$state=$_POST['state'];
												$zip=$_POST['zip'];
												$error = 0;

												if($name==NULL||$address==NULL||$address==NULL||$city==NULL||$state==NULL||$zip==NULL)
												{
													$message = "You have not filled out all required infomation";
													echo "<script type='text/javascript'>alert('$message');</script>";
													$error++;
												}
												
												if(!is_numeric($zip)&&$zip!=NULL)
												{
													$message = "You have entered an invalid zip code. Please enter a numeric value.";
													echo "<script type='text/javascript'>alert('$message');</script>";	
													$error++;					
												}

												$state_length = strlen($state);

												if(($state_length != 2 || is_numeric($state))&&$state!=NULL)
												{
													$message = "You have entered an invalid state. Please enter a two letter representation of the state.";
													echo "<script type='text/javascript'>alert('$message');</script>";
													$error++;													
												}
												
												if ($error != 0)
												{
													echo "<p>The data for Marina Number ".$num." is displayed below</p>";
												}
												
												elseif($error==0)
												{
													$new_state = strtoupper($state);
													
													$query = mysql_query("UPDATE MARINA SET NAME ='$name', ADDRESS ='$address', CITY ='$city', STATE ='$new_state', ZIP ='$zip' WHERE MARINA_NUM='$num'");
													$viewquery= "SELECT * FROM MARINA WHERE MARINA_NUM = '$num'";

													if($r=mysql_query($viewquery))
													{

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
																		$row=mysql_fetch_array($r);
																		echo"<p>Modification successful. <br />The modified data for marina number ".$row['MARINA_NUM']." is displayed below.</p>";
																		echo"<tr>";
																		echo"<td>" .$row['MARINA_NUM'] ."</td>";
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

										if(isset($_POST['insert']))
										{
											if(!empty($_REQUEST['num']))
											{
												$message = "Data needs to be cleared before inserting a new entry";
												echo "<script type='text/javascript'>alert('$message');</script>";
												$num=NULL;
												$name=NULL;
												$address=NULL;
												$city=NULL;
												$state=NULL;
												$zip=NULL;		
											}
											
											else
											{
												$name=$_POST['name'];
												$address=$_POST['address'];
												$city=$_POST['city'];
												$state=$_POST['state'];
												$zip=$_POST['zip'];
												$error=0;
												
												if($name==NULL||$address==NULL||$address==NULL||$city==NULL||$state==NULL||$zip==NULL)
												{
													$message = "You have not filled out all required infomation";
													echo "<script type='text/javascript'>alert('$message');</script>";
													$error++;
												}
												
												if(!is_numeric($zip)&&$zip!=NULL)
												{
													$message = "You have entered an invalid zip code. Please enter a numeric value.";
													echo "<script type='text/javascript'>alert('$message');</script>";	
													$error++;					
												}

												$state_length = strlen($state);

												if(($state_length != 2 || is_numeric($state))&&$state!=NULL)
												{
													$message = "You have entered an invalid state. Please enter a two letter representation of the state.";
													echo "<script type='text/javascript'>alert('$message');</script>";
													$error++;													
												}
												
												elseif($error==0)
												{
													$myquery = mysql_query("SELECT MAX(MARINA_NUM) FROM MARINA");
													$myrow = mysql_fetch_assoc($myquery);	
													$new_num = $myrow['MAX(MARINA_NUM)'];
													$new_num = $new_num + 1;

													$new_state = strtoupper($state);
													
													$query= mysql_query("INSERT INTO MARINA VALUES ('$new_num','$name','$address','$city','$new_state','$zip')");
													$viewquery= "SELECT * FROM MARINA WHERE MARINA_NUM = '$new_num'";

													if($r=mysql_query($viewquery))
													{
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
																	$row=mysql_fetch_array($r);


																	echo"<p>Insertion successful. <br />The new data for marina number ".$row['MARINA_NUM']." is displayed below.</p>";
																	echo"<tr>";
																	echo"<td>" .$row['MARINA_NUM'] ."</td>";
																	echo"<td>" .$row['NAME'] ."</td>";
																	echo"<td>" .$row['ADDRESS'] ."</td>";
																	echo"<td>" .$row['CITY'] ."</td>";
																	echo"<td>" .$row['STATE'] ."</td>";
																	echo"<td>" .$row['ZIP'] ."</td>";
																echo"</tr>";
															echo "</table>";
														echo"</center>";
														echo"<br /><br />";
														$num=NULL;
														$name=NULL;
														$address=NULL;
														$city=NULL;
														$state=NULL;
														$zip=NULL;	
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
									Marina Name: <input name="name" type="text" value="<?php echo $name; ?>"/><br /><br />
									Address: <input name="address" type="text" value="<?php echo $address; ?>"/><br /><br />
									City: <input name="city" type="text" value="<?php echo $city; ?>"/><br /><br />
									State: <input name="state" size="2" maxlength="2" type="text" value="<?php echo strtoupper($state); ?>"/><br /><br />
									Zip: <input name="zip" size="5" maxlength="5" type="text" value="<?php echo $zip; ?>"/><br /><br />
									<input name="num" type="hidden" value="<?php echo $num; ?>"/>									

									<input name="modify" type="submit" value="" class="modify" onclick="return confirm('Are you sure you want to modify?')"/>
									<input name="insert" type="submit" value="" class="insert"/>
									<input name="delete" type="submit" value="" class="delete" id="delete" onclick="return confirm('Are you sure you want to delete?')"/>
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