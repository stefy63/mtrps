<?php

namespace App\Http\Controllers;

use App\Services\AutoUpdateService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class AutoUpdateController extends Controller
{
    public function __invoke(AutoUpdateService $service)
    {
        if (!$this->isOnline()) {
            return Redirect::back()
                ->with('error', 'Impossibile connettersi al server. Verifica la tua connessione e riprova.');
        }
        $response = response()->json($service->updateFromGit());
        if ($response->original['status'] === 'ok') {
            return Redirect::back()
                ->with('success', 'Aggiornamento completato con successo.');
        }
        return Redirect::back()
            ->with('error', $response->original['message']);
    }

    public function isOnline()
    {
        try {
            $response = Http::timeout(3)->get('https://www.google.com');
            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
}
