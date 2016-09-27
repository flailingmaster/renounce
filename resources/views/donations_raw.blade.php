@foreach ($donations as $donation)
@if ($donation->name->report->publication_date < $donation->donation_date)
    "FLAG"
@else
    "NONE"
@endif
"{{$donation->name->name}}",
"{{$donation->name->document_number}}",
"{{$donation->name->report->publication_date}}",
"{{$donation->raw_name}}",
"{{$donation->donation_date}}",
"{{$donation->location}}",
"{{$donation->occupation}}",
"{{$donation->dec_amount}}",
"{{$donation->recipient}}"<br>
@endforeach
