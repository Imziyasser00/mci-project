
	<li <?php if($openfrom==1){?> class="active open" <?php } ?>>
					<a href="javascript:;">
					<i class="fa fa-cogs"></i>
					<span class="title" >Management</span>
					<span class="arrow "></span>
					</a>
					
					<ul class="sub-menu">
					
						<li>
							<a href="#">
							<i class=""></i>
							Audit Interne<span class="arrow"></span></a>
							<ul class="sub-menu">
									<?php if($adp==1 || $adp==2 ||$adp==3 ){  ?>
									
										<li>
										
											<a href="#"><font size="2pt"><i class="fa fa-cogs"></i>Gestion des auditeurs</font><span class="arrow"></span></a>
											<ul class="sub-menu">
											<?php if($adp==1 || $adp==2 ){  ?>{
											<li>
											<a href="addauditeur.php"><font size="2pt">Ajouter un auditeur</font></a>
											</li>
											<li>
											<a href="modauditeur.php"><font size="2pt">Modifier un auditeur</font></a>
											</li>
											<?php } ?>
											<li>
											<a href="listeaudit.php"><font size="2pt">Listes des auditeurs</font></a>
											</li>
											</ul>
										</li>
										<li>
							<a href="#">
							<i class="fa fa-file-pdf-o"></i>
							Plan d'audit<span class="arrow"></span></a>
							<ul class="sub-menu">
										<?php if($adp==1 || $adp==2 ){  ?>
										<li>
											<a href="addaudit0.php"><font size="2pt">Ajouter un audit</font></a>
										</li>										
										<li>
											<a href="delaudit0.php"><font size="2pt">Supprimer un audit</font></a>
										</li>
										<?php } ?>
										<li>
											<a href="planaudits.php"><font size="2pt">Plan d'audit Annuel</font></a>
										</li>										
							</ul>			
						</li>
									<?php } ?>
									<li>
							<a href="#">
							<i class="fa fa-file-pdf-o"></i>
							Fiche d'audit<span class="arrow"></span></a>
							<ul class="sub-menu">
										
										<?php if($adp==1 || $adp==2){ ?>	
										<li><a href="allfiche.php"><font size="2pt">Fiches d'audit</font></a></li>
										<li><a href="listefiches.php"><font size="2pt">Listes des fiches d'audit</font></a></li>
										<?php } 
										else {?>	<li><a href="selectmyfiche.php"><font size="2pt">Listes des fiches d'audit</font></a></li><?php } ?>
										
										
										
							</ul>			
						</li>
						
						<li>
							<a href="#">
							<i class="fa fa-file-pdf-o"></i>
							Rapport d'audit<span class="arrow"></span></a>
							<ul class="sub-menu">
										<li>
										<?php if($adp!=0){ ?>	<a href="allrapport.php"><font size="2pt">Rapports d'audit</font></a>
										<?php } ?></li><li><?php if($adp!=0){ ?>	<a href="rapport0.php"><font size="2pt">Listes des rapports d'audit</font></a><?php } 
										else {?>	<a href="selectmyrapport.php"><font size="2pt">Listes des rapports d'audit</font></a><?php } ?>
										</li>
										
										
							</ul>			
						</li>
						<li>
						<?php if($adp!=0){ ?>	<a href="plandaction0.php"><i class="fa fa-sitemap"></i><font size="2pt">Plan d'action</font></a><?php } 
										else {?>	<a href="pdaction.php"><i class="fa fa-sitemap"></i><font size="2pt">Plan d'action</font></a><?php } ?>
							
						
						</li>
						<li>
						<?php if($adp!=0){ ?>	<a href="listecart0.php"><i class="fa fa-flash"></i><font size="2pt">Liste des ecarts</font></a><?php } 
										else {?>	<a href="listecartuser.php"><i class="fa fa-flash"></i><font size="2pt">Liste des ecarts</font></a><?php } ?>
							
						
						</li>
							</ul>
						</li>
												
					</li>
					<li>
							<a href="#">
							<i class=""></i>
							Audit Externe<span class="arrow"></span></a>
							<ul class="sub-menu">																		
						<li>
										<a href="#">
									<i class="fa fa-bar-chart-o "></i>
										Rapports d'audit</a>
						</li>
						<li>
							<a href="#">
							<i class="fa fa-sitemap"></i>
							Plan d'action</a>
						</li>
							</ul>				
												
					</li>
					<li>
							<a href="#">
							<i class=""></i>
							Revue de Direction<span class="arrow"></span></a>
							<ul class="sub-menu">																		
						<li>
							<a href="#">
							<i class="fa fa-sitemap"></i>
							Plan d'action</a>
						</li>
							</ul>												
					</li>				
						
						<li>
							<a href="#">
							<i class="fa fa-bullhorn"></i>
							Réclamation</a>
						</li>
						
					</ul>
				</li>
	