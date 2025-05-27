<?php include("header.php"); ?>

<body class="nk-body bg-lighter ">
    <div class="nk-app-root">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            
			<?php include("menu.php"); ?>
			
            <!-- content @s -->
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="components-preview mx-auto">
                                
                                <div class="nk-block nk-block-lg">
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title">API Onboardings</h4>
                                            <div class="nk-block-des">
                                                <p>Project Team API Approvals</p>
                                            </div>
                                        </div>
                                    </div>
                                    
									
									<div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="card-head">
                                                <h5 class="card-title">Team Information</h5>
                                            </div>
                                            <form method="post" id="frm">
                                                <div class="row g-4">
                                                    
													<div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="pay-amount-1">Select Team Name <font color="red">*</font></label>
                                                            <div class="form-control-wrap">
                                                                <select class="form-select js-select2" data-search="on" name="team" onchange="frm.submit()">
																	<option value="0">---SELECT---</option>
																	<?php
																		$data_city=mysqli_query($con,"select id,name,team_name from project_info where status!='Cancelled'");
																		while($rw=mysqli_fetch_row($data_city))
																		{
																			if($_POST['team']==$rw[0])
																			{
																				echo "<option value='".$rw[0]."' selected>".$rw[0]." | ".$rw[1]." - ".$rw[2]."</option>";
																			}
																			else
																			{
																				echo "<option value='".$rw[0]."'>".$rw[0]." | ".$rw[1]." - ".$rw[2]."</option>";
																			}
																		}														
																	?>														
																</select>
                                                            </div>
                                                        </div>
                                                    </div>
												
												<?php
													if(isset($_POST['team']) && $_POST['team']!="0")
													{
														$data_teamStatus=mysqli_fetch_row(mysqli_query($con,"select api_flag from project_info where id='".$_POST['team']."'"));
														if($data_teamStatus[0]=="Yes")
														{
															echo '
																<div class="col-12">
																	<div class="form-group">
																		<input type="submit" class="btn btn-lg btn-danger" name="reject" value="Disable">																		
																	</div>
																</div>															
															';
														}
														else if($data_teamStatus[0]=="No")
														{
															echo '
																<div class="col-12">
																	<div class="form-group">
																		<input type="submit" class="btn btn-lg btn-success" name="approve" value="Enable">
																	</div>
																</div>															
															';
														}														
													}
												?>
													
                                                </div>
												
                                            </form>
                                        </div>
                                    </div>
									
									
									<div class="card card-bordered card-preview">
                                        <div class="card-inner">
                                            <table class="datatable-init-export nowrap table" data-export-title="Export">
                                                <thead>
                                                    <tr>
                                                        <th>Team ID</th>
														<th>Project Title</th>
														<th>Team Name</th>
														<th>Environments</th>
														<th>Admin PSID</th>
														<th>EIM Name</th>
														<th>EIM ID</th>
														<th>GBGF</th>
														<th>Service Line</th>
														<th>API</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
													<?php
														$colorCodeStatus="black";
														
														$data_row=mysqli_query($con,"SELECT id,name,team_name,(SELECT group_concat(name) FROM env_master where find_in_set(id,project_info.env_ids)),project_owner,team_members,eim_name,eim_id,gbgf,service_line,priority_flag,api_flag,(SELECT name FROM chaos_admgrp where id=approver),status FROM project_info order by status desc,id");
														while($rw=mysqli_fetch_row($data_row))
														{
															if($rw[11]=="Yes")
															{
																$colorCodeStatus="green";
															}
															else if($rw[11]=="No")
															{
																$colorCodeStatus="red";
															}
															
															echo '
																<tr>
																	<td>'.$rw[0].'</td>
																	<td>'.$rw[1].'</td>
																	<td>'.$rw[2].'</td>
																	<td>'.$rw[3].'</td>
																	<td>'.$rw[4].'</td>
																	<td>'.$rw[6].'</td>
																	<td>'.$rw[7].'</td>
																	<td>'.$rw[8].'</td>
																	<td>'.$rw[9].'</td>
																	<td style="color:'.$colorCodeStatus.'">'.$rw[11].'</td>	
																</tr>
																';																
														}
													?>
													
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- .card-preview -->
									
                                </div> <!-- nk-block -->
                                
                            </div><!-- .components-preview wide-lg mx-auto -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
            
			<?php include("credits.php"); ?>
			
        </div>
        <!-- wrap @e -->
    </div>
    <!-- app-root @e -->
	
    <?php include("footer.php"); ?>
</body>

</html>

<?php
	if(isset($_POST['approve']) && $_POST['team']!="0")
	{
		if(mysqli_query($con,"update project_info set api_flag='Yes' where id='".$_POST['team']."'"))
		{
			echo "<script>alert('Data Updated Sucessfully!!!');</script>";
			echo '<script>window.location.href="apimgmt.php";</script>';
		}
	}
	
	if(isset($_POST['reject']) && $_POST['team']!="0")
	{
		if(mysqli_query($con,"update project_info set api_flag='No' where id='".$_POST['team']."'"))
		{
			echo "<script>alert('Data Updated Sucessfully!!!');</script>";
			echo '<script>window.location.href="apimgmt.php";</script>';
		}
	}
	
?>