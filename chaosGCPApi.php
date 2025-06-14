<?php
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	include_once('../sitemaster.php');
	
	$result =array();
	$data = json_decode(file_get_contents("php://input"));
	
	$apiKey = isset($data->apiKey) ? mysqli_real_escape_string($con,$data->apiKey) :  "";
	$userName = isset($data->userName) ? mysqli_real_escape_string($con,$data->userName) :  "";
	$chaos_name = isset($data->chaosName) ? mysqli_real_escape_string($con,$data->chaosName) :  "";
	
	$cluster = isset($data->clusterName) ? mysqli_real_escape_string($con,$data->clusterName) :  "";
	$nm = isset($data->namespaceName) ? mysqli_real_escape_string($con,$data->namespaceName) :  "";
	$region = isset($data->regionName) ? mysqli_real_escape_string($con,$data->regionName) :  "";
	
	$service_name = isset($data->serviceName) ? mysqli_real_escape_string($con,$data->serviceName) :  "";
	$payload_value = isset($data->payloadValue) ? mysqli_real_escape_string($con,$data->payloadValue) :  "";
	
	
	$projectID=mysqli_fetch_row(mysqli_query($con,"select id from project_info where api_token='".$apiKey."' and sa_name='".$userName."' and status='Active' and find_in_set((SELECT id FROM env_master where name='GCP'),env_ids)"));
	$projectID=$projectID[0];
	
	if(!empty($apiKey) && !empty($chaos_name) && !empty($cluster) && !empty($nm) && !empty($userName) && !empty($service_name) && !empty($payload_value) && !empty($region))
	{
		if($projectID!="")
		{
			$target_name=mysqli_fetch_row(mysqli_query($con,"select id from gcp_gke_config where project_id='".$projectID."' and cluster='".$cluster."' and namespace='".$nm."' and region_name='".$region."' and status='Active' and connectivity_flag='Connected'"));
			$target_name=$target_name[0];
			
			if($chaos_name=="Kill_Running_POD" || $chaos_name=="Scale_Service" || $chaos_name=="CPU_Surge" || $chaos_name=="Delete_Node" || $chaos_name=="Block_Ingress" || $chaos_name=="Block_Egress" || $chaos_name=="Memory_Surge" || $chaos_name=="Scale_Down_Deployment" || $chaos_name=="Scale_Up_Deployment")
			{
				if($target_name!="")
				{
					$data_col="";
					$data_row="";
									
					if($chaos_name=="Kill_Running_POD" || $chaos_name=="Scale_Service" || $chaos_name=="CPU_Surge" || $chaos_name=="Block_Ingress" || $chaos_name=="Block_Egress" || $chaos_name=="Memory_Surge" || $chaos_name=="Scale_Down_Deployment" || $chaos_name=="Scale_Up_Deployment")
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
							if(mysqli_query($con,"insert into chaos_log (project_id,chaos_name,env_name,target_name,username,rmk,executer_platform) values ('".$projectID."','".$chaos_name."','GCP-GKE','".$target_name."','".$userName."','".$para_value."','API')"))
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
