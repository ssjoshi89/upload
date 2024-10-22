<?php include("header.php"); 
header("Refresh:10");
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
					
					<div class="main-content">
					
					<form method="post" action="conf_On-PremiseUpdt.php">

						<div class="row gutters">
							<div class="col-sm-12">
								<div class="card">
									<div class="card-header">
										<div class="row">
											<div class="col-sm-6">Available On-Premise Configurations</div>
											<div class="col-sm-6" align="right"><a href="conf_On-Premise.php" class="btn btn-primary btn-sm">Add New Configuration</a></div>
										</div>
									</div>
									<div class="card-body">
										<table id="scrollVertical" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th style="text-align:center">Select</th>
													<th>Server Name</th>
													<th>Server IP Address</th>
													<th>Server OS</th>
													<th>Username</th>
													<th>Connectivity</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$data_row=mysqli_query($con,"select * from on_prem_config where project_id='".$_SESSION['id']."' and status='Active'");
													
													while($rw=mysqli_fetch_row($data_row))
													{
														$colorCode="orange";
														if($rw[9]=="Checking")
														{
															$colorCode="orange";
														}
														elseif($rw[9]=="Connected")
														{
															$colorCode="green";
														}
														else
														{
															$colorCode="red";
														}
														
														$ids="blink_".$rw[0];
														
														echo '
														
														<tr>
															<td align="center">
																<div class="custom-control custom-radio custom-control-inline">
																	<input type="radio" id="customRadioInline'.$rw[0].'" name="rbt[]" value="'.$rw[0].'" class="custom-control-input" checked>
																	<label class="custom-control-label" for="customRadioInline'.$rw[0].'"></label>
																</div>
															</td>
															<td>'.$rw[2].'</td>
															<td>'.$rw[3].'</td>
															<td>'.$rw[4].'</td>
															<td>'.$rw[5].'</td>
															<td id="'.$ids.'" style="color:'.$colorCode.'">'.$rw[9].'</td>
															<td>'.$rw[8].'</td>
														</tr>
														
														
														';
													}
												?>
												
												
											</tbody>
										</table>
										
										<hr />

										<input type="submit" class="btn btn-dark my-1" name="updt" value="Update Configuration">

									</div>
								</div>
							</div>
						</div>
						
					</form>
						
					</div>
				
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
		
		<script type="text/javascript">
			var blink=document.querySelectorAll('[id^="blink_"]');
			
			setInterval(function() {
				
				blink.forEach(element => {
					if(element.innerHTML=="Checking")
					{
						element.style.opacity=(element.style.opacity == 0 ? 1 : 0);
					}
				});
				
			},500);
		</script>

	</body>

</html>