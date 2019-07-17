<?php

namespace App\Services;

use OCLC\Auth\WSKey;
use OCLC\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class CreateBorrowerService {

	public function create(Borrower $request)
	{
       $borrower = \App\Borrower::create([
        'code' => $request->get('code'),
        'amount' => $request->get('amount'),
        'max_redemptions' => $request->get('max_redemptions')
       ]);
       return $borrower;
	}
	public function connect() {
        $key = 'api-key';
        $secret = 'api-key-secret';
        $wskey = new WSKey($key, $secret);

	}

}



?>
