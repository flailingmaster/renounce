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
      $donations = $this->lookup($name);
        //
    }

    public function lookup($name)
    {
      $url = "https://www.opensecrets.org/indivs/";

      $client = new Client();
      $crawler = $client->request('GET', $url);

      // select the form and fill in some values
      $form = $crawler->selectButton('submit')->form();
      $form['name'] = $name;

      // submit that form
      $crawler = $client->submit($form);
      $donation = [];
      $crawler->filter('tbody > tr')->each(function ($node, $i) use (&$donation) {
        $row = [];
        $cells = $node->filter('td');

        $inc = 0;
        foreach ($cells as $element) {
          switch($inc) {
            case 0:
              $first = explode("<br>",$element->ownerDocument->savehtml($element));
              $row['name'] = str_replace("<td>", "", $first[0]);
              $row['location'] = str_replace("</td>", "", $first[1]);
              break;
            case 1:
              $row['occupation'] = $element->nodeValue;
              break;
            case 2:
              $row['date'] = $element->nodeValue;
              break;
            case 3:
              $row['amount'] = $element->nodeValue;
              break;
            case 4:
              $row['recipient'] = $element->nodeValue;
              break;

            default:
              $this->info( "additional info: ".$element->nodeValue);
              break;
            }
            $inc++;
        }
          // dev buttress code
          //$this->info("this is the row: \n".print_r($row, TRUE));
          $donation[] = $row;
      });
          $this->info("this is the donation: \n".print_r($donation, TRUE));
    }
}
