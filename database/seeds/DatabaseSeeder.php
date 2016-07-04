<?php
use App\Report;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call('ReportTableSeeder');
        $this->command->info('Report table seeded!');
    }
}

class ReportTableSeeder extends Seeder {

    public function run()
    {

        DB::table('reports')->delete();
         $json = File::get("database/data/sinatradefectreports.json");
         $data = json_decode($json, TRUE);

         foreach ($data as $obj) {
           Report::create(array(

           'id' => $obj['id'],
           'publication_date' => $obj['publication_date'],
           'type' => $obj['type'],
           'public_inspection_pdf_url' => $obj['public_inspection_pdf_url'],
           'html_url' => $obj['html_url'],
           'pdf_url' => $obj['pdf_url'],
           'full_text_xml_url' => $obj['full_text_xml_url'],
           'full_text_xml' => $obj['full_text_xml'],
           'title' => $obj['title'],
           'excerpts' => $obj['excerpts'],
           'agencies' => $obj['agencies'],
           'abstract' => $obj['abstract'],
           'document_number' => $obj['document_number'],
           ));
        }

    }

}
