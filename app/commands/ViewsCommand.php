<?php
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ViewsCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'view:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear views folder';

    /**
     * The file system instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @return \ViewsCommand
     */
    public function __construct()
    {
        parent::__construct();
        $this->files = new \Illuminate\Filesystem\Filesystem;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {

        foreach ($this->files->files(storage_path().'/views') as $file)
        {
            $this->files->delete($file);
        }

        $this->info('Views deleted from cache');
    }

}