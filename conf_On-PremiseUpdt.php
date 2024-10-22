<?php include("header.php"); 
$record_id="";
foreach($_POST['rbt'] as $item)
{
	$record_id=$item;
	$data_onprem=mysqli_fetch_row(mysqli_query($con,"select * from on_prem_config where id='".$item."'"));	
}
?>

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
										<i class="icon-tools"></i>
									</div>
									<div class="page-title">
										<h5>Configurations</h5>
										<h6 class="sub-heading">On-Premise Environment Configurations</h6>
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
					
					
					<form method="post">
					
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
													<label for="inputName">Management Server Name <font color="red"> * </font></label>
													<input type="text" class="form-control" placeholder="Enter VM Name" name="mgmt_vm_name" value="<?php echo $data_onprem[2]; ?>" >
												</div>
											</div>
											
											<div class="col-sm-6 col-12">
												<div class="form-group">
													<label for="inputName">Management Server IP</label>
													<input type="text" class="form-control" placeholder="Enter VM IP" name="mgmt_vm_ip" value="<?php echo $data_onprem[3]; ?>" onkeypress="return isIPKey(this, event);">
												</div>
											</div>
										</div>
										
										
										<div class="row gutters">											
											<div class="col-sm-6 col-12">
												<div class="form-group">
													<label for="inputName">Username <font color="red"> * </font></label>
													<input type="text" class="form-control" placeholder="Enter VM Username" name="mgmt_user_name" value="<?php echo $data_onprem[5]; ?>">
												</div>
											</div>
											
											<div class="col-sm-6 col-12">
												<div class="form-group">
													<label for="inputName">Proxy URLs</label>
													<input type="text" class="form-control" placeholder="Enter Proxy URLs (If Any)" name="proxy_links" value="<?php echo $data_onprem[6]; ?>">
												</div>
											</div>
										</div>
										
										<div class="row gutters">											
											<div class="col-sm-6 col-12">
												<div class="form-group">
													<label for="inputName">Management Server OS <font color="red"> * </font></label>
													<select class="form-control" name="mgmt_type">
														<?php
															if($data_onprem[4]=="Linux")
															{
																echo "<option value='Linux' selected>Linux</option>";
															}
															else
															{
																echo "<option value='Linux'>Linux</option>";
															}
															
															/*if($data_onprem[4]=="Windows")
															{
																echo "<option value='Windows' selected>Windows</option>";
															}
															else
															{
																echo "<option value='Windows'>Windows</option>";
															}*/													
														?>														
													</select>
												</div>
											</div>
										</div>
										
										<hr />
										
										<input type="hidden" name="rec_id" value="<?php echo $record_id; ?>">
										<input type="submit" class="btn btn-primary my-1" name="reg" value="Confirm & Update">

										<hr />
										
										<div class="row gutters">											
											<div class="col-sm-12 col-12">
												<div class="form-group">
													<label for="inputName">Public Key to Configure</label>
													<textarea class="form-control" rows="10" name="public_key" value="" readonly></textarea>
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

</html>


<?php
	if(isset($_POST['reg']))
	{
		$mgmt_name = isset($_POST['mgmt_vm_name']) ? mysqli_real_escape_string($con,$_POST['mgmt_vm_name']) :  "";
		$mgmt_ip = isset($_POST['mgmt_vm_ip']) ? mysqli_real_escape_string($con,$_POST['mgmt_vm_ip']) :  "";
		$mgmt_username = isset($_POST['mgmt_user_name']) ? mysqli_real_escape_string($con,$_POST['mgmt_user_name']) :  "";
		$mgmt_proxy = isset($_POST['proxy_links']) ? mysqli_real_escape_string($con,$_POST['proxy_links']) :  "";
		$mgmt_type = isset($_POST['mgmt_type']) ? mysqli_real_escape_string($con,$_POST['mgmt_type']) :  "";
		
		if(mysqli_query($con,"update on_prem_config set mgmt_vm_name='".$mgmt_name."',mgmt_vm_ip='".$mgmt_ip."',usrname='".$mgmt_username."',proxy_links='".$mgmt_proxy."',mgmt_vm_type='".$mgmt_type."',connectivity_flag='Checking' where id='".$_POST['rec_id']."'"))
		{
			echo "<script>alert('Data Updated Sucessfully!!!');</script>";
		}
		
		echo '<script>window.location.href="list_On-Premise.php";</script>';
	}
?>