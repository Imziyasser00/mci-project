 <?php
require_once('tcpdf_include.php');
if (isset($_POST['dateapp'])){
$dateapp=$_POST['dateapp'];
}
else{
	$dateapp=0;
}

if(isset($_POST['ref'])){
$ref=$_POST['ref'];
}
else{
	$ref=0;
}


// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
class MYPDF extends TCPDF{
    function header1(){
        //print whatever the header 1 is
    }
    function Header2(){         
        if($this->page==1){
            //print header 1 and whatever the header 2 is
        }else{
            //print just header 2   
        }
    }
}
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 054');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 054', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
$tbl = <<<EOD
<center><table cellspacing="1" cellpadding="1" border="1">
    <tr>
        <td height="60" width="160" align="center" rowspan="2"><img src="images/logomci.jpg" border="0" height="60" width="120" align="center" /></td>       
        <td  width="320" align="center" clspane="2"><b>Formulaire</b></td>       
        <td  width="140" align="center" rowspan="3">&nbsp;<br>&nbsp;<br>Management<br>QSE</td>       
    </tr>	
	 <tr>        
        <td width="320" align="center">&nbsp;<br><b>LISTE DES AUDITEURS INTERNES</b></td>
              
    </tr>
	<tr>        
        <td align="center">Référence</td>
        <td  width="320" align="center" clspane="2">$ref</td>              
    </tr>	
	<tr>
		<td align="center">Page/pages</td>       
        <td align="center" width="160">01/01</td>       
        <td align="center" width="160">date d'application</td> 
        <td align="center" width="140">$dateapp</td> 
	</tr>	
</table><br><br><br><br><br>
EOD;
// $pdf->SetXY(16, 28);
// $pdf->Image('images/logomci.jpg', '', '', 44, 16, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
 $pdf->writeHTML($tbl, true, false, false, false, '');

$tbl_header = '<center><table border="1" cellpadding="2" cellspacing="2">';		
$tbl_footer = '</table></center>';
$tbl3 = '<thead><tr style="background-color:#95A5A6;">
		<th rowspan="2" align="center">
			&nbsp;<br><b>Nom de l\'AUDITEUR</b>
		</th>
		<th rowspan="2" align="center">
		&nbsp;<br><b>FONCTION</b>
		</th>
		<th colspan="2" align="center">
		<b>QUALIFICATION</b>
		</th>
		</tr>
		<tr  style="background-color:#95A5A6;">
		<th align="center">
		<b>QSE</b>
		</th>	
		<th align="center">
		<b>BPF</b>
		</th>
		</tr></thead>';

// foreach item in your array...
$host="localhost";
$username="root";
$password="";
$db_name="mci";
$sql=mysqli_connect($host, $username, $password,$db_name) or die("cannot connect"); 
// $sql = "select nom, fonction from auditeur";
$auditeur = $sql->query("select qse, bpf, nom, prenom, fonction from auditeur");

if (false === $auditeur) {
    echo mysql_error();
}		
		while($auditeurs = mysqli_fetch_array($auditeur)){
							$nom=$auditeurs['nom'];
							$prenom=$auditeurs['prenom'];
							$fonction=$auditeurs['fonction'];   
							$qse=$auditeurs['qse'];   
							$bpf=$auditeurs['bpf']; 
							if($qse==1){
							$qse='x';	
							}
							else{
							$qse='';	
							}
							$bpf=$auditeurs['bpf'];
							if($bpf==1){
							$bpf='x';	
							}
							else{
							$bpf='';	
							}
							 if($fonction=="RA"){
								$fonction="Responsable d'audit";
							}
							elseif($fonction=="A"){
								$fonction="Auditeur";
							}
							elseif($fonction=="O"){
								$fonction="Observateur";
							}		
							

    $tbl4 .= '<tr>
									<td align="center">
									 '.$nom .' '. $prenom .'
								</td>
								<td align="center">
									 '.$fonction.'
								</td>
								<td align="center">
									 <b>'.$qse.'</b>
								</td>
								<td align="center">
									 <b>'.$bpf.'</b>
								</td>
								
            </tr>';
     }$tt=$tbl_header. $tbl3 . $tbl4 . $tbl_footer;
	 $tbl2 = <<<EOD
$tt
EOD;

// $pdf->writeHTML($tbl, true, false, false, false, '');
// $pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');

$pdf->writeHTML($tbl2, true, false, false, false, '');
// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
 ob_end_clean(); 
$pdf->Output('Liste des auditeurs internes.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+
