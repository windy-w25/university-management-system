<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path('Repositories');
        
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $filePath = "{$path}/{$name}.php";

        if (File::exists($filePath)) {
            $this->error("Repository {$name} already exists!");
            return;
        }

        File::put($filePath, $this->getRepositoryStub($name));

        $this->info("Repository {$name} created successfully!");
    }

    protected function getRepositoryStub($name)
    {
        return "<?php\n\nnamespace App\Repositories;\n\nclass {$name}\n{\n    // Implement repository methods here\n}\n";
    }
}
