<?php
namespace App\Exceptions;

use Exception;
/** 
 * verifyEmail exception handler 
 */ 
class VerifyEmailServiceException extends Exception { 
 
    /** 
     * Prettify error message output 
     * @return string 
     */ 
    public function errorMessage() {
    	$errorMsg = $this->getMessage(); 
        return $errorMsg; 
    } 
    public function report() {
	\Log::debug('Email is not real.');
    }
 
} 


?>
