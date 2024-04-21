<div class="left-side-bar">
			<div class="brand-logo">
			<a href="index.html">
					<!-- <img src="<?= base_url() ;?>/public/backend/vendors/images/satelite.png" alt="" class="img-fluid img-thumbnail "/>	 -->
					<h5 class="text-primary">Leave System</h5></p>
					
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>	
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						<li>
							<a href="<?= base_url().'admindashboard/'?>" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-speedometer	"></span>
								<span class="mtext">Dashboard</span>
							</a>
						</li>
						<li>
							<a href="<?= base_url().'admindashboard/employees'?>" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-people-fill"></span
								><span class="mtext">Employee Section</span>
							</a>
						</li>
						<li>
							<a href="<?= base_url().'admindashboard/departments'?>" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-layers-fill"></span
								><span class="mtext">Department Section</span>
							</a>
						</li>
						<li>
							<a href="<?= base_url().'admindashboard/leave-types'?>" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-arrow-repeat"></span
								><span class="mtext">Leave Types</span>
							</a>
						</li>

						<!-- manage leaves -->
						<!-- settings -->
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
							<span class="micon bi bi-columns-gap"></span>
								<span class="mtext">Manage leave</span>
							</a>
							<ul class="submenu">
								<li><a href="<?= base_url().'admindashboard/pending'?>">Pending</a></li>
								<li><a href="<?= base_url().'admindashboard/approved'?>">Approved</a></li>	
								<li><a href="<?= base_url().'admindashboard/declined'?>">Declined</a></li>	
								<li><a href="<?= base_url().'admindashboard/leave-history'?>">Leave History</a></li>		
							</ul>
						</li>
						
						<!-- settings -->
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-gear"></span
								><span class="mtext">Settings</span>
							</a>
							<ul class="submenu">
								<li><a href="<?= base_url().'admindashboard/admin-change-password'?>">Change Password</a></li>
								<li><a href="<?= base_url().'admindashboard/edit-admin'?>">Edit Profile</a></li>		
							</ul>
						</li>
					
						<li class="dropdown">
							<a href="<?= base_url().'admindashboard/admins'?>" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-info-square"></span
								><span class="mtext">Manage Admin</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>