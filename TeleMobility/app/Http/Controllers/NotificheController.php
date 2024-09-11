<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Http\Request;
use App\Providers\AuthServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use App\Models\Resources\Disturbouse;
use App\Models\Resources\Diagnosi;
use Illuminate\Support\Facades\Auth;
use App\Models\Resources\Disturbo;
use Illuminate\Database\Eloquent\Model;
use Brick\Math\BigInteger;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Resources\Faq;
use App\Models\Resources\Clinico;
use App\Models\Resources\Paziente;
use App\Models\Catalog;
use App\Models\Resources\Evento_Disturbo;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Log;
use App\Models\Resources\Notifiche;


class NotificheController extends Controller{

    public function verificaNotifiche()
    {
        $userId = auth()->id();

        $hasUnreadNotifications = Notifiche::where('ID_Ricevente', $userId)
                                           ->where('Aperta', 0)
                                           ->exists();

        return response()->json(['hasUnreadNotifications' => $hasUnreadNotifications]);
    }

    public function getNotifiche()
    {
        $bigIntegerID = BigInteger::of(Auth::user()->id);       
        
        $listaNotifiche_vecchie = Notifiche::where('ID_Ricevente', $bigIntegerID)
        ->where('Aperta',1)
        ->orderBy('DataNotifica', 'desc')
        ->orderBy('Orario', 'desc')
        ->paginate(5);
        
        $listaNotifiche_nuove = Notifiche::where('ID_Ricevente', $bigIntegerID)
        ->where('Aperta',0)
        ->orderBy('DataNotifica', 'desc')
        ->orderBy('Orario', 'desc')
        ->paginate(5);

        $tutte = Notifiche::where('ID_Ricevente', $bigIntegerID)
        ->orderBy('DataNotifica', 'desc')
        ->orderBy('Orario', 'desc')
        ->paginate(5);

        $listaNotificheAggiornata = Notifiche::where('ID_Ricevente', $bigIntegerID)->update(['Aperta' => 1]);
        
        
        return view('notifichePaziente')
    ->with('Notifiche_v', $listaNotifiche_vecchie)
    ->with('Notifiche_n', $listaNotifiche_nuove);
    }
}