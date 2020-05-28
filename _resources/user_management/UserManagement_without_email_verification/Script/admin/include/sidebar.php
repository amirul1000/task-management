<?php $url=$_SERVER['PHP_SELF'];?>
<div id="sidebar-wrapper" class="collapse sidebar-collapse">
	
		

		<div id="search">
				
		</div> <!-- #search -->
	
		<nav id="sidebar">		
			
			<ul id="main-nav" class="open-active">			

				<li <?php if((strpos($url,'dashboard')!=false)) echo "class='active'";?>>				
					<a href="dashboard.php">
						<i class="fa fa-dashboard"></i>
						Dashboard
					</a>				
				</li>
						
				<li class="dropdown <?php if((strpos($url,'user')!=false)) echo 'active opened';?>">
					<a href="javascript:;">
						<i class="fa fa-user"></i>
						User
						<span class="caret"></span>
					</a>				
					
					<ul class="sub-nav">
						<li>
							<a href="add_user.php">
								<i class="fa fa-plus-square"></i>
								Add User
							</a>
						</li>
						<li>
							<a href="view_user.php">
								<i class="fa fa-money"></i> 
								View User
							</a>
						</li>
					</ul>						
					
				</li>

				<li class="dropdown <?php if((strpos($url,'setting')!=false)) echo 'active opened';?>">
					<a href="javascript:;">
						<i class="fa fa-cogs"></i>
						Settings
						<span class="caret"></span>
					</a>				
					
					<ul class="sub-nav">
						<li>
							<a href="page-settings.php">
								<i class="fa fa-user"></i>
								Pofile Settings
							</a>
						</li>
						
					</ul>						
					
				</li>
				

			</ul>
					
		</nav> <!-- #sidebar -->


	</div> <!-- /#sidebar-wrapper -->
