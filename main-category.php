<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Alexamara Marina Group Maintenance - Service Category</title>
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
								<h1>Service Category</h1>
								<hr style="border-top: dotted 1px;" />
							</td>
						</tr>


						<tr>
							<td align="left">
								<form method="post">
									Enter Category Number Here: <input name="category_num" type="text"/>
									<input name="retrieve" type="submit" value="" class="retrieve" src="../buttons/retrieve.JPG"/>
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
											if(empty($_REQUEST['category_num']))
											{
												echo '<script type="text/javascript">alert("Please enter a Category Number");</script>';
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
														$row=mysql_fetch_array($r);
														$num=$row['CATEGORY_NUM'];
														$description=$row['CATEGORY_DESCRIPTION'];
														echo "<p>The data for Category Number ".$num." is displayed below</p>";
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
												$description=$_POST['description'];
												$viewquery= "SELECT * FROM SERVICE_CATEGORY WHERE CATEGORY_NUM = '$num'";

												if($r=mysql_query($viewquery))
												{
														echo "<center>";
															echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																<tr bgcolor='black'>
																	<th>Category Number</th>
																	<th>Category Description</th>
																</tr>";
																	$row=mysql_fetch_array($r);
																	echo"<p>Deletion successful. <br />The data displayed below has been deleted.</p>";
																	echo"<tr>";
																	echo"<td>" .$row['CATEGORY_NUM'] ."</td>";
																	echo"<td>" .$row['CATEGORY_DESCRIPTION'] ."</td>";
																echo"</tr>";
															echo "</table>";
														echo"</center>";
														echo"<br /><br />";
												}
												$query = mysql_query("DELETE FROM SERVICE_CATEGORY WHERE CATEGORY_NUM = '$num'");
												$num=NULL;
												$description=NULL;
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
												$description=$_POST['description'];
												
												if($description==NULL)
												{
													$message = "You have not filled out all required infomation";
													echo "<script type='text/javascript'>alert('$message');</script>";
													echo "<p>Modify the data for Category Number ".$num." below</p>";
												}
												
												else
												{
													$query = mysql_query("UPDATE SERVICE_CATEGORY SET CATEGORY_DESCRIPTION ='$description' WHERE CATEGORY_NUM='$num'");
													$viewquery= "SELECT * FROM SERVICE_CATEGORY WHERE CATEGORY_NUM = '$num'";

													if($r=mysql_query($viewquery))
													{

															echo "<center>";
																echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																	<tr bgcolor='black'>
																		<th>Category Number</th>
																		<th>Category Description</th>
																	</tr>";

																		$row=mysql_fetch_array($r);
																		echo"<p>Modification successful. <br />The modified data for Category number ".$row['CATEGORY_NUM']." is displayed below.</p>";
																		echo"<tr>";
																		echo"<td>" .$row['CATEGORY_NUM'] ."</td>";
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

										if(isset($_POST['insert']))
										{
											if(!empty($_REQUEST['num']))
											{
												$message = "Data needs to be cleared before inserting a new entry";
												echo "<script type='text/javascript'>alert('$message');</script>";
	
											}
											else
											{
													$myquery = mysql_query("SELECT MAX(CATEGORY_NUM) FROM SERVICE_CATEGORY");
													$myrow = mysql_fetch_assoc($myquery);	
													$new_num = $myrow['MAX(CATEGORY_NUM)'];
													$new_num = $new_num + 1;
													$description=$_POST['description'];
													
													if($description==NULL)
													{
														$message = "You have not filled out all required infomation";
														echo "<script type='text/javascript'>alert('$message');</script>";
													}
													else
													{
														$query= mysql_query("INSERT INTO SERVICE_CATEGORY VALUES ('$new_num','$description')");
														$viewquery= "SELECT * FROM SERVICE_CATEGORY WHERE CATEGORY_NUM = '$new_num'";

														if($r=mysql_query($viewquery))
														{
															echo "<center>";
																echo "<table border = '5' cellpadding = '5' style='font-size: 12px; border-color: white; border-style: outset; padding: 5px; text-align:center'>
																	<tr bgcolor='black'>
																		<th>Category Number</th>
																		<th>Category Description</th>
																	</tr>";
																		$row=mysql_fetch_array($r);
																								

																		echo"<p>Insertion successful. <br />The new data for Category number ".$row['CATEGORY_NUM']." is displayed below.</p>";
																		echo"<tr>";
																		echo"<td>" .$row['CATEGORY_NUM'] ."</td>";
																		echo"<td>" .$row['CATEGORY_DESCRIPTION'] ."</td>";
																	echo"</tr>";
																echo "</table>";
															echo"</center>";
															echo"<br /><br />";
															$num=NULL;
															$description=NULL;
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
									Category Description: <input name="description" type="text" size="50" value="<?php echo $description; ?>"/><br /><br />
									<input name="num" type="hidden" value="<?php echo $num; ?>"/>									
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