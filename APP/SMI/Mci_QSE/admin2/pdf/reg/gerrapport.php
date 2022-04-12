 <?php
session_start();
require_once('tcpdf_include.php');


if(isset($_GET['num']) ){
$num=$_GET['num'];
}
else{
	header("Location: 404.html");
}

?>
<?php 
		include_once 'bd.php';
		$selectall=$connexion->query("select lieu ,date ,id_ss, idr from fichdaudit where audit_num='$num'");
		$objt = $selectall->Fetch(PDO::FETCH_ASSOC);
		$date = $objt['date'];
		$date = date_create($date);
		$date=date_format($date, 'd  / m / Y');		
		$idr = utf8_encode($objt['idr']);
		$lieu=utf8_encode($objt['lieu']);
		$id_ss=$objt['id_ss'];
		$selectnomss=$connexion->query("select nom from sservice where id=$id_ss");
								$sservice = $selectnomss->Fetch(PDO::FETCH_ASSOC);
								$ssnom=utf8_encode($sservice ['nom']);
		$objectif='';
		$req13=$connexion->query("select objectif from objectifaudit where num_audit='$num'");	
																	$objobje=$req13->rowcount();
																	if($objobje!=0){
																		
																	while  ($objobje = $req13->Fetch(PDO::FETCH_ASSOC)) 
																	{
																	$objectifs=utf8_encode($objobje ['objectif']);
																	$objectif1=str_replace('?', '\'', $objectif1); 		
																	$objectif=$objectif.'<li class="MsoNormal"><span lang="FR-CH">'.$objectifs.'</span></li>';
																	}
																	}
		$selectduree=$connexion->query("select duree from auditprevu where numero='$num'");
								$seldurr = $selectduree->Fetch(PDO::FETCH_ASSOC);
								$duree=$seldurr ['duree'];	
		$selectRauditee=$connexion->query('select id_utilisateur from respentaudite where respentaudite.num_audit="'.$num.'"');
								
								while($aRA = $selectRauditee->Fetch(PDO::FETCH_ASSOC)){							
								$r=$aRA['id_utilisateur'];								
															
									$SelectRaNom=$connexion->query("select nom , prenom ,fonction from utilisateur where utilisateur.id=$r");
									
										$aRAselect = $SelectRaNom->Fetch(PDO::FETCH_ASSOC);
											$Raa['nom']=$aRAselect['nom'];
												$Raa['prenom']=$aRAselect['prenom'];
												$fct=$aRAselect['fonction'];
												$Raa['complet']=$aRAselect['prenom'].' '.$aRAselect['nom'];												
								}
		$Raaa=$Raa['complet'];
		$lol='';
		$selectauditee=$connexion->query('select id_utilisateur from auditeefinal where auditeefinal.num_audit="'.$num.'" and id_utilisateur!='.$r.' order by id');
							$tab=$selectauditee->rowcount();
							$tab=$tab+1;	
								while($auditees1 = $selectauditee->Fetch(PDO::FETCH_ASSOC)){
														
							$auditees['id_utilisateur']=$auditees1['id_utilisateur'];
								$rau=$auditees['id_utilisateur'];								
									$SelectAuditeeNom=$connexion->query("select nom, prenom, fonction from utilisateur where utilisateur.id=$rau.");
										$auditeeselect = $SelectAuditeeNom->Fetch(PDO::FETCH_ASSOC);
											$audites['nom']=$auditeeselect['nom'];
												$audites['prenom']=$auditeeselect['prenom'];
												$audites['fonction']=$auditeeselect['fonction'];
													$audites['complet']=$audites['nom'].' '.$auditeeselect['prenom'];
													$lol.='<tr>
					<td width="211">
					<p align="center" class="MsoNormal"><span lang="FR-CH">'.$audites['complet'].'</span></p>
					</td>
					<td colspan="2" width="213">
					<p align="center" class="MsoNormal"><span lang="FR-CH">'.$audites['fonction'].'</span></p>
					</td>
				</tr>';													
								}	
		$selectauditeurprevuRA=$connexion->query('select id,id_auditeur, fonction,numero_audit  from auditeurprevu where auditeurprevu.numero_audit="'.$num.'" and fonction="1"');
								
								while($auditeurs1RA = $selectauditeurprevuRA->Fetch(PDO::FETCH_ASSOC)){
													
							$auditeursRA['id_auditeur']=$auditeurs1RA['id_auditeur'];
								$r1=$auditeursRA['id_auditeur'];								
									$SelectAuditeurPrevuRANom=$connexion->query("select nom,prenom from auditeur where auditeur.id=$r1.");
										$RAselect = $SelectAuditeurPrevuRANom->Fetch(PDO::FETCH_ASSOC);
											$RA['nom']=$RAselect['nom'];
												$RA['prenom']=$RAselect['prenom'];
												$RA['complet']=substr($RA['prenom'],0,1).'.'.$RA['nom'];	
												$RAu=$RA['complet'];
								}
								$listA='';
		$selectauditeurprevuA=$connexion->query('select id,id_auditeur, fonction,numero_audit  from auditeurprevu where auditeurprevu.numero_audit="'.$num.'" and fonction="2"');
								
								while($auditeurs1A = $selectauditeurprevuA->Fetch(PDO::FETCH_ASSOC)){
													
							$auditeursA['id_auditeur']=$auditeurs1A['id_auditeur'];
								$r1=$auditeursA['id_auditeur'];								
									$SelectAuditeurPrevuANom=$connexion->query("select nom,prenom from auditeur where auditeur.id=$r1.");
										$Aselect = $SelectAuditeurPrevuANom->Fetch(PDO::FETCH_ASSOC);
											$A['nom']=$Aselect['nom'];
												$A['prenom']=$Aselect['prenom'];
												$A['complet']=substr($A['prenom'],0,1).'.'.$A['nom'];
											$listA=$A['complet'].' , '.$listA;												
								}
								$listO='';
		$selectauditeurprevuO=$connexion->query('select id,id_auditeur, fonction,numero_audit  from auditeurprevu where auditeurprevu.numero_audit="'.$num.'" and fonction="3"');
								
								while($auditeurs1O = $selectauditeurprevuO->Fetch(PDO::FETCH_ASSOC)){
													
							$auditeursO['id_auditeur']=$auditeurs1O['id_auditeur'];
								$r1=$auditeursO['id_auditeur'];								
									$SelectAuditeurPrevuONom=$connexion->query("select nom,prenom from auditeur where auditeur.id=$r1.");
										$Oselect = $SelectAuditeurPrevuONom->Fetch(PDO::FETCH_ASSOC);
											$O['nom']=$Oselect['nom'];
												$O['prenom']=$Oselect['prenom'];
												$O['complet']=substr($O['prenom'],0,1).'.'.$O['nom'];
											$listO=$O['complet'].' , '.$listO;												
								}
								$showPF='';
		$selectPF=$connexion->query('select * from point where type ="fort" and numero_audit="'.$num.'"');
		while($PF = $selectPF->Fetch(PDO::FETCH_ASSOC)){
			$pointF=$PF['commentaire'];	
			$showPF=$showPF.'<li class="MsoNormal"><span lang="FR-CH">'.utf8_encode($pointF).'</span></li>';
			
		}
		$showPA='';
		$selectPA=$connexion->query('select * from point where type ="ameliorati" and numero_audit="'.$num.'"');
		while($PA = $selectPA->Fetch(PDO::FETCH_ASSOC)){
			$pointA=$PA['commentaire'];	
		
					$showPA=$showPA.'<li class="MsoNormal"><span lang="FR-CH">'.utf8_encode($pointA).'</span></li>';
			
		}
		$showref='';
		$selectref=$connexion->query('select * from point where type ="ref" and numero_audit="'.$num.'"');
		while($ref = $selectref->Fetch(PDO::FETCH_ASSOC)){
			$pointref=$ref['commentaire'];	
			$showref=$showref.''.utf8_encode($pointref).'';
			
		}
		$showchamp='';
		$selectchamp=$connexion->query('select * from point where type ="champ" and numero_audit="'.$num.'"');
		while($champ = $selectchamp->Fetch(PDO::FETCH_ASSOC)){
			$pointchamp=$champ['commentaire'];	
			$showchamp=$showchamp.''.utf8_encode($pointchamp).'';
			
		}
		$showEm='';
		$selectEm=$connexion->query('select * from point where type ="ecart mine" and numero_audit="'.$num.'"');
		while($Em = $selectEm->Fetch(PDO::FETCH_ASSOC)){
			$pointEm=$Em['commentaire'];	
			$showEm=$showEm.'<li class="MsoNormal"><span lang="FR-CH">'.utf8_encode($pointEm).'</span></li>';
			
		}
		$showEma='';
		$selectEma=$connexion->query('select * from point where type ="ecart maje" and numero_audit="'.$num.'"');
		while($Ema = $selectEma->Fetch(PDO::FETCH_ASSOC)){
			$pointEma=$Ema['commentaire'];	
			$showEma=$showEma.'<li class="MsoNormal"><span lang="FR-CH">'.utf8_encode($pointEma).'</span></li>';
			
		}
		$selectdiff=$connexion->query('select id_utilisateur ,num_audit  from diffusionaudit where diffusionaudit.num_audit="'.$num.'"');
								// on stock les auditeurs dans une chaine de caractère .
							$list6='';
								while($diffaudits = $selectdiff->Fetch(PDO::FETCH_ASSOC)){
														
							$diffaudit['id_utilisateur']=$diffaudits['id_utilisateur'];
								$r6=$diffaudit['id_utilisateur'];								
									$Selectdiffaudit=$connexion->query("select nom , prenom from utilisateur where utilisateur.id=$r6");
										$souhaitess = $Selectdiffaudit->Fetch(PDO::FETCH_ASSOC);
											$souhaitessss['nom']=$souhaitess['nom'];
												$souhaitessss['prenom']=$souhaitess['prenom'];													
													$souhaitessss['complet']=substr($souhaitess['prenom'],0,1).'.'.$souhaitess['nom'];
													$comp=$souhaitessss['complet'];
													$list6.=$comp.'&nbsp;;';
								}
		$selectdate=$connexion->query('select date from rapportcreeoupas where rapportcreeoupas.audit_num="'.$num.'"');
	
		while($dateselect = $selectdate->Fetch(PDO::FETCH_ASSOC)){
			$date2=$dateselect['date'];
			$date2 = date_create($date2);
			$date2=date_format($date2, 'd  / m / Y');	
			}
			
							
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Hajar El baggar');
$pdf->SetTitle('Generation des fiches d\'audits');
$pdf->SetSubject('rapport audit');
$pdf->SetKeywords('audit, rapport, mci, santée, pdf');

// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 054', PDF_HEADER_STRING);

// set header and footer fonts
// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  class YourPDF extends TCPDF {
        public function Header() {
            if (count($this->pages) === 1) { // Do this only on the first page
			
			
			$html = <<<EOD
<center>
&nbsp;<br>
&nbsp;<br>
<table style="width:100%">
	
  <tr>
    <td style="width:3%"></td>
    <td style="width:5%">
	<table border="2">
		<tr>
			<td height="50" width="150" align="center" rowspan="2">&nbsp;<br><img src="images/logomci.jpg" border="0" height="40" width="120" align="center" /></td>       
			<td  width="300" align="center" clspane="2"><b>Formulaire</b></td>       
			<td  width="140" align="center" rowspan="3">&nbsp;<br>&nbsp;<br>Management<br>QSE</td>       
		</tr>	
		<tr>        
			<td width="300" align="center">&nbsp;<br><b>RAPPORT D’AUDIT</b></td>
              
		</tr>
		<tr>        
			<td align="center">Référence</td>
			<td  width="300" align="center" clspane="2">FOR-QSE 010 c</td>              
		</tr>	
		<tr>
			<td align="center">Page/pages</td>       
			<td align="center" width="150">01/02</td>       
			<td align="center" width="150">date d'application</td> 
			<td align="center" width="140">26/02/2013</td> 
		</tr>	
	</table>
	</td>
  </tr>
</table><br>
EOD;
            }
			else{
					$html = <<<EOD
<center>
&nbsp;<br>
&nbsp;<br>
<table style="width:100%">
	
  <tr>
    <td style="width:3%"></td>
    <td style="width:5%">
	<table border="2">
		<tr>
			<td height="50" width="150" align="center" rowspan="2">&nbsp;<br><img src="images/logomci.jpg" border="0" height="40" width="120" align="center" /></td>       
			<td  width="300" align="center" clspane="2"><b>Formulaire</b></td>       
			<td  width="140" align="center" rowspan="3">&nbsp;<br>&nbsp;<br>Management<br>QSE</td>       
		</tr>	
		<tr>        
			<td width="300" align="center">&nbsp;<br><b>RAPPORT D’AUDIT</b></td>
              
		</tr>
		<tr>        
			<td align="center">Référence</td>
			<td  width="300" align="center" clspane="2">FOR-QSE 010 c</td>              
		</tr>	
		<tr>
			<td align="center">Page/pages</td>       
			<td align="center" width="150">02/02</td>       
			<td align="center" width="150">date d'application</td> 
			<td align="center" width="140">26/02/2013</td> 
		</tr>	
	</table>
	</td>
  </tr>
</table><br>
EOD;
			}

            $this->writeHTML($html, true, false, false, false, '');
        }
    }
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf = new YourPDF();
// set default monospaced font
// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// $pdf->setPrintHeader(false);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// IMPORTANT: disable font subsetting to allow users editing the document
$pdf->setFontSubsetting(false);

// set font
$pdf->SetFont('helvetica', '', 10, '', false);

// add a page
$pdf->AddPage();

//////////////////////////////////////////////////////////////////
$entete_head = '<table border="1" cellpadding="0" cellspacing="0" class="MsoNormalTable" style="width:495.0pt;margin-left:-12.6pt;border-collapse:collapse;border:none;
 mso-border-alt:thick-thin-small-gap windowtext 4.5pt;mso-yfti-tbllook:1184;
 mso-padding-alt:0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid black;
 mso-border-insidev:.5pt solid windowtext" width="660">';
$entete='
				<tr>
					<td colspan="5" valign="top" width="639">
					<p class="MsoNormal" style= "font: bold italic 12pt/24pt serif"><span><b><span lang="FR-CH">&nbsp;&nbsp;DOCUMENTS 
					AUDITES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N°audit : '.$num.' <o:p></o:p></span></b></span></p>
					<p class="MsoNormal"><span lang="FR-CH">&nbsp;&nbsp;'.$idr.' ;<o:p></o:p></span></p>
					<p class="MsoNormal"><span><b><span lang="FR-CH">&nbsp;&nbsp;ENTITE 
					AUDITEE&nbsp;<o:p></o:p></span></b></span></p>
					<p class="MsoNormal"><span lang="FR-CH">&nbsp;&nbsp;'.$ssnom.'<o:p></o:p>
					</span></p>
					<p class="MsoNormal"><span><b><span lang="FR-CH">&nbsp;&nbsp;CHAMP DE 
					L’AUDIT<o:p></o:p></span></b></span></p>
					<p class="MsoNormal"><span lang="FR-CH">&nbsp;&nbsp;'.$showchamp.'<o:p></o:p></span></p>
					<p class="MsoNormal"><span><b><span lang="FR-CH">&nbsp;&nbsp;Lieu de 
					l’audit</span></b><span lang="FR-CH">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<b>DATE DE L’AUDIT</b>&nbsp;&nbsp;'.$date.'<o:p></o:p></span></span></p>
					<p class="MsoNormal"><span lang="FR-CH">&nbsp;&nbsp;'.$lieu.'<o:p></o:p></span></p>
					<p class="MsoNormal"><span><b><span lang="FR-CH">&nbsp;&nbsp;OBJECTIF DE 
					L’AUDIT&nbsp;<o:p></o:p></span></b></span></p>
					<ul type="disc">
						'.$objectif.'
					</ul>
					<p class="MsoNormal"><span><b><span lang="FR-CH">&nbsp;&nbsp;DIFFUSION 
					DU RAPPORT D’AUDIT&nbsp;<o:p></o:p></span></b></span></p>
					<p class="MsoNormal"><span>&nbsp;'.$list6.'<o:p></o:p></span></p>
					</td>
				</tr>';
	 $entete2 =	'<tr>
					<td colspan="5" valign="top" width="639">
					<p class="MsoNormal"><span lang="FR-CH"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Durée 
					totale de l’audit du site&nbsp;:<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</span>'.$duree.'<o:p></o:p></span></p>
					</td>
				</tr>
				<tr >
					<td rowspan="4"  width="330">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sommaire rapport
					</td> 
					<td width="204">
					</td>
					<td width="105">
					N° de page
					</td> 
				</tr>
				<tr>
					
					<td width="204">
					&nbsp;&nbsp;Page de garde et sommaire
					</td>					
					<td width="105">
					&nbsp;&nbsp;1
					</td>
				</tr>
				<tr>
					
					<td width="204">&nbsp;&nbsp;Note de synthèse et conclusion</td>
					<td width="105">
					&nbsp;&nbsp;2-3
					</td>
				</tr>
				<tr>
					
					<td width="204">&nbsp;&nbsp;Fiche d’écart (FOR-QSE 007)</td>
					<td valign="top" width="105">
					&nbsp;&nbsp;&nbsp;&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="2" rowspan="2" valign="top" width="215">
					<p align="center" class="MsoNormal"><span lang="FR-CH">Responsable de 
					l’entité auditée<o:p></o:p></span></p>
					</td>
					<td width="211">
					<p align="center" class="MsoNormal"><span><b>
					<span lang="FR-CH">&nbsp;&nbsp;Nom<o:p></o:p></span></b></span></p>
					</td>
					<td colspan="2" width="213">
					<p align="center" class="MsoNormal"><span><b>
					<span lang="FR-CH">&nbsp;&nbsp;Fonction<o:p></o:p></span></b></span></p>
					</td>
				</tr>
				<tr>
					<td width="211">
					<p align="center" class="MsoNormal"><span>'.$Raaa.'<o:p></o:p></span></p>
					</td>
					<td colspan="2" width="213">
					<p align="center" class="MsoNormal"><span lang="FR-CH">'.$fct.'<o:p></o:p></span></p>
					</td>
				</tr>
					<tr>
					<td colspan="2" rowspan="'.$tab.'" valign="top" width="215">
					<p align="center" class="MsoNormal"><span lang="FR-CH">Noms, fonctions des 
					personnes rencontrées lors de l’audit<o:p></o:p></span></p>
					</td>
					<td width="211">
					<p align="center" class="MsoNormal"><span><b>
					<span lang="FR-CH">Nom<o:p></o:p></span></b></span></p>
					</td>
					<td colspan="2" width="213">
					<p align="center" class="MsoNormal"><span><b>
					<span lang="FR-CH">Fonction<o:p></o:p></span></b></span></p>
					</td>
				</tr>
				'.$lol.'
				<tr>
					<td colspan="5" valign="top" width="639">
					<p align="center" class="MsoNormal"><span><b>
					<span lang="FR-CH">Composition</span></b><span lang="FR-CH">
					<b>de l’équipe d’audit</b><o:p></o:p></span></span></p>
					</td>
				</tr>
				<tr>
					<td width="210">
					<p align="center" class="MsoNormal"><span><b><span lang="FR-CH">Fonction<o:p></o:p></span></b></span></p>
					</td>
					<td colspan="4" width="429">
					<p align="center" class="MsoNormal"><span><b><span lang="FR-CH">Nom<o:p></o:p></span></b></span></p>
					</td>
				</tr>
			<tr>
					<td width="210">
					<p align="center" class="MsoNormal"><span lang="FR-CH">Responsable d’audit<o:p></o:p></span></p>
					</td>
					<td colspan="4" width="429">
					<p align="center" class="MsoNormal"><span lang="FR-CH">'.$RAu.'<o:p></o:p></span></p>
					</td>
				</tr>
				<tr>
					<td width="210">
					<p align="center" class="MsoNormal"><span lang="FR-CH">Auditeurs<o:p></o:p></span></p>
					</td>
					<td colspan="4" width="429">
					<p align="center" class="MsoNormal"><span>'.$listA.'</span></p>
					</td>
				</tr>
				<tr>
					<td width="210">
					<p align="center" class="MsoNormal"><span lang="FR-CH">Observateurs<o:p></o:p></span></p>
					</td>
					<td colspan="4" width="429">
					<p align="center"  class="MsoNormal"><span>'.$listO.'</span></p>
					
					</td>
				</tr>
				<tr>
					<td colspan="5" valign="top" width="639">
					<p class="MsoNormal"><span lang="FR-CH">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Visa du responsable 
					audit<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</span><span></span><span>&nbsp;
					</span><span></span></span></p>
					<p class="MsoNormal"><span lang="FR-CH"><o:p>&nbsp;</o:p></span></p>
					</td>
				</tr>';
 $entete_footer ='</table><br><br>';			
			
$tt=$entete_head. $entete. $entete2. $entete_footer;
$tbl2 = <<<EOD
$tt
EOD;

// $pdf->writeHTML($tbl, true, false, false, false, '');
// $pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');

$pdf->writeHTML($tbl2, true, false, false, false, '');
$pdf->AddPage();
$entete_head = '<table border="1" cellpadding="0" cellspacing="0" class="MsoNormalTable" style="width:495.0pt;margin-left:-12.6pt;border-collapse:collapse;border:none;
 mso-border-alt:thick-thin-small-gap windowtext 4.5pt;mso-yfti-tbllook:1184;
 mso-padding-alt:0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid black;
 mso-border-insidev:.5pt solid windowtext" width="660">';
$entete='
				<tr>
					<td valign="top" width="639">					
					<p align="center" class="MsoNormal"><b><span lang="FR-CH">
					NOTE DE SYNTHESE&nbsp;: CONCLUSIONS<o:p></o:p></span></b></p>					
					</td>
				</tr>';
	 $entete2 =	'
				
				<tr>
					<td width="639">
					<p class="MsoNormal"><span lang="FR-CH">Référentiel Chapitre <o:p></o:p>
					</span></p>
					</td>
				</tr>
				<tr>
					<td valign="top" width="639">					
					<p class="MsoNormal"><span lang="FR-CH">'.$showref.'<o:p></o:p></span></p>					
					<p class="MsoNormal"><b><u><span lang="FR-CH">Points forts&nbsp;:<o:p></o:p></span></u></b></p>
					<ul type="disc">
						'.$showPF.';
					</ul>
					
					<p class="MsoNormal"><b><u><span lang="FR-CH">Propositions 
					d’amélioration&nbsp;:<o:p></o:p></span></u></b></p>					
					<ul type="disc">
						'.$showPA.';
					</ul>					
					<p class="MsoNormal"><b><u><span lang="FR-CH">
					Ecarts&nbsp;Majeurs:<o:p></o:p></span></u></b></p>
					<ul type="disc">
					'.$showEma.'
					</ul>					
					<p class="MsoNormal"><b><u><span lang="FR-CH">
					Ecarts&nbsp;mineurs:<o:p></o:p></span></u></b></p>
					<ul type="disc">
					'.$showEm.'
					</ul>						
					
					</td>
				</tr>			
';
 $entete_footer ='</table><br><br>';			
			
$tt=$entete_head. $entete. $entete2. $entete_footer;
$tbl2 = <<<EOD
$tt
EOD;

// $pdf->writeHTML($tbl, true, false, false, false, '');
// $pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');

$pdf->writeHTML($tbl2, true, false, false, false, '');
// ---------------------------------------------------------
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
ob_end_clean(); 
$pdf->Output('Rapport.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+
