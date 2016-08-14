<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateDonations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'secrets:create {id?} {--all} {--n=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create donations from names raw_cached field';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        if ($this->argument('id'))
        {
          $id = $this->argument('id');
          $this->lookup(array(array('id' => $id)));
        }
    }

    // stub for looking up name ids for donation import
    public function lookup($ids)
    {
      $output_array = [];
      $current_count = Name::where('queried', false)->count();
      foreach($ids as $key => $id) {
        $nameobj = Name::findOrFail($id['id']);
        if ($nameobj->raw_count > 0 && $nameobj->raw_count < 50) {
          $nameobj->cached_raw = NULL;
        } else {
          $nameobj->cached_raw = json_encode($donations);
          $parsed_donations = $donations;
        }
      }
    }
}
