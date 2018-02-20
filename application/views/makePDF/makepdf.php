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
 foreach ($owner_addinfor as $valowner ) {
                //storing the data of the owner where resident lives
                  $owner_id=$valowner ->owner;
                  $property_id=$valowner ->property;
                  $owner_name=$valowner->name;
                  $owner_housetype=$valowner->house_type;
                  
                  //var_dump($owner_addinfor);
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
$pdf->SetFont('dejavusans', '', 13);


// add a page
$pdf->AddPage('P', 'A4');


$pdf->Cell(0, 0, 'Proof Of Residence', 1, 1, 'C');

// Date of the day
$pdf->Cell(92, 5, 'Date:');
$pdf->TextField('date', 30, 5, array(), array('v'=>date('Y-m-d'), 'dv'=>date('Y-m-d')));
$pdf->Ln(10);

$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
    h1 {
        color: navy;
        font-family: times;
        font-size: 24pt;
        text-decoration: underline;
    }
    p.first {
        color: #003300;
        font-family: helvetica;
        font-size: 12pt;
    }
    p.first span {
        color: #006600;
        font-style: italic;
    }
    p#second {
        color: rgb(00,63,127);
        font-family: times;
        font-size: 12pt;
        text-align: justify;
    }
    p#second > span {
        background-color: #FFFFAA;
    }
    table.first {
        color: #003300;
        font-family: helvetica;
        font-size: 8pt;
        
    }
   
    div.test {
        color: #CC0000;
        background-color: #FFFF66;
        font-family: helvetica;
        font-size: 10pt;
        border-style: solid solid solid solid;
        border-width: 2px 2px 2px 2px;
        border-color: green #FF00FF blue red;
        text-align: center;
    }
    .lowercase {
        text-transform: lowercase;
    }
    .uppercase {
        text-transform: uppercase;
    }
    .capitalize {
        text-transform: capitalize;
    }
    body {
   background-image: url(images/tswellopele.png);

}
</style>

<br/>
<br/>


<body>
<table style='width: 100%' border='0' align='center' cellpadding='5' cellspacing='0'>
					  

               <tr>
        		    <td >Address:</td>
		  	    	<td  colspan='2'> $key->door_number $key->street_name</td>
      			  </tr>

               <tr>
	    		    <td  colspan='3'>&nbsp;</td>
	    		    <td  colspan='3'> $key->street_name</td>
	    		  
	  			  </tr>	
               <tr>
	    		    <td  colspan='4'>&nbsp;</td>
	    		    <td  colspan='4'> $key->town</td>
	    		  
	  			  </tr>
                  <tr>
	    		    <td  colspan='5'>&nbsp;</td>
	    		    <td  colspan='5'> $key->zip_code</td>
	    		  
	  			  </tr>
                <tr>
	    		    <td  colspan='6'>&nbsp;</td>
	    		    <td  colspan='6'> $key->town</td>
	    		  
	  			  </tr>
                    
                <tr>
	    		    <td  colspan='7'>&nbsp;</td>
	    		    <td  colspan='7'> $key->manucipality</td>
	    		  
	  			  </tr>
                <tr>
	    		    <td  colspan='8'>&nbsp;</td>
	    		    <td  colspan='8'> $key->district</td>
	    		  
	  			  </tr>
              <tr>
	    		    <td  colspan='9'>&nbsp;</td>
	    		    <td  colspan='9'> $key->province</td>
	    		  
	  			  </tr>  			  	  			  
	  			  
              <tr>
	    		    <td>&nbsp;</td>
	  			  </tr>
               <tr>
	    		    <td>&nbsp;</td>
	  			  </tr>
                <tr>
	    		    <td>&nbsp;</td>
	  			  </tr>


                <tr>
	    		    <td>&nbsp;</td>
	  			  </tr>  			  	  			  	  			  	  			  

                <tr>
		  	    	<td colspan='4'></td>
		  	    	<td><?php echo $key->door_number $key->street_name?></td>
      			  </tr>
              
                 			  
	  			      			                   
</table>
</body>
<br/>


<p class="first">This is to confirm that <strong> $key->name  </strong> identity number <strong>  $key->identitynumber </strong> stays at the above mentioned address since <strong> $key->date_registration </strong> until today.The <strong> $owner_housetype </strong> is owned by <strong> $owner_name,
<br/>
This letter will be valid for only three months,starting from the date issued. </strong> </span></p>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

<p> SIGNATURE________________________</p>
 
EOF;



// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//$pdf->writeHTML($htmlcontent, true, 0, true, 0);

//$pdf->writeHTML($inlinecss, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
