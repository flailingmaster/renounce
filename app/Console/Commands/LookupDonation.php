<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;

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
      $name = $this->argument('name');
      $this->info("congrats. this is the $name");
      $url = "https://www.opensecrets.org/indivs/";

      $client = new Client();
      $crawler = $client->request('GET', $url);

      // select the form and fill in some values
      $form = $crawler->selectButton('submit')->form();
      $form['name'] = $name;

      // submit that form
      $crawler = $client->submit($form);

      $crawler->filter('tbody > tr')->each(function ($node, $i) {
        $donation = [];
        $node->filter('td')->each(function($inner, $i) {
        switch($i) {
          case 0:
            $first = explode("<br>",$inner->html());
            $this->info( "name: ". $first[0]);
            $this->info( "location: ". $first[1]);
            break;
          default:
            $this->info( $inner->text());
            break;
          }
        });

      });
        //
    }
}
