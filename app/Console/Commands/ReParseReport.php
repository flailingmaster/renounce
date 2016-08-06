<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;
use App\Name;
use DB;

class ReParseReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:reparse {--details} {--no-prompt}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $this->info('Finds reports with associated names');
        $empty_reports = DB::select('select reports.document_number as document_number, reports.id as id, reports.document_number as doc, reports.full_text_xml_url as xmlurl, reports.full_text_xml as full_text_xml from reports left join names on reports.document_number = names.document_number group by reports.id having count(names.id) = 0');
        $names_added = 0;
        foreach($empty_reports as $report) {
          $this->info('id:'.$report->id."\tdoc:".$report->doc."\turl:".$report->xmlurl);
          if ($report->full_text_xml != "" && $this->option('details')) {
            //$this->info($report->full_text_xml);
            $crawler = new Crawler($report->full_text_xml);
            $crawler = $crawler->filter('FP');
            $output_array = [];
            foreach($crawler as $name) {
              //$this->info($name->nodeValue);
              $output_array[] = ['document_number' => $report->document_number, 'name' => $name->nodeValue];
            }
            $this->table(['document_number', 'name'], $output_array);
            $name_count = count($output_array);
            $this->info("$name_count names found.");
            if ($name_count > 0)
            {
              $use_names = $this->ask('Create names from this table?');
              if ($use_names == 'Y' || $use_names == 'y') {
                $this->add_names($output_array);
                $names_added += $name_count;
              }
            }
          } else {
            $this->info('no xml found');
          }

          if ($this->option('no-prompt') == false) {
            $continue = $this->ask('Continue? [y|n]');
            if ($continue == 'n') break;
          }
        }
        $this->info("Added $names_added names.");
    }

    public function add_names($name_array)
    {
      foreach ($name_array as $name)
      {
        //$this->info('doc: '.$name['document_number']."\t\tname: ".$name['name']);
        Name::create(array(
          'name' => $name['name'],
          'document_number' => $name['document_number'],
        ));
      }
    }
}
