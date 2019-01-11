<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;
use \Rollbar\Rollbar;
use \Rollbar\Payload\Level;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        throw new \Exception('Test exception');
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
          );
        $pusher = new Pusher(
            '2c74dbae27c3b5dc8116',
            '0d5641ce9968e238c13a',
            '675525',
            $options
          );
        
        $data['message'] = 'hello world';
        $pusher->trigger('my-channel', 'my-event', $data);
        return view('home');
    }
}
