<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Catalog;
use Illuminate\Support\Facades\Log;

class PublicController extends Controller
{

    protected $_catalogModel;

    public function __construct() {
        $this->_catalogModel = new Catalog();
    }

    public function showDottori(Int $Numero): View {

        $Doc = $this->_catalogModel->getDottori($Numero);
        return view('Dottori')
                        ->with('lista', $Doc); 
    }

    public function showAllDottori(): View {
        $Doc = $this->_catalogModel->getAllDottori();

        return view('Lista_dottori')
                        ->with('lista', $Doc); 
    }

    public function showFaq(): View {
        $faq = $this->_catalogModel->getfaq(); 
        return view('Faq')
                        ->with('faq', $faq); 
    }


    public function getGestioneClinico(): View {
        $Doc = $this->_catalogModel->getAllDottori();
        return view('gestioneClinico')
                        ->with('Dottori', $Doc);
    }
  

  
    
    

}
