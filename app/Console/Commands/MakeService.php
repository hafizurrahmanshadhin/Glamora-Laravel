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

    protected Filesystem $filesystem;

    public function __construct(Filesystem $filesystem) {
        parent::__construct();
        $this->filesystem = $filesystem;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void {
        $name = $this->argument('name');

        // Split input into path segments and class name
        $segments  = explode('/', $name);
        $className = array_pop($segments);

        // Build directory path and namespace
        $relativeDir = count($segments)
        ? DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $segments)
        : '';
        $namespaceSegment = count($segments)
        ? '\\' . implode('\\', $segments)
        : '';

        // Define the full path to the services directory
        $directory = app_path('Services' . $relativeDir);

        // Ensure the directory exists (create it if it doesn't)
        if (!$this->filesystem->exists($directory)) {
            $this->filesystem->makeDirectory($directory, 0755, true);
        }

        // Define the path for the new service class file
        $path = $directory . DIRECTORY_SEPARATOR . "$className.php";

        // Check if the service class already exists
        if ($this->filesystem->exists($path)) {
            $this->error("Service class $name already exists!");
            return;
        }

        // Generate and create the service class file
        $serviceClass = $this->generateServiceClass($className, $namespaceSegment);
        $this->filesystem->put($path, $serviceClass);

        $this->info("Service class $name created successfully!");
    }

    /**
     * Generate the PHP code for a service class based on the given class name and namespace.
     *
     * @param string $className The service class name.
     * @param string $namespaceSegment Namespace segment, e.g. '\\Web\\Frontend'.
     * @return string
     */
    private function generateServiceClass(string $className, string $namespaceSegment): string {
        return "<?php

namespace App\\Services{$namespaceSegment};

class {$className} {
    // Your service logic goes here
}
";
    }
}
