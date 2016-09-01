<?php

namespace App\Helpers;

use App\Helpers\Contracts\OpenSecretsContract;
use Goutte\Client;

class OpenSecrets implements OpenSecretsContract
{

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

      // parse results
      $donation = $this->parseResults($crawler);
      $linkcrawler = $crawler->selectLink("Next");

      // while there's a next page
      while ($linkcrawler->count() != 0) {

        $link = $linkcrawler->link();
        $nextpage = $client->click($link);
        $donation = array_merge($donation, $this->parseResults($nextpage));
        $linkcrawler = $nextpage->selectLink("Next");

      }


      return $donation;
    }

    public function parseResults($crawler) {
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
              $row['location'] = str_replace("</td>\n", "", $first[1]);
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


          $donation[] = $row;

      });
      return $donation;
    }
}
