<?php

require_once( $_SERVER['DOCUMENT_ROOT'].'/excel/PHPExcel.php');

$objPHPExcel = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objPHPExcel->load($_SERVER['DOCUMENT_ROOT'].'/excel/registre.xlsx'); // Empty Sheet
$objPHPExcel->setActiveSheetIndex(0);


function searchForId($nom, $email , $array) {
   foreach ($array as $key => $val) {
       if (($val['1'] === $nom) && ($val['7'] === $email)) {
           return $key;
       }
   }
   return "rien";
}

/*
    INSERT DES DATAS 
*/

$rowArray = array();


        foreach ($_POST["cat"] as $key => $value) {
            
            $result_contact = $this->My_listes->get_contact_by_cat($value); 

            foreach ($result_contact as $row) {

                $temp = array (
                    $row->civ,
                    $row->nom,
                    $row->prenom,
                    $row->fonction,
                    $row->tel,
                    $row->mobile,
                    $row->fax,
                    $row->email,
                    $row->num_voie,
                    $row->nom_voie,
                    $row->lieu_dit,
                    $row->bp,
                    $row->cp,
                    $row->ville,
                    $row->cedex,
                );
                if (searchForId ($row->nom, $row->email, $rowArray) === "rien"){
                    array_push($rowArray, $temp);

                    if ($row->nom == "BERGOUIGNON"){
                      //echo "#####".searchForId ($row->nom, $row->email, $rowArray)."<br>";  
                    }
                    //echo searchForId ($row->nom, $row->email, $rowArray)."coucouc<br>";
                } else {
                   // echo $row->nom." foudn<br>";
                }


            }
        }





//$rowArray = array('Value1', 'Value2', 'Value3', 'Value4');
$objPHPExcel->getActiveSheet()->fromArray($rowArray, NULL, 'A3');



$styleA = $objPHPExcel->getActiveSheet()->getStyle('B2');
$objPHPExcel->getActiveSheet()->duplicateStyle($styleA, 'A3:AB'.$objPHPExcel->setActiveSheetIndex(0)->getHighestRow());

$objPHPExcel->getActiveSheet()->removeRow(2);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="registre.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
/**/



?>