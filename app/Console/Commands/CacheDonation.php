<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\Contracts\OpenSecretsContract;
use App\Name;

class CacheDonation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'secrets:cache {id?} {--test} {--all} {--n=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Look up a name in Open Secrets and cache results in Name';

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
      if ($this->argument('id'))
      {
        $id = $this->argument('id');
        $this->multiplelookup(array(array('id' => $id)));
      } elseif ($this->option('test'))
      {
        $query_number = $this->option('n');
        //$id_array = Name::all(['id'])->where('queried', false)->take(10)->toArray();
        $id_array = Name::where('queried', false)->take($query_number)->get(['id'])->toArray();
        $this->multiplelookup($id_array);
      //$this->info("this is the donation: \n".print_r($donations, TRUE));
      }
    }

    public function multiplelookup($ids)
    {
      $output_array = [];
      foreach($ids as $key => $id) {

        $nameobj = Name::findOrFail($id['id']);
        $name = $nameobj->name;
        $donations = $this->opensecrets->lookup($name);
        $output_array[] = ['id' => $id['id'], 'count' => count($donations), 'name' => $name];
        $this->info(" id: ".$id['id']."\t\tcount: ".count($donations)."\t\tname: $name");

        //$raw_result = $opensecrets->lookup($name->name);
        $service_run = TRUE;
        $nameobj->queried = TRUE;

        $nameobj->raw_count = count($donations);
        if ($nameobj->raw_count == 0) {
          $nameobj->cached_raw = NULL;
        } else {
          $nameobj->cached_raw = json_encode($donations);
          $parsed_donations = $donations;
        }
        $nameobj->save();

        //$this->info("sleeping");
        sleep(mt_rand(0, 2));
      }
      $this->table(['id', 'count', 'name'], $output_array);
    }

}
