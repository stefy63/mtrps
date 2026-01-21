<?php

namespace App\Services;

use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class AutoUpdateService
{
    public function updateFromGit(): array
    {
        $basePath = base_path();

        try {
            // 1️⃣ Git pull
            $process = Process::fromShellCommandline('git pull', $basePath);
            $process->run();
            if (!$process->isSuccessful()) {
                throw new \Exception($process->getErrorOutput());
            }
            echo $process->getOutput();
            // // 1️⃣ Install npm deps
            // $process = Process::fromShellCommandline('npm ci', $basePath);
            // $process->run();
            // if (!$process->isSuccessful()) {
            //     throw new \Exception($process->getErrorOutput());
            // }
            // echo $process->getOutput();
            // // 1️⃣ Build assets
            // $process = Process::fromShellCommandline('npm run build', $basePath);
            // $process->run();
            // if (!$process->isSuccessful()) {
            //     throw new \Exception($process->getErrorOutput());
            // }
            // echo $process->getOutput();
            // 2️⃣ Run migrations
            Artisan::call('migrate', ['--force' => true]);

            // 3️⃣ Clear cache (opzionale ma consigliato)
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');

            return [
                'status' => 'ok',
                'git' => $process->getOutput(),
                'artisan' => Artisan::output(),
            ];
        } catch (\Throwable $e) {
            return [
                'status' => 'ko',
                'message' => $e->getMessage(),
            ];
        }
    }
}
