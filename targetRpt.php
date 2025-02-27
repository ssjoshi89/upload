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
                                                <p>Project Team Execution Report (Target Wise)</p>
                                            </div>
                                        </div>
                                    </div>
                                    
									
									<div class="card card-bordered card-preview">
                                        <div class="card-inner">
                                            <table class="datatable-init-export wrap table table-bordered" data-export-title="Export">
                                                <thead>
                                                    <tr>
                                                        <th>Project Name</th>
														<th>SPOC</th>
														<th>Environments</th>
														<th>Target Name</th>														
														<th>Run Count</th>
														<th>Total Targets</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
													<?php
														$serviceCount=0;
														
														$data_project=mysqli_query($con,"SELECT distinct project_id,name,project_owner FROM chaos_log join project_info on project_info.id=chaos_log.project_id");
														while($rw_prj=mysqli_fetch_row($data_project))
														{
															mysqli_next_result($con);		
															$serviceCount=0;
															$data_row=mysqli_query($con,"SELECT env_name,
															CASE
																WHEN env_name='GCP-GKE' THEN (SELECT concat(cluster,' | ',namespace) FROM gcp_gke_config where id=chaos_log.target_name)
																WHEN env_name='GCP-VM' THEN (SELECT concat(mgmt_vm_name,' | ',mgmt_vm_type) FROM gcp_vm_config where id=chaos_log.target_name)
																WHEN env_name='IKP' THEN (SELECT concat(cluster,' | ',namespace) FROM ikp_config where id=chaos_log.target_name)
																WHEN env_name='On-Premise' THEN (SELECT concat(mgmt_vm_name,' | ',mgmt_vm_type) FROM on_prem_config where id=chaos_log.target_name)
															END as 'target' ,count(*) as 'count' FROM chaos_log
															where project_id='".$rw_prj[0]."' group by target order by env_name,id");
															
															while($rw=mysqli_fetch_row($data_row))
															{																																
																if($rw[0]!="")
																{
																	$serviceCount=$serviceCount+1;
																}
															}
															
															$data_row=mysqli_query($con,"SELECT env_name,
															CASE
																WHEN env_name='GCP-GKE' THEN (SELECT concat(cluster,' | ',namespace) FROM gcp_gke_config where id=chaos_log.target_name)
																WHEN env_name='GCP-VM' THEN (SELECT concat(mgmt_vm_name,' | ',mgmt_vm_type) FROM gcp_vm_config where id=chaos_log.target_name)
																WHEN env_name='IKP' THEN (SELECT concat(cluster,' | ',namespace) FROM ikp_config where id=chaos_log.target_name)
																WHEN env_name='On-Premise' THEN (SELECT concat(mgmt_vm_name,' | ',mgmt_vm_type) FROM on_prem_config where id=chaos_log.target_name)
															END as 'target' ,count(*) as 'count' FROM chaos_log
															where project_id='".$rw_prj[0]."' group by target order by env_name,id");
															
															while($rw=mysqli_fetch_row($data_row))
															{																																
																if($rw[0]!="")
																{
																	echo '<tr><td>'.$rw_prj[1].'</td><td>'.$rw_prj[2].'</td><td>'.$rw[0].'</td><td>'.$rw[1].'</td><td>'.$rw[2].'</td><td>'.$serviceCount.'</td></tr>';
																}
															}
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