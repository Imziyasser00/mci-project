<!-- BEGIN USER LOGIN DROPDOWN -->
				<li class="dropdown dropdown-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<img alt="" class="img-circle" src="../images/<?php echo $adp;?>.png"/>
					
					<span class="username username-hide-on-mobile">
					<?php echo $nom." ".$prenom; ?> </span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu">
						
						<li>
							<a href="change.php">
							<i class="fa fa-pencil"></i> Modifier mot de passe </a>
						</li>
						<li>
							<a href="lock.php">
							<i class="fa fa-key"></i> Vérouiller </a>
						</li>
						<li>
							<a href="login.php" >
							<i class="fa fa-lock"></i> Se déconnecter </a>
						</li>
					</ul>
				</li>
<!-- END USER LOGIN DROPDOWN -->