<!-- main header -->
            <div class="nk-header is-light">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger me-sm-2 d-lg-none">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-header-brand">
                            <a href="index.php" class="logo-link">
                                <img class="logo-light logo-img" src="../../img/hsbc.png" srcset="../../img/hsbc.png 2x" width="50px" alt="logo">
								<img class="logo-dark logo-img" src="../../img/hsbc.png" srcset="../../img/hsbc.png" width="50px" alt="logo-dark">
								
                            </a>
                        </div><!-- .nk-header-brand -->
                        <div class="nk-header-menu ms-auto" data-content="headerNav">
                            <div class="nk-header-mobile">
                                <div class="nk-header-brand">
                                    <a href="index.php" class="logo-link">
                                        <img class="logo-light logo-img" src="../../img/hsbc.png" srcset="../../img/hsbc.png 2x" width="50px" alt="logo">
                                        <img class="logo-dark logo-img" src="../../img/hsbc.png" srcset="../../img/hsbc.png 2x" width="50px" alt="logo-dark">
                                    </a>
                                </div>
                                <div class="nk-menu-trigger me-n2">
                                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-arrow-left"></em></a>
                                </div>
                            </div>
                            <ul class="nk-menu nk-menu-main ui-s2">
                                <li class="nk-menu-item has-sub">
                                    <a href="index.php" class="nk-menu-link">
                                        <span class="nk-menu-text">Dashboard</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                
								<li class="nk-menu-item has-sub">
                                    <a href="onboardings.php" class="nk-menu-link">
                                        <span class="nk-menu-text">Onboardings</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
								
							
								<!--<li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-text">Projects</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        
									<?php
										/*if($_SESSION['role']=="1")
										{
											echo '
												<li class="nk-menu-item">
													<a href="html/_blank.html" class="nk-menu-link"><span class="nk-menu-text">Admin Support</span></a>
												</li>
											';
										}
										
										if($_SESSION['role']=="2")
										{
											echo '
												<li class="nk-menu-item">
													<a href="html/_blank.html" class="nk-menu-link"><span class="nk-menu-text">Branch Support</span></a>
												</li>
											';
										}*/
									?>
									
                                        <li class="nk-menu-item">
                                            <a href="html/pages/terms-policy.html" class="nk-menu-link"><span class="nk-menu-text">Technical Support</span></a>
                                        </li>
                                    </ul><!-- .nk-menu-sub -->
                               <!-- </li> --> <!-- .nk-menu-item -->
								
								<li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-text">Reports</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="teamExecutionRpt.php" class="nk-menu-link"><span class="nk-menu-text">Team Execution Report</span></a>
                                        </li>
										<li class="nk-menu-item">
                                            <a href="serviceRpt.php" class="nk-menu-link"><span class="nk-menu-text">Execution Report (Service Wise)</span></a>
                                        </li>
										<li class="nk-menu-item">
                                            <a href="experimentRpt.php" class="nk-menu-link"><span class="nk-menu-text">Execution Report (Experiment Wise)</span></a>
                                        </li>
										<li class="nk-menu-item">
                                            <a href="targetRpt.php" class="nk-menu-link"><span class="nk-menu-text">Execution Report (Target Wise)</span></a>
                                        </li>
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
								
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-header-menu -->
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar sm">
                                                <em class="icon ni ni-user-alt"></em>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1 is-light">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar bg-danger">
                                                    <span>
													<?php 
														$words = explode(" ", $_SESSION['name']);
														$acronym = "";
														foreach ($words as $w) {
														  $acronym .= mb_substr($w, 0, 1);
														}
														echo $acronym;
													?>
													</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text"><?php echo $_SESSION['name']; ?></span>
                                                    <span class="sub-text">
														<?php 
															echo "Portal Administrator"; 
														?>
													</span>
                                                </div>
                                            </div>
                                        </div>
										
										
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="#" data-bs-toggle="modal" data-bs-target="#chgpwd"><em class="icon ni ni-setting-alt"></em><span>Change Passcode</span></a></li>
                                            </ul>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="signout.php"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li><!-- .dropdown -->
                            </ul><!-- .nk-quick-nav -->
                        </div><!-- .nk-header-tools -->
                    </div><!-- .nk-header-wrap -->
                </div><!-- .container-fliud -->
            </div>
            <!-- main header -->