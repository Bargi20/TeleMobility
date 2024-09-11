<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\User;
use Illuminate\Http\Request;
use App\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Gate;


class UserController extends Controller
{
    protected $_UserModel;
    public function __construct() {
        $this->_UserModel = new User;
       
    }
    public function index() : View {
        return view('Paziente');
    }
    public function index_clinico() : View {
        return view('areaRiservataDottore');
    }

    public function index_admin() : View {
        return view('areaRiservataAmministratore');
    }
}



