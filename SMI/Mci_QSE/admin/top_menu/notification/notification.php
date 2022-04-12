				<!-- BEGIN NOTIFICATION DROPDOWN -->
				<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="fa fa-bell-o"></i>
					<span class="badge badge-default">
					<?php	$iEM=0;	
							if($adp!=1 || $adp!=2){
							
							$icom=0;
							$icomRA=0;
							$icomrap=0;
							$icomAction=0;
							$iEMa=0;
							$iEMD=0; 
							}
										include 'docEXP.php';
										include 'VaEXP.php';
										include 'action.php';
										include_once 'ficheaudit.php';
										include_once 'comqse.php';
										include_once 'comRA.php';
										include_once 'rapportdaudit.php';
										include_once 'rapcree.php';
										include_once 'notEM.php';
										$total=$i+$iVEX+$iFCP+$iRA+$icom+$icomRA+$icomrap+$icomAction+$iEM+$iEMa+$iEMD; 
										$j=0; 
					echo $total; ?> </span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<p>
								 Notifications
							</p>
						</li>
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 250px;">
								<?php 
										while($j < $i ){								
								?>
								<li>
									<?php echo'<a href="docdocdetail.php?exp=0&file='.$NOT_EX[$j]['id'].'&type='.$NOT_EX[$j]['type'].'&service='.$NOT_EX[$j]['service'].'">'; ?>
									<span class="label label-sm label-icon label-danger">
									<i class="fa fa-bolt"></i>
									</span>
									<?php echo $NOT_EX[$j]['lien'] ; ?> <span class="time"><br>
									<?php echo $NOT_EX[$j]['exp'] ; ?> </span>
									</a>
								</li>
								<?php $j++;}?>
								<?php $j=0; while($j < $iVEX ){								
								?>
								<li>
									<?php echo'<a href="docdocdetail.php?exp=1&file='.$NOT_VEX[$j]['id'].'&type='.$NOT_VEX[$j]['type'].'&service='.$NOT_VEX[$j]['service'].'">'; ?>
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-bell-o"></i>
									</span>
									<?php echo $NOT_VEX[$j]['lien'] ; ?> <span class="time"><br>
									<?php echo $NOT_VEX[$j]['exp'] ; ?> </span>
									</a>
								</li>
								<?php $j++;}?>								
								<?php $j=0; while($j < $iFCP ){								
								?>
								<li>
									<?php echo '<a href="addfiche.php?num='.$NOT_FCP[$j]['num'].'" title="Créer la fiche d\'audit">';?>
									
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-file-o"></i>
									</span>
									<?php echo $NOT_FCP[$j]['lien'] ; ?> <span class="time"><br>
									<?php echo $NOT_FCP[$j]['exp'] ; ?> </span>
									</a>
								</li>
								<?php $j++;}?>
								
									<?php $j=0; while($j < $iRA ){								
								?>
								
								<li>
									<?php echo '<a href="addRapport.php?num='.$NOT_RA[$j]['num'].'" title="Rédiger le rapport d\'audit">';?>
									
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-file-o"></i>
									</span>
									<?php echo $NOT_RA[$j]['lien'] ; ?> <span class="time"><br>
									
									</a>
								</li>
								<?php $j++;}?>
								<?php $j=0; while($j < $icom ){								
								?>
								<li>
									<?php echo '<a href="addfiche5.php?num='.$NOT_com[$j]['num'].'" title="Valider la fiche d\'audit">';?>
									
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-file-o"></i>
									</span>
									<?php echo $NOT_com[$j]['lien'] ; ?> <span class="time"><br>
									
									</a>
								</li>
								<?php $j++;}?>
								<?php $j=0; while($j < $icomrap ){								
								?>
								<li>
									<?php echo '<a href='.$NOT_comrap[$j]['num'].' title="Visualiser le rapport d\'audit">';?>
									
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-file-o"></i>
									</span>
									<?php echo $NOT_comrap[$j]['lien'] ; ?> <span class="time"><br>
									
									</a>
								</li>
								<?php $j++;}?>
								<?php $j=0; while($j < $icomRA ){								
								?>
								<li>
									<?php echo '<a href="addfiche5.php?num='.$NOT_comRA[$j]['num'].'" title="Completer la fiche d\'audit">';?>
									
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-file-o"></i>
									</span>
									<?php echo $NOT_comRA[$j]['lien'] ; ?> <span class="time"><br>
									
									</a>
								</li>
								<?php $j++;}?>
								<?php $j=0; while($j < $icomAction ){								
								?>
								<li>
									<?php echo '<a href="completerPlan.php?num='.$NOT_ActionNum.'&an='.$plan_ann.'" title="Completer le plan d\'action">';?>
									
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-file-o"></i>
									</span>
									<?php echo $NOT_ActionLien ; ?> <span class="time"><br>
									
									</a>
								</li>
									<?php $j++;}?>
								<?php $j=0; while($j < $iEM ){								
								?>
								<li>
									<?php echo '<a href="ficheEcart1.php?id='.$NOT_EM[$j]['id'].'&idN='.$NOT_EM[$j]['idN'].'" title="Créer la fiche d\'écart majeur d\'audit "">';?>
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-file-o"></i>
									</span>
									<?php echo $NOT_EM[$j]['lien'] ; ?> <span class="time"><br>
									
									</a>
								</li>
								<?php $j++;}?>
																<?php $j=0; while($j < $iEMa ){								
								?>
								<li>
									<?php echo '<a href="ficheEcart1.php?id='.$NOT_EMa[$j]['id'].'" title="Créer la fiche d\'écart majeur d\'audit "">';?>
									
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-file-o"></i>
									</span>
									<?php echo $NOT_EMa[$j]['lien'] ; ?> <span class="time"><br>
									
									</a>
								</li>
								<?php $j++;}?>
																	<?php $j=0; while($j < $iEMD ){								
								?>
								<li>
									<?php echo '<a href="ficheEcart1.php?id='.$NOT_EMd[$j]['id'].'" title="Valider la fiche d\'écart majeur d\'audit "">';?>
									
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-file-o"></i>
									</span>
									<?php echo $NOT_EMd[$j]['lien'] ; ?> <span class="time"><br>
									
									</a>
								</li>
								<?php $j++;}?>
								
								<?php if($total==0){ ?>
								<li>
									<a href="#">
									<span class="label label-sm label-icon label-info">
									<i class="fa fa-bullhorn"></i>
									</span>
									Aucune notification 
									 </span>
									</a>
								</li>
								<?php } ?>
								
							</ul>
							
						</li>
						
						<li class="external">
							<a href="notification.php" target="_blank">
							Voir toutes les notifications <i class="m-icon-swapright"></i>
							</a>
						</li>
						
					</ul>
				</li>
				<!-- END NOTIFICATION DROPDOWN -->				
