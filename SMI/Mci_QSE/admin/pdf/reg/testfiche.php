 <?php
session_start();
require_once('tcpdf_include.php');


if(isset($_GET['num']) ){
$num=$_GET['num'];
}
else{
	// header("Location: 404.html");
	$num=$_GET['num'];
}

?>
<?php 
		include_once 'bd.php';
		$selectall=$connexion->prepare("select date , objectif , idr from fichdaudit where audit_num=?");
		$selectall->execute(array($num));
		$objt = $selectall->Fetch(PDO::FETCH_ASSOC);
		$date = $objt['date'];
		$date = date_create($date);
		$date=date_format($date, 'd  / m / Y');
		$objectif = utf8_encode($objt['objectif']);
		$idr = utf8_encode($objt['idr']);
		?>
<?php
																	include_once 'bd.php';
																	$req1=$connexion->query("select id_auditeur from auditeurprevu where numero_audit='$num' and fonction='RA'");	
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																		$r1=$obj['id_auditeur'];
																		
																			$SelectAuditeurPrevuNom=$connexion->query("select nom,prenom from auditeur where auditeur.id=$r1.");
																			$auditeurselect = $SelectAuditeurPrevuNom->Fetch(PDO::FETCH_ASSOC);
																				$auditeurs['nom']=$auditeurselect['nom'];
																						$auditeurs['prenom']=$auditeurselect['prenom'];
																								$auditeurs['complet']=$auditeurs['nom'].' '.$auditeurselect['prenom'];
																										$list=$auditeurs['complet'];
																			
																	}	
																	}
														?>	
	<?php $req1=$connexion->query("select id_sservice from auditprevu where numero='$num'");	
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																		$r2=$obj['id_sservice'];
																			$Selectsservice=$connexion->query("select nom from sservice where id=$r2");
																					$sservice = $Selectsservice->Fetch(PDO::FETCH_ASSOC);
																						$sservicenom=$sservice['nom'];
																	}
																	}
															?>
	<?php 
				$selectauditeurprevu=$connexion->query('select id,id_auditeur, fonction,numero_audit  from auditeurprevu where auditeurprevu.numero_audit="'.$num.'" order by id');
								// on stock les auditeurs dans une chaine de caractère .
							$list2='';
								while($auditeurs1 = $selectauditeurprevu->Fetch(PDO::FETCH_ASSOC)){
							$id=$auditeurs1['id'];
							$auditeurs['fonction']=$auditeurs1['fonction'];
							$auditeurs['id_auditeur']=$auditeurs1['id_auditeur'];
								$r1=$auditeurs['id_auditeur'];
								
									$SelectAuditeurPrevuNom=$connexion->query("select nom,prenom from auditeur where auditeur.id=$r1.");
										$auditeurselect = $SelectAuditeurPrevuNom->Fetch(PDO::FETCH_ASSOC);
											$auditeurs['nom']=$auditeurselect['nom'];
												$auditeurs['prenom']=$auditeurselect['prenom'];
													$auditeurs['complet']=$auditeurs['nom'].'.'.$auditeurselect['prenom'];
													$list2.='<br>&nbsp;'.$auditeurs['complet'];
								}
					?>
		<?php 
				$selectauditee=$connexion->query('select id, id_utilisateur ,num_audit  from auditee where auditee.num_audit="'.$num.'" order by id');
								// on stock les auditeurs dans une chaine de caractère .
							$list3='';
								while($auditees1 = $selectauditee->Fetch(PDO::FETCH_ASSOC)){
														
							$auditees['id_utilisateur']=$auditees1['id_utilisateur'];
								$r3=$auditees['id_utilisateur'];								
									$SelectAuditeeNom=$connexion->query("select nom,prenom from utilisateur where utilisateur.id=$r3.");
										$auditeeselect = $SelectAuditeeNom->Fetch(PDO::FETCH_ASSOC);
											$audites['nom']=$auditeeselect['nom'];
												$audites['prenom']=$auditeeselect['prenom'];
													$audites['complet']=$audites['nom'].' '.$auditeeselect['prenom'];
													$list3.='<br>&nbsp;'.$audites['complet'];
								}
					?>
<?php 
				$selectclosouhait=$connexion->query('select id, id_utilisateur ,num_audit  from presencecloture where presencecloture.num_audit="'.$num.'" order by id');
								// on stock les auditeurs dans une chaine de caractère .
							$list5='';
								while($souhaites = $selectclosouhait->Fetch(PDO::FETCH_ASSOC)){
														
							$souhaite['id_utilisateur']=$souhaites['id_utilisateur'];
								$r5=$souhaite['id_utilisateur'];								
									$Selectsouhaite=$connexion->query("select nom , prenom from utilisateur where utilisateur.id=$r5");
										$souhaitess = $Selectsouhaite->Fetch(PDO::FETCH_ASSOC);
											$souhaitessss['nom']=$souhaitess['nom'];
												$souhaitessss['prenom']=$souhaitess['prenom'];
													$souhaitessss['complet']=$souhaitess['nom'].' '.$souhaitess['prenom'];
													$list5.='<br>&nbsp;'.$souhaitessss['complet'].'  ';
								}
					?>
				<?php 
				$selectousouhait=$connexion->query('select id, id_utilisateur ,num_audit  from presenceouverture where presenceouverture.num_audit="'.$num.'" order by id');
								// on stock les auditeurs dans une chaine de caractère .
							$list6='';
								while($souhaites = $selectousouhait->Fetch(PDO::FETCH_ASSOC)){
														
							$souhaite['id_utilisateur']=$souhaites['id_utilisateur'];
								$r6=$souhaite['id_utilisateur'];								
									$Selectsouhaite=$connexion->query("select nom , prenom from utilisateur where utilisateur.id=$r6");
										$souhaitess = $Selectsouhaite->Fetch(PDO::FETCH_ASSOC);
											$souhaitessss['nom']=$souhaitess['nom'];
												$souhaitessss['prenom']=$souhaitess['prenom'];
													$souhaitessss['complet']=$souhaitess['nom'].' '.$souhaitess['prenom'];
													$list6.='<br>&nbsp;'.$souhaitessss['complet'].'  ';
								}

				$selectouverture=$connexion->query("select date , time from reunionouverture where numero='$num'");
				$ouverture = $selectouverture->Fetch(PDO::FETCH_ASSOC);
				$date=$ouverture['date'];
				$time=$ouverture['time'];

				$selectcloture=$connexion->query("select date , time from reunioncloture where numero='$num'");
				$cloture = $selectcloture->Fetch(PDO::FETCH_ASSOC);
				$dateclo=$cloture['date'];
				$timeclo=$cloture['time'];
				
				$ficheid=$connexion->prepare('select id from fichdaudit where audit_num=?');
					$ficheid->execute(array($num));
						$objt = $ficheid->Fetch(PDO::FETCH_ASSOC);
							$id_fiche=$objt['id'];
				
			$rep1='';
			$rep2='';	
			$rep3='';	
			$comp=$connexion->prepare('select * from fichecompet where id_fiche=?');
			$comp->execute(array($id_fiche));
			$valcomp = $comp->Fetch(PDO::FETCH_ASSOC);
			$rep1=$valcomp['reponse1'];
			$rep2=$valcomp['reponse2'];
			$comp2=$connexion->prepare('select * from fichecomqse where id_fiche=?');
			$comp2->execute(array($id_fiche));
			$valcomp2 = $comp2->Fetch(PDO::FETCH_ASSOC);
			$rep3=utf8_encode($valcomp2['commentaire']);
			
							
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Hajar El baggar');
$pdf->SetTitle('Generation des fiches d\'audits');
$pdf->SetSubject('Auditeurs');
$pdf->SetKeywords('audit, fiche, mci, santée, pdf');

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
			<td width="300" align="center">&nbsp;<br><b>FICHE D’audit INTERNE</b></td>
              
		</tr>
		<tr>        
			<td align="center">Référence</td>
			<td  width="300" align="center" clspane="2">FOR-QSE 032 b</td>              
		</tr>	
		<tr>
			<td align="center">Page/pages</td>       
			<td align="center" width="150">01/01</td>       
			<td align="center" width="150">date d'application</td> 
			<td align="center" width="140">26/02/2013</td> 
		</tr>	
	</table>
	</td>
  </tr>
</table><br><br>
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

$tt='<table border="1" cellpadding="0" cellspacing="0" class="MsoNormalTable" style="width:495.0pt;margin-left:-12.6pt;border-collapse:collapse;border:none;
 mso-border-alt:thick-thin-small-gap windowtext 4.5pt;mso-yfti-tbllook:1184;
 mso-padding-alt:0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid black;
 mso-border-insidev:.5pt solid windowtext" width="660">
				<tr>
		
			<table border="1" cellpadding="0" cellspacing="0" class="MsoNormalTable" style="width:495.0pt;margin-left:-12.6pt;border-collapse:collapse;border:none;
 mso-border-alt:thick-thin-small-gap windowtext 4.5pt;mso-yfti-tbllook:1184;
 mso-padding-alt:0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid black;
 mso-border-insidev:.5pt solid windowtext" width="660">
				<tr>
					<td width="288">
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal"><span>&nbsp;&nbsp;Date de l’audit&nbsp;:&nbsp; '. $date .' <o:p></o:p></span></p>
					</td>
		
					<td colspan="2" width="372">
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal"><span>&nbsp;&nbsp;Responsable d’audit&nbsp;&nbsp;: &nbsp;&nbsp;'. $list .'<o:p></o:p></span></p>
					</td>
				</tr>
				<tr>
					<td colspan="3" width="660">
				
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;line-height:normal"><span>&nbsp;&nbsp;Champ de 
					l’activité auditée&nbsp;&nbsp;: &nbsp;&nbsp;<b><i>'.$sservicenom.' </i></b><o:p></o:p></span></p>
					<p class="MsoNormal" style="mso-margin-bottom-alt:auto;line-height:normal">
					<span><o:p>&nbsp;</o:p></span></p>
					</td>
				</tr>
				<tr>
					<td colspan="3" valign="top" width="660">
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span>&nbsp;&nbsp;Objectifs de l’audit&nbsp;: <o:p></o:p></span>
					</p>
					<p align="center" class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><b><i><span>&nbsp;&nbsp;'.$objectif.'<o:p></o:p></span></i></b></p>
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;line-height:
  normal"><span><o:p>&nbsp;</o:p></span></p>
					</td>
				</tr>
				<tr>
					<td colspan="3" valign="top" width="660">
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;line-height:
  normal"><span>&nbsp;&nbsp;&nbsp;&nbsp;Identification des documents de référence&nbsp;: <o:p></o:p></span>
					</p>
					<p align="center" class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;
  margin-bottom:0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:center;
  line-height:normal"><b><i><span>&nbsp;&nbsp;'.$idr.'<o:p></o:p></span></i></b></p>
					</td>
				</tr>
				<tr>
					<td colspan="2" valign="top" width="330">
			
				
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;line-height:
  normal"><b><span>&nbsp;&nbsp;&nbsp;&nbsp;Auditeurs</span></b><span> : <b><i>'.$list2.'</i></b><o:p></o:p></span></p>
					
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span>&nbsp;Responsable&nbsp;: <o:p></o:p></span></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span>&nbsp;Visa&nbsp;:<o:p></o:p></span></p>
					
					</td>
					<td valign="top" width="330">
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;line-height:
  normal"><b><span>&nbsp;&nbsp;&nbsp;&nbsp;Audités </span></b><span>: <b><i>&nbsp;'.$list3.'</i></b><o:p></o:p></span></p>
				
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span>&nbsp;Responsable&nbsp;: <o:p></o:p></span></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span>&nbsp;Visa&nbsp;:<o:p></o:p></span></p>
					
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span><o:p>&nbsp;</o:p></span></p>
					</td>
				</tr>
				<tr>
					<td colspan="2" valign="top" width="330">
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;line-height:
  normal"><b><span>&nbsp;&nbsp;Réunion d’ouverture : <o:p></o:p></span></b></p>					
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span>&nbsp;Date&nbsp;: <b><i>'. $date.'</i></b><o:p></o:p></span></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span>&nbsp;Heure&nbsp;: <b><i>'. $time.'</i></b><o:p></o:p></span></p>
					
					</td>
					<td valign="top" width="330">
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;line-height:
  normal"><b><span>Présence souhaitée de&nbsp;: <o:p></o:p></span></b></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><b><i><span>'.$list6.' <o:p></o:p></span>
					</i></b></p>				
					</td>
				</tr>
				<tr>
					<td colspan="2" valign="top" width="330">
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;line-height:
  normal"><b><span>&nbsp;&nbsp;Réunion de clôture : <o:p></o:p></span></b></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span>&nbsp;Date&nbsp;&nbsp;: &nbsp;<b><i>'.$dateclo.'</i></b><o:p></o:p></span></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span>&nbsp;Heure&nbsp;&nbsp;:&nbsp;<b><i>'. $timeclo .'</i></b><o:p></o:p></span></p>
					
					</td>
					<td valign="top" width="330">
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;line-height:
  normal"><b><span>Présence souhaitée de&nbsp;: <o:p></o:p></span></b></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><b><i><span>'.$list5.'<o:p></o:p></span>
					</i></b></p>
					
					</td>
				</tr>
				<tr>
					<td colspan="3" valign="top" width="660">
					<p class="MsoNormal" style="margin-top:6.0pt;mso-margin-bottom-alt:auto;
  text-align:justify;line-height:normal"><b><span>Conclusions de l\'auditeur vis 
					à vis de l\'activité auditée&nbsp;: <o:p></o:p></span></b></p>
					<p class="MsoNormal" style="mso-margin-bottom-alt:auto;text-align:justify;
  line-height:normal"><span>Les activités et résultats audités satisfont aux 
					dispositions préétablies ?&nbsp;&nbsp; <o:p></o:p></span>
					</p>
					<p class="MsoNormal" style="mso-margin-bottom-alt:auto;text-align:justify;
  line-height:normal"><b><i><span>'.$rep1.'.<o:p></o:p></span></i></b></p>
					<p class="MsoNormal" style="mso-margin-bottom-alt:auto;text-align:justify;
  line-height:normal"><span>Ces dispositions sont mises en œuvre de façon 
					efficace et aptes à atteindre les objectifs?<o:p></o:p></span></p>
					<p class="MsoNormal" style="mso-margin-bottom-alt:auto;text-align:justify;
  line-height:normal"><b><i><span>'.$rep2.'.<o:p></o:p></span></i></b></p>
					</td>
				</tr>
				<tr>
					<td colspan="3" valign="top" width="660">
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;line-height:
  normal"><b><span>Commentaires du Responsable MQSE&nbsp;sur le déroulement de 
					l’audit : <o:p></o:p></span></b></p>
					<p class="MsoNormal" style="mso-margin-bottom-alt:auto;text-align:justify;
  line-height:normal"><b><span>'.$rep3.' <o:p></o:p></span></b></p>
					
					</td>
				</tr>
			
			</table>';
$tbl2 = <<<EOD
$tt
EOD;

$pdf->writeHTML($tbl2, true, false, false, false, '');

// ---------------------------------------------------------
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
ob_end_clean(); 
$pdf->Output('plansemestre.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+
