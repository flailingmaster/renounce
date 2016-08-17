<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Name;
use App\Donation;
use Carbon\Carbon;

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
      foreach($ids as $key => $id) {
        $nameobj = Name::findOrFail($id['id']);
        if ($nameobj->raw_count > 0 && $nameobj->raw_count < 50) {
          $this->info("Found donations: $nameobj->raw_count");
          $processed_count = 0;
          $donation_array = [];
          foreach (json_decode($nameobj->cached_raw) as $donation) {
            $format = 'n/d/y';
            $date = Carbon::createFromFormat($format, $donation->date);

            $donation_array[] = array(
              'raw_name' => $donation->name,
              'name_id' => $nameobj->id,
              'donation_date' => $date,
              'location' => $donation->location,
              'occupation' => $donation->occupation,
              'amount' => $donation->amount,
              'recipient' => $donation->recipient,
            );

          }
          $this->add_donations($donation_array);
          $nameobj->donations_processed = true;
          $nameobj->save();
        } else {
          $this->info("no donation found");
        }
      }
    }
    public function add_donations($donation_array)
    {
      foreach ($donation_array as $donation)
      {
        //$this->info('doc: '.$name['document_number']."\t\tname: ".$name['name']);
        Donation::create(array(
          'raw_name' => $donation['raw_name'],
          'name_id' => $donation['name_id'],
          'donation_date' => $donation['donation_date'],
          'location' => $donation['location'],
          'occupation' => $donation['occupation'],
          'amount' => $donation['amount'],
          'recipient' => $donation['recipient'],
        ));

      //$sketchystring = print_r($donation, TRUE);
      }
    }
}
