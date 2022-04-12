 <?php
 
session_start();
require_once('tcpdf_include.php');
if(isset($_GET['ann'])){
// $num=$_GET['num'];

$ann=$_GET['ann'];
}
else{
	header("Location: 404.html");
}
function fonction($fonction)
							{
								if($fonction=="1"){
									return "RA";
								}
								elseif($fonction=="2"){
									return "A";
								}
								elseif($fonction=="3"){
									return "O";
								}
								else {
									return "#Erreur";}
							}
function sservice($nom)
							{
								if($nom=="Controle in-Vivo"){
									return "Contrôle in-Vivo";
								}
								elseif($nom=="Controle Physico-Chimique"){
									return "Contrôle Physico-Chimique";
								}
								elseif($nom=="Controle Microbiologique"){
									return "Contrôle Microbiologique";
								}
								elseif($nom=="Controle in-vitro"){
									return "Contrôle in-vitro";
								}
								elseif($nom=="Controle Qualite"){
									return "Contrôle Qualité";
								}
								elseif($nom=="Assurance Qualite"){
									return "Assurance Qualité";
								}
								elseif($nom=="Systeme d information"){
									return "Système d'information";
								}
								elseif($nom=="Comptabilite et Finance"){
									return "Comptabilité et Finance";
								}
								elseif($nom=="Services Generaux"){
									return "Services Généraux";
								}
								elseif($nom=="Methodes et validations"){
									return "Méthodes et validations";
								}
								elseif($nom=="Homologation & Affaires reglementaires"){
									return "Homologation & Affaires réglementaires";
								}
								elseif($nom=="Recherche et developpement"){
									return "Recherche et développement";
								}
								elseif($nom=="Systeme de management integre"){
									return "Système de management intégré";
								}elseif($nom=="Outils D aide à la Decision"){
									return "Outils D’aide à la Decision";
								}elseif($nom=="Maintenance"){
									return "Maintenance";
								}elseif($nom=="MSFP : VACCINS VIVANTS"){
									return "MSFP : VACCINS VIVANTS";
								}elseif($nom=="Production Bacteriologique"){
									return "Production Bacteriologique";
								}elseif($nom=="Commercial"){
									return "Commercial";
								}elseif($nom=="Production pharmaceutique"){
									return "Production pharmaceutique";
								}elseif($nom=="Affaires reglementaires"){
									return "Affaires reglementaires";
								}elseif($nom=="Production Virologique"){
									return "Production Virologique";
								}elseif($nom=="Marketing et Soutien Technique"){
									return "Marketing et Soutien Technique";
								}elseif($nom=="Logistique"){
									return "Logistique";
								}elseif($nom=="Achat"){
									return "Achat";
								}elseif($nom=="Ressources Humaines"){
									return "Ressources Humaines";
									
								}elseif($nom=="Controle de gestion"){
									return "Contrôle de gestion";
									
								}elseif($nom=="Qualification et Metrologie"){
									return "Qualification et Métrolgie";
								}elseif($nom=="MSFP : VACCINS INACTIVES"){
									return "MSFP : Vaccins Inactivés";
								}elseif($nom=="Validation"){
									return "Validation";	
								}elseif($nom=="Approvisionnement"){
									return "Approvisionnement";	
								}elseif($nom=="Gestion Relations Clients"){
									return "Gestion Relations Clients";	
								}
								else{
									$nom='test';
									return $nom;
								}
							} 							
$prenom = $_SESSION['prenom'];
$nom = $_SESSION['nom'];
$red=substr($prenom,0,1).'.'.$nom;

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
$pdf->SetFont('times', 'BI', 16 , '', 'false');
// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
  if($ann < 2018){
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
			<td  width="300" align="center" clspane="2" height="25"><br><b>FORMULAIRE</b></td>       
			<td  width="140" align="center" rowspan="3">&nbsp;&nbsp;<br><br><b>Management<br>QSE</b></td>       
		</tr>	
		<tr>        
			<td width="300" align="center" height="25"><br><br><b>PLAN D'AUDIT </b><br></td>
              
		</tr>
		<tr>        
			<td align="center">Référence</td>
			<td  width="300" align="center" clspane="2">FOR-QSE 009 g</td>              
		</tr>	
		<tr>
			<td align="center">Page/pages</td>       
			<td align="center" width="150">01/01</td>       
			<td align="center" width="150">Date d'application</td> 
			<td align="center" width="140">01/02/2018</td> 
		</tr>	
	</table>
	</td>
  </tr>
</table><br><br><br><br><br>
EOD;
            }

            $this->writeHTML($html, true, false, false, false, '');
        }
    }
    }
	else{
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
			<td  width="300" align="center" clspane="2" height="25"><br><b>FORMULAIRE</b></td>       
			<td  width="140" align="center" rowspan="3">&nbsp;&nbsp;<br><br><b>Management<br>QSE</b></td>       
		</tr>	
		<tr>        
			<td width="300" align="center" height="25"><br><br><b>PLAN D'AUDIT </b><br></td>
              
		</tr>
		<tr>        
			<td align="center">Référence</td>
			<td  width="300" align="center" clspane="2">FOR-QSE 009 g</td>              
		</tr>	
		<tr>
			<td align="center">Page/pages</td>       
			<td align="center" width="150">01/01</td>       
			<td align="center" width="150">Date d'application</td> 
			<td align="center" width="140">01/02/2018</td> 
		</tr>	
	</table>
	</td>
  </tr>
</table><br><br><br><br><br>
EOD;
            }

            $this->writeHTML($html, true, false, false, false, '');
        }
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
$pdf->setFontSubsetting(true);

// set font
$pdf->SetFont('times', 'BI', 12);

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

$pdf->SetFont('times', '', 10);
// ---------------------------------------------------------
$corps_head = '
<table style="width:100%">
	
  <tr>
    <td style="width:1%"></td>
    <td style="width:98%">
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
$selectaudit=$connexion->query("select *  from auditprevu where ann='".$ann."' order by numero");
						while($audits = $selectaudit->Fetch(PDO::FETCH_ASSOC)){
								//$numero=$audits['numero'];
								$numero=$audits['numero'];
								$duree=$audits['duree'];
								$date1=$audits['ddatep'];
								$date2=$audits['fdatep'];
								$interval='<b>Entre </b>'.$date1.'<br><b> et </b>'.$date2;
								$id_sservice=$audits['id_sservice'];
								$selectnomss=$connexion->query("select nom from sservice where id=$id_sservice");
								$sservice = $selectnomss->Fetch(PDO::FETCH_ASSOC);
								$ssnom=$sservice ['nom'];
								$ssnom=sservice($ssnom);
								//Modification spécial pour Audit 2018 Début
								if( $numero == '24/18' and $ssnom == 'Assurance Qualité' ){
								$ssnom = 'Assurance Qualité : Gestion documentaire';	
								}
								// Fin
								$selectauditeurprevu=$connexion->query('select id,id_auditeur, fonction,numero_audit  from auditeurprevu where auditeurprevu.numero_audit="'.$numero.'"');
								// on stock les auditeurs dans une chaine de caractère .
								$count=$selectauditeurprevu->rowcount();
								$i=0;							
							
								while($auditeurs1 = $selectauditeurprevu->Fetch(PDO::FETCH_ASSOC)){
							$id=$auditeurs1['id'];
							$auditeurs['fonction']=fonction($auditeurs1['fonction']);
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
									$all=$list[0]. $list[1]. '<br>'. $list[2] ;	
								}
									if($count==4){
									$all=$list[0]. $list[1]. '<br>'. $list[2] .$list[3];	
								}
								if($count==5){
									$all=$list[0]. $list[1]. '<br>'. $list[2] .$list[3] .'<br>'. $list[4];	
								}
								if($count==6){
									$all=$list[0]. $list[1]. '<br>'. $list[2] .$list[3] .'<br>'. $list[4] . $list[5] ;	
								}
						//Modification spécial pour Audit 2018 Début
						if( $numero == '25/18' and $ssnom == 'Assurance Qualité' ){
						$corps.='<br>
							<tr>							
								<td align="center">
									 '.$numero.'
								</td>
								<td align="center">
									'.$ssnom.'
								</td>
								<td align="center">
									<br>'.$interval.' 
								</td >
								<td>
									'.$all.'
								</td>
								<td align="center">
									'.$duree.'
								</td>
								
							</tr>';	
								}
								// Fin
									
						else{		
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
									'.$all.'
								</td>
								<td align="center">
									'.$duree.'
								</td>
								
							</tr>';
						}
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
$pdf->Output('planaudit'.$ann.'.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+
