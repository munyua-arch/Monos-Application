<?php
// Initialize variables
$username = '';
$userprofile = '';

// Check if $userdata is set and not empty
if (isset($userdata) && !empty($userdata)) {
    // Assign values if $userdata is set
    $username = isset($userdata['username']) ? $userdata['username'] : '';
    $userprofile = isset($userdata['profile']) ? $userdata['profile'] : '';
}
?>

<div class="header">
			<div class="header-left">
				<div class="menu-icon bi bi-list"></div>
				<div
					class="search-toggle-icon bi bi-search"
					data-toggle="header_search"
				></div>
				
			</div>
			<div class="header-right">
				<div class="dashboard-setting user-notification">
					<div class="dropdown">
						<a
							class="dropdown-toggle no-arrow"
							href="javascript:;"
							data-toggle="right-sidebar"
						>
							<i class="dw dw-settings2"></i>
						</a>
					</div>
				</div>
			
				<div class="user-info-dropdown">
					<div class="dropdown">
						<a
							class="dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<span class="user-icon">
								<i class="bi bi-person-circle"></i>
							</span>
							<span class="user-name"><?= $username?></span>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
						>
							<a class="dropdown-item" href="<?= base_url().'dashboard/profile/'?>"
								><i class="dw dw-user1"></i> Profile</a
							>
							
							<a class="dropdown-item" href="<?= base_url().'dashboard/support'?>"
								><i class="dw dw-help"></i> Help</a
							>
							<a class="dropdown-item" href="<?= base_url().'dashboard/logout';?>"
								><i class="dw dw-logout"></i> Log Out</a
							>
						</div>
					</div>
				</div>
			</div>
		</div>