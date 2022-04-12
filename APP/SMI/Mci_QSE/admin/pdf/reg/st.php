 <?php
//============================================================+
// File name   : example_054.php
// Begin       : 2009-09-07
// Last Update : 2013-05-14
//
// Description : Example 054 for TCPDF class
//               XHTML Forms
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
 * @abstract TCPDF - Example: XHTML Forms
 * @author Nicola Asuni
 * @since 2009-09-07
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 054');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 054', PDF_HEADER_STRING);

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


$tbl_header = '<table style="width: 638px;" cellspacing="0"><tr>
		<th rowspan="2">
			<center>Auditeur</center>
		</th>
		<th rowspan="2">
		<center>Fonction</center>
		</th>								
		<th colspan="2">
		<center>Qualification</center>
		</th>
		</tr>
		<tr>
		<th>
		<center>Qse</center>
		</th>
		th>
		<center>BPF</center>
		</th>								
	</tr>';
$tbl_footer = '</table>';
$tbl = '';

// foreach item in your array...
include 'bd.php';
		$selectauditeur=$connexion->query("select nom, fonction, qse, bpf  from auditeur");
		
		while($auditeurs = $selectauditeur->Fetch(PDO::FETCH_ASSOC)){
							$nom=$auditeurs['nom'];
							$fonction=$auditeurs['fonction'];
    if($fonction=="RA"){
								$fonction="Responsable d'audit";
							}
							elseif($fonction=="A"){
								$fonction="Auditeur";
							}
							elseif($fonction=="O"){
								$fonction="Observateur";
							}						
							$qse=$auditeurs['qse'];
							if($qse==1){
							$qse='OUI';	
							}
							else{
							$qse='NON';	
							}
							$bpf=$auditeurs['bpf'];
							if($bpf==1){
							$bpf='OUI';	
							}
							else{
							$bpf='NON';	
							}

    $tbl .= '<tr>
            <td>
									 <center>'.$nom.'</center>
								</td>
								<td>
									 <center>'.$fonction.'</center>
								</td>
								<td>
									<center> '.$qse.' </center>
								</td>
								<td>
									 <center>'.$bpf.' </center>
								</td>
            </tr>';
     }
$pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document

$pdf->Output('example_054.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+
