<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2009-09-30
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com s.r.l.
//               Via Della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @copyright 2004-2009 Nicola Asuni - Tecnick.com S.r.l (www.tecnick.com) Via Della Pace, 11 - 09044 - Quartucciu (CA) - ITALY - www.tecnick.com - info@tecnick.com
 * @link http://tcpdf.org
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 * @since 2008-03-04
 */




foreach ($user_addinfor as $key ) {
}


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetPrintHeader(false); $pdf->SetPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
//$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();
// create some HTML content
$htmlcontent = "<html>
				  <body>
					<table width='500' border='0' align='center' cellpadding='5' cellspacing='0'>
					  <tr>
						<td width='165'>Date</td>
						";
		
$htmlcontent .= "<td width='165'>" . date('M-d-Y') .      "</td></tr>";


$htmlcontent .=  "<tr>
        		    <td width='165'>Address</td>
		  	    	<td width='335' colspan='2'>58972</td>
      			  </tr>";

$htmlcontent .=  "<tr>
	    		    <td width='500' colspan='3'>&nbsp;</td>
	  			  </tr>";	

$htmlcontent .=  "<tr>

                    <td width='165'>Resident</td>
                  </tr>";
$htmlcontent .=  "<tr>
		  	    	<td width='335' colspan='4'></td>
		  	    	<td width='165'><?php echo $key->door_number. ' '.$key->street_name?></td>
      			  </tr>";
$htmlcontent .= "<tr>
	    		    <td width='500' >&nbsp;</td>
	  			  </tr>";	
$htmlcontent .= "<tr>
	    		    <td width='500'>&nbsp;</td>
	  			  </tr>";		  			  
$htmlcontent .=  "<tr>
					
                    <td width='700'>This is to confirm that (Name,ID Number) stays at the above mentioned address since". ' ' .date('M-d-Y') ." until today.The house type owned by (Owner)   </td>
                  </tr>";
$htmlcontent .=  "<tr>
		  	    	
		  	    	<td width='2000'>This letter will be valid for only three months,starting from the date issued.</td>
      			  </tr>"; 
$htmlcontent .= "<tr>
	    		    <td width='700'>&nbsp;</td>
	  			  </tr>";	      			                   
$htmlcontent .= "</table></body></html>";

// output the HTML content
$pdf->writeHTML($htmlcontent, true, 0, true, 0);

//$pdf->writeHTML($inlinecss, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
