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
                                            <h4 class="nk-block-title">Execution Report</h4>
                                            <div class="nk-block-des">
                                                <p>Project Team Execution Report (Experiment Wise)</p>
                                            </div>
                                        </div>
                                    </div>
                                    
									
									<div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="card-head">
                                                <h5 class="card-title">Report Information</h5>
                                            </div>
                                            <form method="post">
                                                <div class="row g-4">
                                                    
													<div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="pay-amount-1">Select Team Name <font color="red">*</font></label>
                                                            <div class="form-control-wrap">
                                                                <select class="form-select js-select2" data-search="on" name="team">
																	<?php
																		$data_city=mysqli_query($con,"select id,name,team_name from project_info where (status!='Requested' and status!='Cancelled')");
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
													
													
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <input type="submit" class="btn btn-lg btn-primary" name="searchResults" value="Search Results">
                                                        </div>
                                                    </div>
                                                </div>
												
                                            </form>
                                        </div>
                                    </div>
									
								<?php
									if(isset($_POST['searchResults']))
									{
								?>
									
									
									<div class="card card-bordered card-preview">
                                        <div class="card-inner">
                                            <table class="datatable-init-export wrap table table-bordered" data-export-title="Export">
                                                <thead>
                                                    <tr>
                                                        <th>Experiment Name</th>
														<th>Environments</th>
														<th>Target Name</th>
														<th>Service Name</th>
														<th>Run Count</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
													<?php
														$data_row=mysqli_query($con,"SELECT chaos_name,env_name,

CASE
    WHEN env_name='GCP-GKE' THEN (SELECT concat(cluster,' | ',namespace) FROM gcp_gke_config where id=chaos_log.target_name)
    WHEN env_name='GCP-VM' THEN (SELECT concat(mgmt_vm_name,' | ',mgmt_vm_type) FROM gcp_vm_config where id=chaos_log.target_name)
	WHEN env_name='IKP' THEN (SELECT concat(cluster,' | ',namespace) FROM ikp_config where id=chaos_log.target_name)
	WHEN env_name='On-Premise' THEN (SELECT concat(mgmt_vm_name,' | ',mgmt_vm_type) FROM on_prem_config where id=chaos_log.target_name)
END as 'target',rmk,count(*) as 'count'

 FROM chaos_log
where project_id='".$_POST['team']."' 
group by chaos_name
order by env_name,id");
														while($rw=mysqli_fetch_row($data_row))
														{
															$arr=explode('|',$rw[3]);
															
															if(is_numeric($arr[0]))
															{
																$arr[0]="";
															}
															
															echo '
																<tr>
																	<td>'.$rw[0].'</td>
																	<td>'.$rw[1].'</td>
																	<td>'.$rw[2].'</td>
																	<td>'.$arr[0].'</td>
																	<td>'.$rw[4].'</td>																	
																</tr>
																';																
														}
													?>
													
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- .card-preview -->
									
								<?php
									}
								?>	
									
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