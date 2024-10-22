<?php include("header.php"); ?>

	<body>

		<div class="app-wrap">
			
			<?php include("top_header.php"); ?>
			
			<div class="app-container">
				
				<?php include("menu.php"); ?>

				
				<div class="app-main">
					
					<header class="main-heading">
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-8">
									<div class="page-icon">
										<i class="icon-cogs"></i>
									</div>
									<div class="page-title">
										<h5>Chaos Engineering</h5>
										<h6 class="sub-heading">On-Premise Chaos Experiments</h6>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="right-actions">
										<span class="last-login"></span>
									</div>
								</div>
							</div>
						</div>
					</header>
					
					
					<form method="post" id="frm1">
					
					<div class="main-content">

						<div class="row gutters">
					
							<div class="col-sm-12">
								<div class="card">
									<div class="card-body">

										<div class="row gutters">											
											<div class="col-sm-12 col-12">
												<div class="form-group">
													<label for="inputReadOnly">Project</label>
													<input class="form-control" type="text" placeholder="Project" value="<?php echo $_SESSION['name']; ?>" readonly>
												</div>
											</div>											
										</div>
										
										<div class="row gutters">											
											<div class="col-sm-6 col-12">
												<div class="form-group">
													<label for="inputName">Chaos Name <font color="red"> * </font></label>
													<select class="form-control" name="chaos_name"  onchange="frm1.submit()">
														<?php
															if($_POST['chaos_name']=="CPU-Stressing")
															{
																echo "<option value='CPU-Stressing' selected>CPU Stressing</option>";
															}
															else
															{
																echo "<option value='CPU-Stressing'>CPU Stressing</option>";
															}
															
															if($_POST['chaos_name']=="Memory-Stressing")
															{
																echo "<option value='Memory-Stressing' selected>Memory Stressing</option>";
															}
															else
															{
																echo "<option value='Memory-Stressing'>Memory Stressing</option>";
															}

															/*if($_POST['chaos_name']=="Network-Delay")
															{
																echo "<option value='Network-Delay' selected>Network Delay</option>";
															}
															else
															{
																echo "<option value='Network-Delay'>Network Delay</option>";
															}*/
															
															if($_POST['chaos_name']=="Service-Endpoint-Failure")
															{
																echo "<option value='Service-Endpoint-Failure' selected>Service Endpoint Failure</option>";
															}
															else
															{
																echo "<option value='Service-Endpoint-Failure'>Service Endpoint Failure</option>";
															}
															
															/*if($_POST['chaos_name']=="Server-Breakdown")
															{
																echo "<option value='Server-Breakdown' selected>Server Breakdown</option>";
															}
															else
															{
																echo "<option value='Server-Breakdown'>Server Breakdown</option>";
															}
															
															if($_POST['chaos_name']=="Database-Failure")
															{
																echo "<option value='Database-Failure' selected>Database Failure</option>";
															}
															else
															{
																echo "<option value='Database-Failure'>Database Failure</option>";
															}*/
														?>														
													</select>
												</div>
											</div>
											
											<div class="col-sm-6 col-12">
												<div class="form-group">
													<?php
														if($_POST['chaos_name']=="CPU-Stressing" || $_POST['chaos_name']=="")
														{
															echo '
																<label for="inputName"> Experiment Duration <font color="red"> * </font></label>
																<select class="form-control" name="para_value">
																	<option value="60">60 Sec</option>
																	<option value="120">120 Sec</option>
																	<option value="180">180 Sec</option>
																	<option value="240">240 Sec</option>
																	<option value="300">300 Sec</option>																	
																</select>
															';
														}
														
														if($_POST['chaos_name']=="Service-Endpoint-Failure")
														{
															echo '
																<label for="inputName"> Service Name <font color="red"> * </font></label>
																<input type="text" class="form-control" placeholder="Enter Service Name" name="para_value" required>
															';
														}
														
														if($_POST['chaos_name']=="Memory-Stressing")
														{
															echo '
																<label for="inputName"> Payload Size <font color="red"> * </font></label>
																<select class="form-control" name="para_value">
																	<option value="1000">1000Mb</option>
																	<option value="2000">2000Mb</option>
																	<option value="3000">3000Mb</option>
																	<option value="4000">4000Mb</option>
																	<option value="5000">5000Mb</option>
																	<option value="6000">6000Mb</option>
																	<option value="7000">7000Mb</option>
																	<option value="8000">8000Mb</option>
																	<option value="9000">9000Mb</option>
																	<option value="10000">10000Mb</option>
																	
																	<option value="11000">11000Mb</option>
																	<option value="12000">12000Mb</option>
																	<option value="13000">13000Mb</option>
																	<option value="14000">14000Mb</option>
																	<option value="15000">15000Mb</option>
																	<option value="16000">16000Mb</option>
																	<option value="17000">17000Mb</option>
																	<option value="18000">18000Mb</option>
																	<option value="19000">19000Mb</option>
																	<option value="200000">200000Mb</option>
																</select>
															';
														}
													?>
													
													
												</div>
											</div>
										</div>
										
										<div class="row gutters">											
											<div class="col-sm-12">
												<div class="card">
													<div class="card-header">
														<div class="row">
															<div class="col-sm-6">Select Target Systems <font color="red"> * </font></div>
															<div class="col-sm-6" align="right"></div>
														</div>
													</div>
													<div class="card-body">
														<table id="scrollVertical" class="table table-striped table-bordered">
															<thead>
																<tr>
																	<th style="text-align:center">Select</th>
																	<th>System Name</th>
																</tr>
															</thead>
															<tbody>
																<?php
																	$data_row=mysqli_query($con,"select * from on_prem_config where project_id='".$_SESSION['id']."' and status='Active'");
																	
																	while($rw=mysqli_fetch_row($data_row))
																	{
																		$concatName=$rw[5]."@".$rw[2]." | ".$rw[4];
																		echo '
																		
																		<tr>
																			<td align="center">
																				<div class="custom-control custom-checkbox">
																					<input type="checkbox" class="custom-control-input" id="customCheck'.$rw[0].'" name="chk[]" value="'.$rw[0].'">
																					<label class="custom-control-label" for="customCheck'.$rw[0].'"></label>
																				</div>
																			</td>
																			<td>'.$concatName.'</td>
																		</tr>
																		';
																	}
																?>
																
																
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
										
										<hr />
										
										<div class="row gutters">											
											<div class="col-sm-6 col-12">
												<div class="form-group">
													<input type="submit" id="btn_reg" class="btn btn-primary my-1" name="reg" value="Confirm & Execute" <?php echo isset($_POST['reg']) ? 'disabled="true"' : ''; ?>>
												</div>
											</div>
											
											<div class="col-sm-6 col-12" align="right">
												<div class="form-group">
													<p style="font-size: 16px; font-weight:bold; padding-top:15px; color: #da1113; line-height: 100%; margin: 0; font-family: 'BalooBhaina', arial, sans-serif;visibility:hidden" id="demo"> <?php echo "Hold On..."; ?> </p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							

						</div>

					</div>
					
					</form>
					
				</div>
				
			</div>
			
			
			<footer class="main-footer fixed-btm">
				ChaosArmor © 
				<script>
                document.write(new Date().getFullYear())
              </script>
			</footer>
			
		</div>
		

		<?php include("scripts-forms.php"); ?>
	</body>
	
	
<script>

function pad(val) {
  valString = val + "";
  if(valString.length < 2) {
     return "0" + valString;
     } else {
     return valString;
     }
}

function start_chaos(sec_val)
{
	var totalSeconds = 0;

	var p=sec_val;
	totalSeconds=totalSeconds+p;

	var x = setInterval(function() {
	  totalSeconds--;
	  var remTime=pad(parseInt(totalSeconds/60)) + ":" + pad(totalSeconds%60);
	  document.getElementById("demo").innerHTML = "Chaos will run in : "+remTime;
	  document.getElementById("demo").style.visibility = "visible";
	  
	  if (totalSeconds <= 0) {
		clearInterval(x);
		document.getElementById("demo").innerHTML = "Executed";

		window.location.href="index.php";
	  }
	}, 1000);
}
</script>

</html>


<?php
	if(isset($_POST['reg']))
	{
		$secVal=mysqli_fetch_row(mysqli_query($con,"SELECT TIMESTAMPDIFF(SECOND, run_log_timestamp,now()) AS difference FROM chaos_run_log"));
		
		echo "<script>start_chaos(".$secVal[0].");</script>";
		
		$chaos_name = isset($_POST['chaos_name']) ? mysqli_real_escape_string($con,$_POST['chaos_name']) :  "";
		$para_value = isset($_POST['para_value']) ? mysqli_real_escape_string($con,$_POST['para_value']) :  "";
		
	if($chaos_name!="Network-Delay" ||  $chaos_name!="Server-Breakdown" || $chaos_name!="Database-Failure")
	{
		$exec_flag=0;
		
		foreach($_POST['chk'] as $item)
		{
			$target_name=$item;
			if(mysqli_query($con,"insert into chaos_log (project_id,chaos_name,env_name,target_name,username,rmk) values ('".$_SESSION['id']."','".$chaos_name."','On-Premise','".$target_name."','".$_SESSION['usr']."','".$para_value."')"))
			{
				$exec_flag=1;
			}
		}
		
		$env_ids=ltrim($env_ids,",");
		
		
		if($exec_flag)
		{
			echo "<script>alert('Data Processed Sucessfully!!!');</script>";
			echo '<script>window.location.href="index.php";</script>';
		}
		else
		{
			echo "<script>alert('Target Name should be Selected. Please check Configuration!!!');</script>";
			echo '<script>window.location.href="chaos_On-Premise.php";</script>';
		}
	}
	else
	{
		echo "<script>alert('We are working on this Chaos Actions!!!');</script>";
	}
	
	}
?>