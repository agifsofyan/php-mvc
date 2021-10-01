<?php
    /*
    * Helper to format Currency (Rp)
    */
    function toCurrency($number, $single = false, $input = false){
		
        $format = 0;
        
        if($number > 0){
            $format = "<span class='fl-left pl-2'>Rp</span><span class='fl-right'>".number_format($number,0,'.','.')."</span>";
            
            if($single == true){
                $format = "<span>Rp </span><span>".number_format($number,0,'.','.')."</span>";
            }

            if($input == true){
                $format = number_format($number,0,'.','.');
            }
        }
        
        return $format;
	}