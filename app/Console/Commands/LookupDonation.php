<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\Contracts\OpenSecretsContract;

class LookupDonation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'secrets:lookup {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Look up a name in Open Secrets';

    protected $opensecrets;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(OpenSecretsContract $opensecrets)
    {
        parent::__construct();
        $this->opensecrets = $opensecrets;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $name = $this->argument('name');
      $this->info("congrats. this is the $name");
      $donations = $this->opensecrets->lookup($name);
        //
      $this->info("this is the donation: \n".print_r($donations, TRUE));
    }


}
