<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
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

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path('Services');
        
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $filePath = "{$path}/{$name}.php";

        if (File::exists($filePath)) {
            $this->error("Service {$name} already exists!");
            return;
        }

        File::put($filePath, $this->getServiceStub($name));

        $this->info("Service {$name} created successfully!");
    }

    protected function getServiceStub($name)
    {
        return "<?php\n\nnamespace App\Services;\n\nclass {$name}\n{\n    // Implement service methods here\n}\n";
    }
}
