<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\User;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
       
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password_n' => ['required', Password::defaults(), 'confirmed'],
        ]);
    
        $user = $request->user();
        $user->update([
            'password' => Hash::make($validated['password_n']),
        ]);
        
        // Verifica il ruolo dell'utente
        if ($user->role === 'Paziente') {
            
            // Reindirizza se l'utente è un paziente
            return redirect()->route('Gestisci_Account')->with('success', 'Password aggiornata con successo!');
        } 
        elseif ($user->role === 'Clinico') {
           
            // Reindirizza se l'utente è un clinico
            return redirect()->route('Clinico')->with('success', 'Password aggiornata con successo!');
        }
        

    }
    
    
    public function update_admin_clinico_password(Request $request,int $id): RedirectResponse
    {
       
        

        $clinico = User::where('id', $id)->first(); 
        if (!Hash::check($request->input('current_password'), $clinico->password)) {
            return redirect()->back()->withErrors(['current_password' => 'La password corrente non è corretta.'])->withInput();
        }

        $validated = $request->validate([
            
            'password_n' => ['required', Password::defaults(), 'confirmed'],
        ]);
        
        $clinico->update([
            'password' => Hash::make($validated['password_n']),
        ]);
        
    
        return redirect()->route('ClinicoSel',$id)->with('success', 'Password aggiornata con successo!');
        
        

    }

}