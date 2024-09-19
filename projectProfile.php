<?php include("header.php"); 
$proj_info=mysqli_fetch_row(mysqli_query($con,"select * from project_info where id='".$_SESSION['id']."'"));
?>

	<body>

		<div class="app-wrap">
			<?php include("top_header.php"); ?>
			
			<div class="app-container">
				
				<?php include("menu.php"); ?>
				
				
			<form method="post">	
				<div class="app-main">
					
					<header class="main-heading">
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-8">
									<div class="page-icon">
										<i class="icon-center_focus_strong"></i>
									</div>
									<div class="page-title">
										<h5>Project Profile</h5>
										<h6 class="sub-heading">Project Management Area</h6>
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
					
					
					<div class="main-content">

						<div class="row gutters">

							<div class="col-sm-12">
								<div class="card">
									<div class="card-body">
									
										<div class="row gutters">											
											<div class="col-sm-6 col-12">
												<div class="form-group">
													<label for="inputName"> Project Name </label>
													<input type="text" class="form-control" placeholder="Project Title" name="project_title" readonly value="<?php echo $proj_info[1]; ?>">
												</div>
											</div>
											
											<div class="col-sm-6 col-12">
												<div class="form-group">
													<label for="inputName"> Team Name </label>
													<input type="text" class="form-control" placeholder="Team Name" name="team_name" readonly value="<?php echo $proj_info[2]; ?>">
												</div>
											</div>
										</div>
										
										<div class="row gutters">											
											<div class="col-sm-6 col-12">
												<div class="form-group">
													<label for="inputName"> Team Admin PSID </label>
													<input type="text" class="form-control" placeholder="Team Owner PSID" name="adm_psid" readonly value="<?php echo $proj_info[5]; ?>">
												</div>
											</div>
										</div>
										
										<div class="row gutters">											
											<div class="col-sm-6 col-12">
												<div class="form-group">
													<label for="inputName">API Account Name</label>
													<input type="text" class="form-control" placeholder="API Token" name="api_token" readonly value="<?php echo $proj_info[15]; ?>">													
												</div>
											</div>

											<div class="col-sm-12 col-12">
												<div class="form-group">
													<label for="inputName">API Token</label>
													<input type="text" class="form-control" placeholder="API Token" name="api_token" readonly value="<?php echo $proj_info[7]; ?>">													
												</div>
											</div>											
										</div>

										<br />
										
										<div class="row gutters">
											<div class="col-sm-12">
												<div class="card">
													<div class="card-header">
														<div class="row">
															<div class="col-sm-6">Project Environments</div>
															<div class="col-sm-6" align="right"></div>
														</div>
													</div>
													<div class="card-body">
														<table id="scrollVertical" class="table table-striped table-bordered">
															<thead>
																<tr>
																	<th style="text-align:center">Select</th>
																	<th>Environment Name</th>
																</tr>
															</thead>
															<tbody>
																<?php
																	$proj_env_data=explode(',',$proj_info[4]);
																
																	$data_row=mysqli_query($con,"SELECT * FROM env_master where status='Active'");
																	
																	while($rw=mysqli_fetch_row($data_row))
																	{
																		$flag="";
																		foreach($proj_env_data as $rw_env_data)
																		{
																			if($rw_env_data==$rw[0])
																			{
																				$flag="checked";
																			}																			
																		}

																		echo '
																				<tr>
																					<td align="center">
																						<div class="custom-control custom-checkbox">
																							<input type="checkbox" class="custom-control-input" id="customCheck'.$rw[0].'" name="chk[]" value="'.$rw[0].'" '.$flag.'>
																							<label class="custom-control-label" for="customCheck'.$rw[0].'"></label>
																						</div>
																					</td>
																					<td>'.$rw[1].'</td>
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
													<input type="submit" id="btn_reg" class="btn btn-primary my-1" name="reg" value="Confirm & Update">
												</div>
											</div>
										</div>
										
										<hr />
										
										<div class="row gutters">											
											<div class="col-sm-6 col-12">
												<div class="form-group">
													<p align="justify"> Note : After updating Project Environments system will close current session. You will need to re-login. </p>
												</div>
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
			
			<footer class="main-footer fixed-btm">
				ChaosArmor © 
				<script>
                document.write(new Date().getFullYear())
              </script>
			</footer>
			
		</div>
		<?php include("scripts-forms.php"); ?>
	</body>

</html>



<?php
	if(isset($_POST['reg']))
	{
		$env_ids="";
		
		foreach($_POST['chk'] as $item)
		{
			$env_ids=$env_ids.",".$item;
		}
		
		$env_ids=ltrim($env_ids,",");
		
		if($env_ids!="")
		{
			if(mysqli_query($con,"update project_info set env_ids='".$env_ids."' where id='".$_SESSION['id']."'"))
			{
				echo "<script>alert('Data Updated Sucessfully!!!');</script>";
				echo '<script>window.location.href="signout.php";</script>';
			}
		
		}
		else
		{
			echo "<script>alert('Select Project Environments!!!');</script>";
		}		
	}
?>