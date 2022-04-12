				<li>
							<a href="">
							<i class="fa fa-files-o"></i>
							Liste des documents<span class="arrow"></span></a>
							<ul class="sub-menu">
								<?php									
									include_once 'bd.php';									
									$SelectType=$connexion->query("select type from type");
										while  ($nomType = $SelectType->Fetch(PDO::FETCH_ASSOC)) 
															{
											$SelectedType=$nomType['type'];						
										if($adp==0){
										
								$ExistanceDiffusion=$connexion->prepare('select diff.id_doc as id from diff where id_serv=? and doc_type=?');
								$ExistanceDiffusion->execute(array($service,$SelectedType));
								$nbr=$ExistanceDiffusion->rowcount();
										if($nbr!=0){ ?>
										<li>
											<a <?php echo 'href="../admin/docadmin.php?type='.$SelectedType.'&service='.utf8_encode($Sname).'"';?>><i class="fa fa-file-text-o"></i><?php echo $SelectedType ;?>
											</a>
											
											
										</li>
											<?php } 
														}
									else {?>
										<li>
											<a href="#"><i class="fa fa-file-text-o"></i> <?php echo $SelectedType ;?>
												<span class="arrow"></span></a>
											<ul class="sub-menu">
											<?php
																	include_once 'bd.php';
																	$req1=$connexion->query("select * from service where service.id!=19 and service.id != 20 order by ref");
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																		
																	echo '<li><a href="../admin/docadmin.php?type='.$SelectedType.'&service='.utf8_encode($obj['nom']).'"><i class="fa fa-file-text-o"></i>'.utf8_encode($obj['ref']).'</a>';
																			} } 
											?>
											</ul>
										
																			</li>
										</li>		
																			<?php }
																	} ?>
								

								
							</ul>
															
					
				</li>
				