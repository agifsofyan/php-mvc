<?php
    /*
    * Global function
    */

    function unique($digits){
        return rand(pow(10, $digits-1), pow(10, $digits)-1);
    }