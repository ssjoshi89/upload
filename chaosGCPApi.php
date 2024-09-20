<?php
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	include_once('../sitemaster.php');
	
	$result =array();
	$data = json_decode(file_get_contents("php://input"));
	
	$apiKey = isset($data->apiKey) ? mysqli_real_escape_string($con,$data->apiKey) :  "";
	$env_name = isset($data->envName) ? mysqli_real_escape_string($con,$data->envName) :  "";
	$chaos_name = isset($data->chaosName) ? mysqli_real_escape_string($con,$data->chaosName) :  "";
	$cluster = isset($data->clusterName) ? mysqli_real_escape_string($con,$data->clusterName) :  "";
	$nm = isset($data->namespaceName) ? mysqli_real_escape_string($con,$data->namespaceName) :  "";
	
	$service_name = isset($data->serviceName) ? mysqli_real_escape_string($con,$data->serviceName) :  "";
	$payload_value = isset($data->payloadValue) ? mysqli_real_escape_string($con,$data->payloadValue) :  "";
	$psid = isset($data->run_by) ? mysqli_real_escape_string($con,$data->run_by) :  "";
	
	$projectID=mysqli_fetch_row(mysqli_query($con,"select id from project_info where api_token='".$apiKey."' and status='Active' and sa_name='".$psid."' and find_in_set((SELECT id FROM env_master where name='GCP'),env_ids)"));
	$projectID=$projectID[0];
	
	if(!empty($apiKey) && !empty($chaos_name) && !empty($cluster) && !empty($nm) && !empty($env_name) && !empty($service_name) && !empty($payload_value) && !empty($psid))
	{
		if($projectID!="")
		{
			if($env_name=="GCP-VM")
			{
				$result[] = array("status" => 200, "msg" => "Currently Not Available"); 
			}
			elseif($env_name=="GCP-GKE")
			{
				$target_name=mysqli_fetch_row(mysqli_query($con,"select id from gcp_gke_config where project_id='".$projectID."' and cluster='".$cluster."' and namespace='".$nm."' and status='Active' and connectivity_flag='Connected'"));
				$target_name=$target_name[0];
			
				if($chaos_name=="Kill_Running_POD" || $chaos_name=="Scale_Service" || $chaos_name=="CPU_Surge" || $chaos_name=="Delete_Node")
				{
					if($target_name!="")
					{
						$data_col="";
						$data_row="";
										
						if($chaos_name=="Kill_Running_POD" || $chaos_name=="Scale_Service" || $chaos_name=="CPU_Surge")
						{
							$data_row=mysqli_fetch_row(mysqli_query($con,"select dep_name from gcp_gke_config where id='".$target_name."'"));
							$data_col=explode(",",$data_row[0]);
						}
											
						if($chaos_name=="Delete_Node")
						{
							$data_row=mysqli_fetch_row(mysqli_query($con,"select pool_name from gcp_gke_config where id='".$target_name."'"));
							$data_col=explode(",",$data_row[0]);
						}
						
						
						if(count($data_row)!="0")
						{
							$vaildService=false;
							foreach($data_col as $item)
							{
								if($item==$service_name)
								{
									$vaildService=true;
								}
							}
							
							if($vaildService==true)
							{
								$para_value=$service_name."|".$payload_value;
								if(mysqli_query($con,"insert into chaos_log (project_id,chaos_name,env_name,target_name,username,rmk,executer_platform) values ('".$projectID."','".$chaos_name."','".$env_name."','".$target_name."','".$psid."','".$para_value."','API')"))
								{
									$result[] = array("status" => 200, "msg" => "Chaos Experiment Executed Successfully!!! Please visit platform for Report.");
								}
								else
								{
									$result[] = array("status" => 500, "msg" => "Something Went Wrong!!!");
								}						
							}
							else
							{
								$result[] = array("status" => 406, "msg" => "Unknown Service Selection!!!");
							}							
						}
						else
						{
							$result[] = array("status" => 405, "msg" => "No Services Mapped with Selected Target");
						}
					}
					else
					{
						$result[] = array("status" => 404, "msg" => "Invaild Target Selection!!!");
					}
				}
				else
				{
					$result[] = array("status" => 403, "msg" => "Unknown Chaos Experiment Selected!!!");
				}
			}
			else
			{
				$result[] = array("status" => 402, "msg" => "Unknown Environment Selection!!!"); 
			}
			
			$json = array("info" => $result);
		}
		else
		{
			$result[] = array("status" => 401, "msg" => "Unauthorized Access"); 		
			$json = array("info" => $result);
		}
	}
	else
	{
		$result[] = array("status" => 400, "msg" => "Request Parameters Should Not Empty!!!"); 		
		$json = array("info" => $result);
	}
	
	@mysqli_close($con);

	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);
?>