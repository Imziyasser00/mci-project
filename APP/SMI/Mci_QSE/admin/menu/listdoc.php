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
								?>
								
								

								
							</ul>
															
					
				</li>
				