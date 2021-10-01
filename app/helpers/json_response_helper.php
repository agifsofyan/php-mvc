<?php
    /*
    * Helper to JSON format
    */
    function jsonHttpResponse($data, $statusCode = 200, $msg = null)
    {
        ob_clean();
        header_remove(); 
    
        header('Access-Control-Allow-Origin: *');
        header("Content-type: application/json; charset=utf-8");
    
        http_response_code($statusCode);

        if($msg != null){
            $data = array('error' => $msg);
        }
        
        echo json_encode($data);
        exit();
    }