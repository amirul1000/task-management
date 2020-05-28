<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
					<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				<li class="start ">
					<a href="land">
					<i class="icon-home"></i>
					<span class="title">Home</span>
					</a>
				</li>
				
				<li class="active open">
					<a href="javascript:;">
					<i class="icon-rocket"></i>
					<span class="title">My Menu</span>
					<span class="selected"></span>
					<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
                          <li class=""><a href="login?cmd=logout"><i class="icon-user"></i> <span>Logout</span></a></li>
                          <li class=""><a href="land"><i class="icon-user"></i> <span>Home</span></a></li>
                          <li class=""><a href="admin"><i class="icon-user"></i> <span>Admin users</span></a></li>
                          <li class=""><a href="users"><i class="icon-user"></i> <span>Users (employer/employee)</span></a></li>
                          <li class=""><a href="company"><i class="icon-user"></i> <span>Company</span></a></li>  
                          <li class=""><a href="payment_key"><i class="icon-user"></i> <span>Payment key</span></a></li>
                          <li class=""><a href="plan"><i class="icon-user"></i> <span>Plan</span></a></li>
                          <li class=""><a href="subscription"><i class="icon-user"></i> <span>Subscription</span></a></li>
                          <li class=""><a href="subscription_type"><i class="icon-user"></i> <span>Subscription info</span></a></li>
                          <li class=""><a href="company_register"><i class="icon-user"></i> <span>Employee registered Company</span></a></li>
                          <li class=""><a href="task"><i class="icon-user"></i> <span>Task</span></a></li>                
                          <li class=""><a href="task_performed"><i class="icon-user"></i> <span>Task performed</span></a></li> 
                    </ul>
				</li>
				
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->