<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeService extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    protected $filesystem;

    public function __construct(Filesystem $filesystem) {
        parent::__construct();
        $this->filesystem = $filesystem;
    }

    /**
     * Execute the console command.
     */
    public function handle() {
        $name         = $this->argument('name');
        $namespace    = str_replace('/', '\\', dirname($name)); // Get the namespace without the class name
        $className    = basename($name); // Get the class name (e.g., 'SocialLoginService')
        $serviceClass = $this->generateServiceClass($name);

        // Define the full path to the services directory
        $directory = app_path("Services/{$namespace}");

        // Ensure the directory exists (create it if it doesn't)
        if (!$this->filesystem->exists($directory)) {
            $this->filesystem->makeDirectory($directory, 0755, true); // Create any missing directories
        }

        // Define the path for the new service class file
        $path = $directory . DIRECTORY_SEPARATOR . "{$className}.php";

        // Check if the service class already exists
        if ($this->filesystem->exists($path)) {
            $this->error("Service class {$name} already exists!");
            return;
        }

        // Create the service class file
        $this->filesystem->put($path, $serviceClass);

        $this->info("Service class {$name} created successfully!");
    }

    /**
     * Generate the PHP code for a service class based on the given name.
     *
     * This method splits the given service name by the '/' delimiter to separate the namespace
     * and class name. It then generates the appropriate PHP code for the service class, ensuring
     * that the namespace and class name are correctly formatted. If a directory structure is
     * specified, it creates the corresponding namespace. Otherwise, it defaults to the root
     * namespace.
     *
     * @param string $name The name of the service, potentially with a namespace structure.
     *                     Example: 'Auth/SocialLoginService/Dss' or 'SocialLoginService'.
     *
     * @return string The generated PHP code for the service class, including the proper namespace
     *                and class declaration.
     */
    private function generateServiceClass($name) {
        // Split the input string into parts based on '/'
        $parts = explode('/', $name);

        // Separate the namespace (everything except the last part) and the class name (the last part)
        $namespaceParts = array_slice($parts, 0, -1); // Get all parts except the last for the namespace
        $className      = end($parts); // Get the last part as the class name

        // If there are namespace parts, join them with '\' else set it to an empty string
        $namespace = !empty($namespaceParts) ? '\\' . implode('\\', $namespaceParts) : '';

        return "<?php

namespace App\\Services{$namespace};

class {$className}
{
    // Your service logic goes here
}
";
    }

}
