<?php 
	include("header.php"); 
	$project_info=mysqli_fetch_row(mysqli_query($con,"select * from project_info where id='".$_SESSION['id']."'"));
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
										<i class="icon-swap"></i>
									</div>
									<div class="page-title">
										<h5>Chaos API</h5>
										<h6 class="sub-heading">Chaos API for Team</h6>
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
							
							<?php
								$env_data=mysqli_query($con,"SELECT * FROM env_master where find_in_set(id,'".$project_info[4]."')");
								while($rw_env=mysqli_fetch_row($env_data))
								{
									
							?>
								<div class="card">
									<div class="card-header"><?php echo "<b><font color='purple'>".$rw_env[1]."</font></b>"; ?></div>
									<div class="card-body">
										<div id="accordion" role="tablist">
											<?php
												$i=0;
												
												if($rw_env[1]=="AWS")
												{

												}

												if($rw_env[1]=="Azure")
												{
													
												}

												if($rw_env[1]=="GCP")
												{
													
												}
												
												
												if($rw_env[1]=="IKP")
												{
													$cluster_name=mysqli_fetch_row(mysqli_query($con,"select group_concat(cluster) from ikp_config where project_id='".$project_info[0]."' order by id;"));
													$cl_name=explode(',',$cluster_name[0]);
													$cluster_name=str_replace(",","/",$cluster_name[0]);
													
													$namespace_name=mysqli_fetch_row(mysqli_query($con,"select group_concat(namespace) from ikp_config where project_id='".$project_info[0]."' order by id;"));
													$nm_name=explode(',',$namespace_name[0]);
													$namespace_name=str_replace(",","/",$namespace_name[0]);
													
													$dep_name=mysqli_fetch_row(mysqli_query($con,"select group_concat(dep_name) from ikp_config where project_id='".$project_info[0]."' order by id;"));
													$dp_name=explode(',',$dep_name[0]);
													$dep_name=str_replace(",","/",$dep_name[0]);
													
													$srv_name=mysqli_fetch_row(mysqli_query($con,"select group_concat(srv_name) from ikp_config where project_id='".$project_info[0]."' order by id;"));
													$sv_name=explode(',',$srv_name[0]);
													$srv_name=str_replace(",","/",$srv_name[0]);
													
													$ingrs_name=mysqli_fetch_row(mysqli_query($con,"select group_concat(ingrs_name) from ikp_config where project_id='".$project_info[0]."' order by id;"));
													$igs_name=explode(',',$ingrs_name[0]);
													$ingrs_name=str_replace(",","/",$ingrs_name[0]);
													
													
													
													$choas_data=mysqli_query($con,"SELECT distinct chaos_name from chaos_log where env_name='".$rw_env[1]."'");
													while($rw_chaos=mysqli_fetch_row($choas_data))
													{
														if($rw_chaos[0]=="Kill_Running_POD")
														{
															if($i==0)
															{
																echo '
																	<div class="card mb-0">
																		<div class="card-header" role="tab" id="heading_'.$i.'">
																			<h5 class="mb-0">
																				<a data-toggle="collapse" href="#collapse'.$i.'" aria-expanded="true"
																					aria-controls="collapse'.$i.'"> 
																					<font size="2"> '.$rw_chaos[0].' </font>
																				</a>
																			</h5>
																		</div>
																		<div id="collapse'.$i.'" class="collapse show" role="tabpanel" aria-labelledby="heading_'.$i.'"
																			data-parent="#accordion">
																			<div class="card-body"> 
																				<font face="Courier New" size="2"> 
																				
																					{ <br />
																						&nbsp;&nbsp;  "apiKey":"<b>'.$project_info[7].'</b>", <br />
																						&nbsp;&nbsp;  "envName":"IKP", <br />
																						&nbsp;&nbsp;  "chaosName":"<b>'.$rw_chaos[0].'</b>", &nbsp;&nbsp; -- Chaos Experiment Name <br />
																						&nbsp;&nbsp;  "clusterName":"<b>'.$cluster_name.'</b>", &nbsp;&nbsp; -- Cluster Name <br />
																						&nbsp;&nbsp;  "namespaceName":"<b>'.$namespace_name.'</b>", &nbsp;&nbsp; -- Namespace Name <br />
																						&nbsp;&nbsp;  "serviceName":"<b>'.$dep_name.'</b>", &nbsp;&nbsp; -- Deployment Name <br />
																						&nbsp;&nbsp;  "payloadValue":"<b>Count_Value</b>", &nbsp;&nbsp; -- Count in Number <br />
																						&nbsp;&nbsp;  "run_by":"<b>'.$project_info[15].'</b>" <br />
																					}
																					
																					<br /><br />
																					
																					<p style="color:green"> curl -v -d "{/"apiKey/":/"<b>'.$project_info[7].'</b>/",/"envName/":/"IKP/",/"chaosName/":/"<b>'.$rw_chaos[0].'</b>/",/"clusterName/":/"<b>'.$cl_name[0].'</b>/",/"namespaceName/":/"<b>'.$nm_name[0].'</b>/",/"serviceName/":/"<b>'.$dp_name[0].'</b>/",/"payloadValue/":/"<b>1</b>/",/"run_by/":/"<b>'.$project_info[15].'</b>/"}" -H "Content-Type::application/json" https://chaosarmor.hsbc-10862889-digplatform-dev.dev.gcp.cloud.uk.hsbc/apis/chaosIKPApi.php </p>




																				</font> 
																			</div>
																		</div>
																	</div>
																	';
															}
															else
															{
																echo '
																<div class="card mb-0">
																	<div class="card-header" role="tab" id="heading_'.$i.'">
																		<h5 class="mb-0">
																			<a data-toggle="collapse" href="#collapse'.$i.'" aria-expanded="false"
																				aria-controls="collapse'.$i.'">
																				<font size="2"> '.$rw_chaos[0].' </font>
																			</a>
																		</h5>
																	</div>
																	<div id="collapse'.$i.'" class="collapse" role="tabpanel" aria-labelledby="heading_'.$i.'"
																		data-parent="#accordion">
																		<div class="card-body">  
																			
																			<font face="Courier New" size="2"> 
																				
																					{ <br />
																						&nbsp;&nbsp;  "apiKey":"<b>'.$project_info[7].'</b>", <br />
																						&nbsp;&nbsp;  "envName":"IKP", <br />
																						&nbsp;&nbsp;  "chaosName":"<b>'.$rw_chaos[0].'</b>", &nbsp;&nbsp; -- Chaos Experiment Name <br />
																						&nbsp;&nbsp;  "clusterName":"<b>'.$cluster_name.'</b>", &nbsp;&nbsp; -- Cluster Name <br />
																						&nbsp;&nbsp;  "namespaceName":"<b>'.$namespace_name.'</b>", &nbsp;&nbsp; -- Namespace Name <br />
																						&nbsp;&nbsp;  "serviceName":"<b>'.$dep_name.'</b>", &nbsp;&nbsp; -- Deployment Name <br />
																						&nbsp;&nbsp;  "payloadValue":"<b>Count_Value</b>", &nbsp;&nbsp; -- Count in Number <br />
																						&nbsp;&nbsp;  "run_by":"<b>'.$project_info[15].'</b>" <br />
																					}
																					
																					<br /><br />
																					
																					<p style="color:green"> curl -v -d "{/"apiKey/":/"<b>'.$project_info[7].'</b>/",/"envName/":/"IKP/",/"chaosName/":/"<b>'.$rw_chaos[0].'</b>/",/"clusterName/":/"<b>'.$cl_name[0].'</b>/",/"namespaceName/":/"<b>'.$nm_name[0].'</b>/",/"serviceName/":/"<b>'.$dp_name[0].'</b>/",/"payloadValue/":/"<b>1</b>/",/"run_by/":/"<b>'.$project_info[15].'</b>/"}" -H "Content-Type::application/json" https://chaosarmor.hsbc-10862889-digplatform-dev.dev.gcp.cloud.uk.hsbc/apis/chaosIKPApi.php </p>




																				</font> 
																		
																		
																		</div>
																	</div>
																</div>
																';
															}
															$i=$i+1;
														}
														
														
														if($rw_chaos[0]=="Scale_Service")
														{
															if($i==0)
															{
																echo '
																	<div class="card mb-0">
																		<div class="card-header" role="tab" id="heading_'.$i.'">
																			<h5 class="mb-0">
																				<a data-toggle="collapse" href="#collapse'.$i.'" aria-expanded="true"
																					aria-controls="collapse'.$i.'"> 
																					<font size="2"> '.$rw_chaos[0].' </font>
																				</a>
																			</h5>
																		</div>
																		<div id="collapse'.$i.'" class="collapse show" role="tabpanel" aria-labelledby="heading_'.$i.'"
																			data-parent="#accordion">
																			<div class="card-body"> 
																				<font face="Courier New" size="2"> 
																				
																					{ <br />
																						&nbsp;&nbsp;  "apiKey":"<b>'.$project_info[7].'</b>", <br />
																						&nbsp;&nbsp;  "envName":"IKP", <br />
																						&nbsp;&nbsp;  "chaosName":"<b>'.$rw_chaos[0].'</b>", &nbsp;&nbsp; -- Chaos Experiment Name <br />
																						&nbsp;&nbsp;  "clusterName":"<b>'.$cluster_name.'</b>", &nbsp;&nbsp; -- Cluster Name <br />
																						&nbsp;&nbsp;  "namespaceName":"<b>'.$namespace_name.'</b>", &nbsp;&nbsp; -- Namespace Name <br />
																						&nbsp;&nbsp;  "serviceName":"<b>'.$srv_name.'</b>", &nbsp;&nbsp; -- Service Name <br />
																						&nbsp;&nbsp;  "payloadValue":"<b>Count_Value</b>", &nbsp;&nbsp; -- Count in Number <br />
																						&nbsp;&nbsp;  "run_by":"<b>'.$project_info[15].'</b>" <br />
																					}
																					
																					<br /><br />
																					
																					<p style="color:green"> curl -v -d "{/"apiKey/":/"<b>'.$project_info[7].'</b>/",/"envName/":/"IKP/",/"chaosName/":/"<b>'.$rw_chaos[0].'</b>/",/"clusterName/":/"<b>'.$cl_name[0].'</b>/",/"namespaceName/":/"<b>'.$nm_name[0].'</b>/",/"serviceName/":/"<b>'.$sv_name[0].'</b>/",/"payloadValue/":/"<b>1</b>/",/"run_by/":/"<b>'.$project_info[15].'</b>/"}" -H "Content-Type::application/json" https://chaosarmor.hsbc-10862889-digplatform-dev.dev.gcp.cloud.uk.hsbc/apis/chaosIKPApi.php </p>




																				</font> 
																			</div>
																		</div>
																	</div>
																	';
															}
															else
															{
																echo '
																<div class="card mb-0">
																	<div class="card-header" role="tab" id="heading_'.$i.'">
																		<h5 class="mb-0">
																			<a data-toggle="collapse" href="#collapse'.$i.'" aria-expanded="false"
																				aria-controls="collapse'.$i.'">
																				<font size="2"> '.$rw_chaos[0].' </font>
																			</a>
																		</h5>
																	</div>
																	<div id="collapse'.$i.'" class="collapse" role="tabpanel" aria-labelledby="heading_'.$i.'"
																		data-parent="#accordion">
																		<div class="card-body">  
																			
																			<font face="Courier New" size="2"> 
																				
																					{ <br />
																						&nbsp;&nbsp;  "apiKey":"<b>'.$project_info[7].'</b>", <br />
																						&nbsp;&nbsp;  "envName":"IKP", <br />
																						&nbsp;&nbsp;  "chaosName":"<b>'.$rw_chaos[0].'</b>", &nbsp;&nbsp; -- Chaos Experiment Name <br />
																						&nbsp;&nbsp;  "clusterName":"<b>'.$cluster_name.'</b>", &nbsp;&nbsp; -- Cluster Name <br />
																						&nbsp;&nbsp;  "namespaceName":"<b>'.$namespace_name.'</b>", &nbsp;&nbsp; -- Namespace Name <br />
																						&nbsp;&nbsp;  "serviceName":"<b>'.$srv_name.'</b>", &nbsp;&nbsp; -- Service Name <br />
																						&nbsp;&nbsp;  "payloadValue":"<b>Count_Value</b>", &nbsp;&nbsp; -- Count in Number <br />
																						&nbsp;&nbsp;  "run_by":"<b>'.$project_info[15].'</b>" <br />
																					}
																					
																					<br /><br />
																					
																					<p style="color:green"> curl -v -d "{/"apiKey/":/"<b>'.$project_info[7].'</b>/",/"envName/":/"IKP/",/"chaosName/":/"<b>'.$rw_chaos[0].'</b>/",/"clusterName/":/"<b>'.$cl_name[0].'</b>/",/"namespaceName/":/"<b>'.$nm_name[0].'</b>/",/"serviceName/":/"<b>'.$sv_name[0].'</b>/",/"payloadValue/":/"<b>1</b>/",/"run_by/":/"<b>'.$project_info[15].'</b>/"}" -H "Content-Type::application/json" https://chaosarmor.hsbc-10862889-digplatform-dev.dev.gcp.cloud.uk.hsbc/apis/chaosIKPApi.php </p>




																				</font> 
																		
																		
																		</div>
																	</div>
																</div>
																';
															}
															$i=$i+1;
														}
														
														
														if($rw_chaos[0]=="CPU_Surge")
														{
															if($i==0)
															{
																echo '
																	<div class="card mb-0">
																		<div class="card-header" role="tab" id="heading_'.$i.'">
																			<h5 class="mb-0">
																				<a data-toggle="collapse" href="#collapse'.$i.'" aria-expanded="true"
																					aria-controls="collapse'.$i.'"> 
																					<font size="2"> '.$rw_chaos[0].' </font>
																				</a>
																			</h5>
																		</div>
																		<div id="collapse'.$i.'" class="collapse show" role="tabpanel" aria-labelledby="heading_'.$i.'"
																			data-parent="#accordion">
																			<div class="card-body"> 
																				<font face="Courier New" size="2"> 
																				
																					{ <br />
																						&nbsp;&nbsp;  "apiKey":"<b>'.$project_info[7].'</b>", <br />
																						&nbsp;&nbsp;  "envName":"IKP", <br />
																						&nbsp;&nbsp;  "chaosName":"<b>'.$rw_chaos[0].'</b>", &nbsp;&nbsp; -- Chaos Experiment Name <br />
																						&nbsp;&nbsp;  "clusterName":"<b>'.$cluster_name.'</b>", &nbsp;&nbsp; -- Cluster Name <br />
																						&nbsp;&nbsp;  "namespaceName":"<b>'.$namespace_name.'</b>", &nbsp;&nbsp; -- Namespace Name <br />
																						&nbsp;&nbsp;  "serviceName":"<b>'.$dep_name.'</b>", &nbsp;&nbsp; -- Deployment Name <br />
																						&nbsp;&nbsp;  "payloadValue":"<b>Count_Value</b>", &nbsp;&nbsp; -- Count in Number <br />
																						&nbsp;&nbsp;  "run_by":"<b>'.$project_info[15].'</b>" <br />
																					}
																					
																					<br /><br />
																					
																					<p style="color:green"> curl -v -d "{/"apiKey/":/"<b>'.$project_info[7].'</b>/",/"envName/":/"IKP/",/"chaosName/":/"<b>'.$rw_chaos[0].'</b>/",/"clusterName/":/"<b>'.$cl_name[0].'</b>/",/"namespaceName/":/"<b>'.$nm_name[0].'</b>/",/"serviceName/":/"<b>'.$dp_name[0].'</b>/",/"payloadValue/":/"<b>1</b>/",/"run_by/":/"<b>'.$project_info[15].'</b>/"}" -H "Content-Type::application/json" https://chaosarmor.hsbc-10862889-digplatform-dev.dev.gcp.cloud.uk.hsbc/apis/chaosIKPApi.php </p>




																				</font> 
																			</div>
																		</div>
																	</div>
																	';
															}
															else
															{
																echo '
																<div class="card mb-0">
																	<div class="card-header" role="tab" id="heading_'.$i.'">
																		<h5 class="mb-0">
																			<a data-toggle="collapse" href="#collapse'.$i.'" aria-expanded="false"
																				aria-controls="collapse'.$i.'">
																				<font size="2"> '.$rw_chaos[0].' </font>
																			</a>
																		</h5>
																	</div>
																	<div id="collapse'.$i.'" class="collapse" role="tabpanel" aria-labelledby="heading_'.$i.'"
																		data-parent="#accordion">
																		<div class="card-body">  
																			
																			<font face="Courier New" size="2"> 
																				
																					{ <br />
																						&nbsp;&nbsp;  "apiKey":"<b>'.$project_info[7].'</b>", <br />
																						&nbsp;&nbsp;  "envName":"IKP", <br />
																						&nbsp;&nbsp;  "chaosName":"<b>'.$rw_chaos[0].'</b>", &nbsp;&nbsp; -- Chaos Experiment Name <br />
																						&nbsp;&nbsp;  "clusterName":"<b>'.$cluster_name.'</b>", &nbsp;&nbsp; -- Cluster Name <br />
																						&nbsp;&nbsp;  "namespaceName":"<b>'.$namespace_name.'</b>", &nbsp;&nbsp; -- Namespace Name <br />
																						&nbsp;&nbsp;  "serviceName":"<b>'.$dep_name.'</b>", &nbsp;&nbsp; -- Deployment Name <br />
																						&nbsp;&nbsp;  "payloadValue":"<b>Count_Value</b>", &nbsp;&nbsp; -- Count in Number <br />
																						&nbsp;&nbsp;  "run_by":"<b>'.$project_info[15].'</b>" <br />
																					}
																					
																					<br /><br />
																					
																					<p style="color:green"> curl -v -d "{/"apiKey/":/"<b>'.$project_info[7].'</b>/",/"envName/":/"IKP/",/"chaosName/":/"<b>'.$rw_chaos[0].'</b>/",/"clusterName/":/"<b>'.$cl_name[0].'</b>/",/"namespaceName/":/"<b>'.$nm_name[0].'</b>/",/"serviceName/":/"<b>'.$dp_name[0].'</b>/",/"payloadValue/":/"<b>1</b>/",/"run_by/":/"<b>'.$project_info[15].'</b>/"}" -H "Content-Type::application/json" https://chaosarmor.hsbc-10862889-digplatform-dev.dev.gcp.cloud.uk.hsbc/apis/chaosIKPApi.php </p>




																				</font> 
																		
																		
																		</div>
																	</div>
																</div>
																';
															}
															$i=$i+1;
														}
														
													}
												}
												
												
												if($rw_env[1]=="On-Premise")
												{
													
												}
												
											?>
										</div>
									</div>
								</div>
								
							<?php
								}
							?>
							</div>
						</div>
						
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
	</body>

</html>