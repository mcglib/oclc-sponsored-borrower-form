<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HelloworldController extends Controller
{

    protected $message;

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->message = "Hey, you've made a hello world controller view in Laravel 5!";
    }

    /**
     * Show the helloworld page.
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('helloworld', [
            'message' => $this->message,
        ]);
    }
}

?>
