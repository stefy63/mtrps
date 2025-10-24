<?php

namespace App\Console\Commands\ArtisanMakerService;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

/**
 * Class MakeService.
 */
class ArtisanMakerService extends GeneratorCommand
{
    const STUB_PATH = __DIR__ . DIRECTORY_SEPARATOR . 'stubs';

    /**
     * @var string
     */
    protected $signature = 'make:service {name : Create a service class} {--i : Create a service interface} {--force : Force overwrite}';

    /**
     * @var string
     */
    protected $description = 'Create a new service class and associated interface (contract)';

    /**
     * @var string
     */
    protected $type = 'Service';

    protected function getStub(): string
    {
        return "";
    }

    /**
     * @return string
     */
    protected function getServiceStub(): string
    {
        return self::STUB_PATH . DIRECTORY_SEPARATOR . 'service.stub';
    }

    /**
     * @return string
     */
    protected function getInterfaceStub(): string
    {
        return self::STUB_PATH . DIRECTORY_SEPARATOR . 'interface.stub';
    }

    /**
     * @return string
     */
    protected function getServiceInterfaceStub(): string
    {
        return self::STUB_PATH . DIRECTORY_SEPARATOR . 'service.interface.stub';
    }

    /**
     * @return bool|null
     *
     * @throws FileNotFoundException
     * @see GeneratorCommand
     *
     */
    public function handle()
    {
        if ($this->isReservedName($this->getNameInput())) {
            $this->error('The name "' . $this->getNameInput() . '" is reserved by PHP.');

            return false;
        }

        $name = $this->qualifyClass($this->getNameInput());

        $pathInfo = pathinfo($this->getPath($name));

        $path = $pathInfo['dirname'];
        $fileName = $pathInfo['filename'];

        if (
            (!$this->hasOption('force') ||
                !$this->option('force')) &&
            $this->alreadyExists($this->getNameInput())
        ) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        $this->makeDirectory($path . DIRECTORY_SEPARATOR . $pathInfo['basename']);
        $isInterface = $this->option('i');

        $this->files->put(
            $path . DIRECTORY_SEPARATOR . $fileName . 'Service.php',
            $this->sortImports(
                $this->buildServiceClass($name, $isInterface)
            )
        );
        $message = $this->type;

        // Whether to create contract
        if ($isInterface) {
            $interfaceName = $fileName . 'Interface.php';
            $interfacePath = $path . DIRECTORY_SEPARATOR . 'Interfaces';

            $this->makeDirectory($interfacePath . DIRECTORY_SEPARATOR . $interfaceName);

            $this->files->put(
                $interfacePath . DIRECTORY_SEPARATOR . $interfaceName,
                $this->sortImports(
                    $this->buildServiceInterface($name)
                )
            );

            $message .= ' and Interface';
        }

        $this->info($message . ' created successfully.');
        return true;
    }

    /**
     * @param string $name
     * @param $isInterface
     * @return string
     *
     * @throws FileNotFoundException
     */
    protected function buildServiceClass(string $name, $isInterface): string
    {
        $stub = $this->files->get(
            $isInterface ? $this->getServiceInterfaceStub() : $this->getServiceStub()
        );

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * @param string $name
     * @return string
     *
     * @throws FileNotFoundException
     */
    protected function buildServiceInterface(string $name): string
    {
        $stub = $this->files->get($this->getInterfaceStub());
        str_replace($this->getNameInput(), 'Interfaces/', $name);

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * @param $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . DIRECTORY_SEPARATOR . 'Services';
    }
}
