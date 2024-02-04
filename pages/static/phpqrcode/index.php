<?php    
    
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';
    include "qrlib.php";   
    
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);     
        $filename = $PNG_TEMP_DIR.'test.png';                
        // declaration des  données
        $errorCorrectionLevel = 'H';  
        $matrixPointSize = 16;
        $data = "sj1df";

        $filename = $PNG_TEMP_DIR.'qr'.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);   
        
        
    echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';  
    


        
    echo '<form method="post"><input type="submit" value="GENERATE"></form></form>';
        

    