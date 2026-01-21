<?php

namespace App\Http\Controllers;

use App\Services\AutoUpdateService;
use Illuminate\Support\Facades\Redirect;

class AutoUpdateController extends Controller
{
    public function __invoke(AutoUpdateService $service)
    {
        $response = response()->json($service->updateFromGit());
        if ($response->original['status'] === 'ok') {
            return Redirect::back()
                ->with('success', 'Aggiornamento completato con successo.');
        }
        return Redirect::back()
            ->with('error', $response->original['message']);
    }
}
