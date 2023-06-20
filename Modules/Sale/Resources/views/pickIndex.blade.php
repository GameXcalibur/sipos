@extends('layouts.app')

@section('title', 'Pick')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Pick</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">


                        <hr>

                        <div class="table-responsive">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    {!! $dataTable->scripts() !!}

    <script>
        var lastID = 10001;
function getVoices() {
  let voices = speechSynthesis.getVoices();
  if(!voices.length){
    let utterance = new SpeechSynthesisUtterance("");
    speechSynthesis.speak(utterance);
    voices = speechSynthesis.getVoices();
  }
  return voices;
}

        setInterval( function () {
            window.LaravelDataTables["sales-table"].ajax.reload();
            var newID = Object.keys(window.LaravelDataTables["sales-table"].rows().data()).length;
            if(lastID == newID){
                console.log("SAME");

            }else{
                if(lastID != 10001){
                    console.log("SIREN");
                    let textToSpeak = "New Invoice To Pick";

                    let speakData = new SpeechSynthesisUtterance();
                    speakData.volume = 1; // From 0 to 1
                    speakData.rate = 0.7; // From 0.1 to 10
                    speakData.pitch = 1; // From 0 to 2
                    speakData.text = textToSpeak;
                    speakData.lang = 'en';
                    speakData.voice = getVoices()[0];

                    speechSynthesis.speak(speakData);
                }
                lastID = newID;
            }


}, 3000 );

        </script>
@endpush
