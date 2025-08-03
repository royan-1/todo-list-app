<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeImagesDirectory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:images-dir';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the public/images directory if it does not exist';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = public_path('images');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
            $this->info('Directory public/images created successfully.');
        } else {
            $this->info('Directory public/images already exists.');
        }
    }
}
