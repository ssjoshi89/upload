<?php
	$page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
?>

<aside class="app-side" id="app-side">
					<div class="side-content ">
						
						<nav class="side-nav">
							<ul class="unifyMenu" id="unifyMenu">
								
								<li class="menu-header">
									<p align="center"> ----- Menu Controls ----- </p>
								</li>
								
								<?php
									$data=mysqli_fetch_row(mysqli_query($con,"select distinct group_concat(name) from env_master where status='Active' and find_in_set(id,'".$_SESSION['env']."') order by id"));
									$data=explode(',',$data[0]);	

									$api_flag=mysqli_fetch_row(mysqli_query($con,"select api_flag from project_info where id='".$_SESSION['id']."'"));
								?>	

								<li class="<?php if($page=="index") { echo "active selected"; } ?>">
									<a href="index.php">
										<span class="has-icon">
											<i class="icon-gauge"></i>
										</span>
										<span class="nav-title">Dashboard</span>
									</a>
								</li>	

								
								<li class="<?php foreach($data as $rw){ if($page=="chaos_".$rw."") { echo "active selected"; }} ?>">
									<a href="#" class="has-arrow" aria-expanded="false">
										<span class="has-icon">
											<i class="icon-cogs"></i>
										</span>
										<span class="nav-title">Chaos </span>
									</a>
									<ul aria-expanded="false">
									<?php
										foreach($data as $rw)
										{
											if($page=="chaos_".$rw."")
											{
												echo "<li><a href='chaos_".$rw.".php' class='current-page'>".$rw."</a></li>";
											}
											else
											{
												echo "<li><a href='chaos_".$rw.".php'>".$rw."</a></li>";
											}
										}			
									?>	
									</ul>
								</li>
								
								<?php
									if($api_flag[0]=="Yes")
									{
								?>
								
								<li class="<?php if($page=="api") { echo "active selected"; } ?>">
									<a href="api.php">
										<span class="has-icon">
											<i class="icon-swap"></i>
										</span>
										<span class="nav-title">API</span>
									</a>
								</li>
								
								<?php
									}
								?>
								
								<li class="<?php if($page=="notes") { echo "active selected"; } ?>">
									<a href="notes.php">
										<span class="has-icon">
											<i class="icon-new-message"></i>
										</span>
										<span class="nav-title">Chaos Diary</span>
									</a>
								</li>
								
								<?php
									if($_SESSION['owner']==$_SESSION['usr'])
									{
								?>
								
								<li class="<?php foreach($data as $rw){ if($page=="list_".$rw."" || $page=="conf_".$rw."" || $page=="conf_".$rw."Updt") { echo "active selected"; }} ?>">
									<a href="#" class="has-arrow" aria-expanded="false">
										<span class="has-icon">
											<i class="icon-tools"></i>
										</span>
										<span class="nav-title">Configurations</span>
									</a>
									<ul aria-expanded="false">
									<?php
										foreach($data as $rw)
										{
											if($page=="list_".$rw."" || $page=="conf_".$rw."" || $page=="conf_".$rw."Updt")
											{
												echo "<li><a href='list_".$rw.".php' class='current-page'>".$rw."</a></li>";
											}
											else
											{
												echo "<li><a href='list_".$rw.".php'>".$rw."</a></li>";
											}
										}			
									?>
									</ul>
								</li>
								
								<li class="<?php if($page=="projectProfile" || $page=="userProfile") { echo "active selected"; } ?>">
									<a href="#" class="has-arrow" aria-expanded="false">
										<span class="has-icon">
											<i class="icon-center_focus_strong"></i>
										</span>
										<span class="nav-title">Project Profile</span>
									</a>
									<ul aria-expanded="false">
									<?php
										if($page=="projectProfile")
										{
											echo "<li><a href='projectProfile.php' class='current-page'>Project Management</a></li>";
										}
										else
										{
											echo "<li><a href='projectProfile.php'>Project Management</a></li>";
										}	

										if($page=="userProfile")
										{
											echo "<li><a href='userProfile.php' class='current-page'>User Management</a></li>";
										}
										else
										{
											echo "<li><a href='userProfile.php'>User Management</a></li>";
										}	
									?>
									</ul>
								</li>
								
								<?php
									}
								?>
								
								
								<li class="menu-header">
									<hr />
								</li>
								
								<li>
									<a href="signout.php">
										<span class="has-icon">
											<i class="icon-switch"></i>
										</span>
										<span class="nav-title">Signout</span>
									</a>
								</li>
							</ul>
							
						</nav>
						
					</div>
					
				</aside>