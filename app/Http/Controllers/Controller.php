<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Models\settings;
use App\Models\Pages;
use App\Models\Network;
use Illuminate\Support\Facades\View;
class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        date_default_timezone_set("Europe/Kiev");

        $networks = Network::whereNotNull('href')->get();
        $navigation = Pages::where('enable', 'yes')->get();
        $subNavigation = Pages::whereNotNull('parent')->get();

        $settings = settings::all();
        View::share( 'settings', $settings );
        View::share( 'navigation', $navigation );
        View::share( 'subNavigation', $subNavigation );
        View::share( 'networks', $networks );
    }

    public function randomName( $length = 64 )
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $name = '';
        for ($i = 0; $i <= $length; $i++)
        {
            $name .= $characters[mt_rand (0, strlen ($characters) - 1)];
        }
        return $name;
    }

    public function getting ()
    {
        $time = date("H");
        if ( $time > 21 or $time < 06 )
            $getting = "Вообще уже пора спать:)";
        else if ( $time == 06 or $time <= 9  )
            $getting = "Чудесное утро!";
        else if ( $time == 10 or $time <= 15  )
            $getting = "Хороший денек!";
        else if ( $time > 15 or $time <= 20  )
            $getting = "Чудный вечер!";
        else
            $getting = "";

        return $getting;
    }


}
