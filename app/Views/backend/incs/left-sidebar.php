<div class="left-side-bar">
			<div class="brand-logo">
			<a href="index.html">
					<!-- <img src="<?= base_url() ;?>/public/backend/vendors/images/satelite.png" alt="" class="img-fluid img-thumbnail "/>	 -->
					<h5 class="text-primary">Raha Internet</h5></p>
					
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>	
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						<li>
							<a href="<?= base_url().'dashboard/leave'?>" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-file"></span>
								<span class="mtext">Leave Application</span>
							</a>
						</li>
						<li>
							<a href="<?= base_url().'dashboard/history'?>" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-arrow-repeat"></span
								><span class="mtext">Leave History</span>
							</a>
						</li>
						
						<!-- settings -->
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-gear"></span
								><span class="mtext">Settings</span>
							</a>
							<ul class="submenu">
								<li><a href="<?= base_url().'dashboard/change-password'?>">Change Password</a></li>
								<li><a href="<?= base_url().'dashboard/edit-admin'?>">Edit Profile</a></li>		
							</ul>
						</li>
					
						<li class="dropdown">
							<a href="<?= base_url().'dashboard/support'?>" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-info-square"></span
								><span class="mtext">Support</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>