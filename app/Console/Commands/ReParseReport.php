<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;
use DB;
class ReParseReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:reparse {--details}';

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
        $empty_reports = DB::select('select reports.id as id, reports.document_number as doc, reports.full_text_xml_url as xmlurl, reports.full_text_xml as full_text_xml from reports left join names on reports.document_number = names.document_number group by reports.id having count(names.id) = 0');
        foreach($empty_reports as $report) {
          $this->info('id:'.$report->id."\tdoc:".$report->doc."\turl:".$report->xmlurl);
          if ($report->full_text_xml != "" && $this->option('details')) {
            //$this->info($report->full_text_xml);
            $crawler = new Crawler($report->full_text_xml);
            $crawler = $crawler->filter('FP');
            foreach($crawler as $name) {
              $this->info($name->nodeValue);
            }

          } else {
            $this->info('no xml found');
          }

          $continue = $this->ask('continue?');
          if ($continue == 'n') break;
        }
    }
}
