 <?php
session_start();
require_once('tcpdf_include.php');
if(isset($_POST['ann'])){
// $num=$_GET['num'];

$ann=$_POST['ann'];
}
else{
	header("Location: 404.html");
}
$prenom = $_SESSION['prenom'];
$nom = $_SESSION['nom'];
$red=substr($prenom,0,1).'.'.$nom;
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Hajar El baggar');
$pdf->SetTitle('Generation des plan d\'audits');
$pdf->SetSubject('Auditeurs');
$pdf->SetKeywords('audit, auditeurs, mci, santée, pdf, plan');

// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
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
$Dred='';
if(isset($_POST['Dred'])){
	$Dred=$_POST['Dred'];
}
$Dver='';
if(isset($_POST['Drev'])){
	$Dver=$_POST['Drev'];
}
$DApp='';
if(isset($_POST['DApp'])){
	$DApp=$_POST['DApp'];
}	
//////////////////////////////////////////////////////////////////
$entete_head = '<table border="1">';
 $entete =
		'<tr>
			<th align="center">
				
			</th>
			<th align="center">
				Rédacteur
			</th>
			<th align="center">
				Vérificateur  
			</th>
			<th align="center">
				Approbateur  
			</th>
		</tr>';
 $entete2 =
		'<tr>	
			<td align="center">
				<b>Nom <br>
				Service	</b>
			</td>
			<td align="center">
				'.$red.' <br>
				Management QSE
			</td>
			<td align="center">
				Comité QSE <br>
				Management QSE
			</td>
			<td align="center">
				K .TADLAOUI <br>
				Direction Générale
			</td>
		</tr>		
		<tr>
			<td align="center">
				<b>Date
				</b>
			</td>
			<td align="center">
				'.$Dred.'
			</td>
			<td align="center">
				'.$Dver.'
			</td>
			<td align="center">
				'.$DApp.'
			</td>
		</tr>
		<tr>
			<td align="center" height="50">
				&nbsp;<br><b>VISA
				</b>
			</td>
			<td align="center">
				
			</td>
			<td align="center">
				
			</td>
			<td align="center">
				
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
$pdf->SetFont('times', '', 10);
// ---------------------------------------------------------
$corps_head = '
<table style="width:100%">
	
  <tr>
    <td style="width:5%"></td>
    <td style="width:90%">
	<table border="1">';
 $corps =
		'<tr>
			<th align="center" width="50">
				N°
			</th>
			<th align="center">
				Processus
			</th>
			<th align="center">
				Date  
			</th>
			<th align="center"  width="250">
				Auditeurs  
			</th>
			<th align="center"  width="50">
				Durée  
			</th>
		</tr>';
		include_once'bd.php';
$selectaudit=$connexion->query("select numero, id_service,id_sservice, ddatep, fdatep,duree  from auditprevu where  ann=$ann");
							while($audits = $selectaudit->Fetch(PDO::FETCH_ASSOC)){
								$numero=$audits['numero'];
								$duree=$audits['duree'];
								$ddatep=$audits['ddatep'];
								$fdatep=$audits['fdatep'];
								$ddatep = date_create($ddatep);
								$fdatep = date_create($fdatep);
								$date1=date_format($ddatep, 'd/m/Y');
								$date2=date_format($fdatep, 'd/m/Y');
								$interval='<b>Entre </b>'.$date1.'<br><b> et </b>'.$date2;
								$id_sservice=$audits['id_sservice'];
								$selectnomss=$connexion->query("select nom from sservice where id=$id_sservice");
								$sservice = $selectnomss->Fetch(PDO::FETCH_ASSOC);
								$ssnom=utf8_encode($sservice ['nom']);
								$selectauditeurprevu=$connexion->query('select id,id_auditeur, fonction,numero_audit  from auditeurprevu where auditeurprevu.numero_audit="'.$numero.'" order by id');
								// on stock les auditeurs dans une chaine de caractère .
								$count=$selectauditeurprevu->rowcount();
								$i=0;
							$list='';
							$list[$count]='';
								while($auditeurs1 = $selectauditeurprevu->Fetch(PDO::FETCH_ASSOC)){
							$id=$auditeurs1['id'];
							$auditeurs['fonction']=$auditeurs1['fonction'];
							$auditeurs['id_auditeur']=$auditeurs1['id_auditeur'];
								$r1=$auditeurs['id_auditeur'];
								
									$SelectAuditeurPrevuNom=$connexion->query("select nom,prenom from auditeur where auditeur.id=$r1.");
										$auditeurselect = $SelectAuditeurPrevuNom->Fetch(PDO::FETCH_ASSOC);
											$auditeurs['nom']=$auditeurselect['nom'];
												$auditeurs['prenom']=$auditeurselect['prenom'];
													$auditeurs['complet']=substr($auditeurs['prenom'],0,1).'.'.$auditeurselect['nom'];
													$list[$i]=' <b> '.$auditeurs['fonction'].'</b> : '.$auditeurs['complet'].' ';
													$i++;
								}
							// ucfirst ($auditeurs[$id]['complet']
								if($count==3){
									$list=$list[0]. $list[1]. '<br>'. $list[2] .$list[3];	
								}
								if($count==4){
									$list=$list[0]. $list[1]. '<br>'. $list[2] .$list[3] .'<br>'. $list[4];	
								}
								if($count==5){
									$list=$list[0]. $list[1]. '<br>'. $list[2] .$list[3] .'<br>'. $list[4] . $list[5] ;	
								}
						$corps.='
							<tr>							
								<td align="center">
									 '.$numero.'
								</td>
								<td align="center">
									'.$ssnom.'
								</td>
								<td align="center">
									'.$interval.' 
								</td >
								<td>
									'.$list.'
								</td>
								<td align="center">
									'.$duree.'
								</td>									
							</tr>';
							}
	$corps_footer='</table></td></tr></table>';
					$tt=$corps_head. $corps . $corps_footer;
	 $tbl2 = <<<EOD
$tt
EOD;
$pdf->writeHTML($tbl2, true, false, false, false, '');
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
 ob_end_clean(); 
$pdf->Output('planann.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+
