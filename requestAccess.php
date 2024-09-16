<?php include("sitemaster.php"); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="ChaosArmor" />
	<link rel="icon" type="image/png" href="img/hsbc.png">
	
	<title>ChaosArmor - Request Access</title>

	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="fonts/icomoon/icomoon.css" />
	<link rel="stylesheet" href="css/main.min.css" />
	
	<link rel="stylesheet" href="vendor/datatables/dataTables.bs4.css" />
	<link rel="stylesheet" href="vendor/datatables/dataTables.bs4-custom.css" />

  <script type="text/javascript">
		function isIPKey(txt, evt) {
		  var charCode = (evt.which) ? evt.which : evt.keyCode;
		  if (charCode == 46) {
			if (txt.value.indexOf('.') === -1) {
			  return true;
			} else {
				if((txt.value.split(".").length - 1)<3)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		  } else {
			if (charCode > 31 &&
			  (charCode < 48 || charCode > 57))
			  return false;
		  }
		  return true;
		}
		
		function isNumberKey(txt, evt) {
		  var charCode = (evt.which) ? evt.which : evt.keyCode;
		  if (charCode == 46) {
			return false;
		  } else {
			if (charCode > 31 &&
			  (charCode < 48 || charCode > 57))
			  return false;
		  }
		  return true;
		}		
  </script>
</head>

	<body>

		<div class="app-wrap">
			<header class="app-header">
				<div class="container-fluid">
					<div class="row gutters">
						<div class="col-md-12 col-sm-6 col-4">
							<a href="index.php" class="logo">
								<img src="img/unify.png" />
							</a>
						</div>						
					</div>
				</div>
			</header>
			
			<div class="app-container">
			
				
			<form method="post">	
				<div class="app-main" style="margin-left:0px !important">
					
					<header class="main-heading">
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-8">
									<div class="page-icon">
										<i class="icon-center_focus_strong"></i>
									</div>
									<div class="page-title">
										<h5>Request Access</h5>
										<h6 class="sub-heading">Request for Project Onboarding</h6>
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
													<label for="inputName"> Project Name <font color="red"> * </font></label>
													<input type="text" class="form-control" placeholder="Project Title" name="project_title" required value="<?php echo $_POST['project_title']; ?>">
												</div>
											</div>
											
											<div class="col-sm-6 col-12">
												<div class="form-group">
													<label for="inputName"> Team Name <font color="red"> * </font></label>
													<input type="text" class="form-control" placeholder="Team Name" name="team_name" required value="<?php echo $_POST['team_name']; ?>">
												</div>
											</div>
										</div>
										
										<div class="row gutters">											
											<div class="col-sm-6 col-12">
												<div class="form-group">
													<label for="inputName"> GBGF <font color="red"> * </font></label>
													<input type="text" class="form-control" placeholder="GBGF Name" name="gbgf" required value="<?php echo $_POST['gbgf']; ?>">
												</div>
											</div>
											
											<div class="col-sm-6 col-12">
												<div class="form-group">
													<label for="inputName"> Service Line / Value Stream <font color="red"> * </font> </label>
													<input type="text" class="form-control" placeholder="Service Line / Value Stream" name="service_line" required value="<?php echo $_POST['service_line']; ?>">
												</div>
											</div>
										</div>
										
										<div class="row gutters">											
											<div class="col-sm-6 col-12">
												<div class="form-group">
													<label for="inputName"> EIM ID <font color="red"> * </font></label>
													<input type="text" class="form-control" placeholder="EIM Number" name="eim_id" required value="<?php echo $_POST['eim_id']; ?>"  onkeypress="return isNumberKey(this, event);">
												</div>
											</div>
											
											<div class="col-sm-6 col-12">
												<div class="form-group">
													<label for="inputName"> Team Admin PSID <font color="red"> * </font>&nbsp;<font color="#da1113"> (Only Single Admin Access is allowed for each Project) </font> </label>
													<input type="text" class="form-control" placeholder="Team Owner PSID" name="adm_psid" required value="<?php echo $_POST['adm_psid']; ?>"  onkeypress="return isNumberKey(this, event);">
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
																	$data_row=mysqli_query($con,"SELECT * FROM env_master where status='Active'");
																	
																	while($rw=mysqli_fetch_row($data_row))
																	{
																		echo '
																		
																		<tr>
																			<td align="center">
																				<div class="custom-control custom-checkbox">
																					<input type="checkbox" class="custom-control-input" id="customCheck'.$rw[0].'" name="chk[]" value="'.$rw[0].'">
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
													<input type="submit" id="btn_reg" class="btn btn-primary my-1" name="reg" value="Request Access">
												</div>
											</div>
											
											<div class="col-sm-6 col-12">
												<div class="form-group" align="right">
													<a href="index.php" class="btn btn-dark my-1">Back</a>
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
		

		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="vendor/unifyMenu/unifyMenu.js"></script>
		<script src="vendor/onoffcanvas/onoffcanvas.js"></script>
		<script src="js/moment.js"></script>

		
		<script src="vendor/datatables/dataTables.min.js"></script>
		<script src="vendor/datatables/dataTables.bootstrap.min.js"></script>

		<script src="vendor/datatables/custom/custom-datatables.js"></script>
		<script src="vendor/datatables/custom/fixedHeader.js"></script>

		<script src="js/common.js"></script>
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
		
		$project_title = isset($_POST['project_title']) ? mysqli_real_escape_string($con,$_POST['project_title']) :  "";
		$team_name = isset($_POST['team_name']) ? mysqli_real_escape_string($con,$_POST['team_name']) :  "";
		$adm_psid = isset($_POST['adm_psid']) ? mysqli_real_escape_string($con,$_POST['adm_psid']) :  "";
		
		$gbgf = isset($_POST['gbgf']) ? mysqli_real_escape_string($con,$_POST['gbgf']) :  "";
		$service_line = isset($_POST['service_line']) ? mysqli_real_escape_string($con,$_POST['service_line']) :  "";
		$eim_id = isset($_POST['eim_id']) ? mysqli_real_escape_string($con,$_POST['eim_id']) :  "";
		
		$countItems=mysqli_fetch_row(mysqli_query($con,"SELECT count(*) FROM project_info where name='".$project_title."' and team_name='".$team_name."' and project_owner='".$adm_psid."'"));
		
		if($env_ids!="")
		{
			if($countItems[0]=="0")
			{
				if(mysqli_query($con,"insert into project_info (name,team_name,project_owner,env_ids,eim_id,gbgf,service_line,api_token) values ('".$project_title."','".$team_name."','".$adm_psid."','".$env_ids."','".$eim_id."','".$gbgf."','".$service_line."',concat('ca_',SUBSTR(MD5(RAND()),1,47)))"))
				{
					echo "<script>alert('Request Processed Sucessfully!!!');</script>";
					echo '<script>window.location.href="index.php";</script>';
				}
			}
			else
			{
				echo "<script>alert('Team Record Already Exists!!!');</script>";
			}		
		}
		else
		{
			echo "<script>alert('Select Project Environments!!!');</script>";
		}		
	}
?>