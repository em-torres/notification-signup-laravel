<?php

namespace App\Http\Controllers;

use App\User;
use App\Notifications\UserCreatedToAdmin;
use Illuminate\Http\Request;
use Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function sendUserSignedUpNotification()
    {
        $user = User::first();

        $details = [
            'greeting' => 'Hi Admin!!',
            'body' => ('A new user ' . $user->name . ' has signed up. Try to send greetings at ' . $user->email),
            'thanks' => 'Thanks!!',
            'actionText' => 'View My Site',
            'actionURL' => url('/'),
            'notif_if' => date("Y") . rand(1, 1000),
            'admin_email' => 'edwin.sonic@gmail.com'
        ];

        Notification::send($user, new UserCreatedToAdmin($details));

        return redirect('/home');
    }
}
