<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use DB;
class ReParseReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:reparse';

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
        $this->info('Basic Test');
        $empty_reports = DB::select('select reports.id as id, reports.document_number as doc, reports.full_text_xml_url as xmlurl from reports left join names on reports.document_number = names.document_number group by reports.id having count(names.id) = 0');
        foreach($empty_reports as $report) {
          $this->info('id:'.$report->id."\tdoc:".$report->doc."\turl:".$report->xmlurl);

        }
    }
}
