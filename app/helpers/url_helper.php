<?php
    /*
    * Helper url redirect
    */
    function redirect($page){
        header('Location: ' .URL_ROOT . '/' . $page);
    }

    function createUrlSlug($urlString){
	   return preg_replace('/[^A-Za-z0-9-]+/', '-', $urlString);
	}
