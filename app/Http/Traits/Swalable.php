<?php

namespace App\Http\Traits;

trait Swalable
{
    public function flashSuccess($message)
    {
        $this->setupFlash("Successo", $message, 'success');
    }

    public function flashError($message)
    {
        $this->setupFlash("Errore", $message, 'error');
    }

    private function setupFlash($title, $message, $type)
    {
        session()->flash('swalEvent', [
            'title' => $title,
            'message' => $message,
            'type' => $type,
        ]);
    }
}
