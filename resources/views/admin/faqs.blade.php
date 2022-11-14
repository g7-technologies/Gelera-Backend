<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gelera | FAQ's</title>
    <link rel="shortcut icon" href="{{ asset('public/images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


  </head>
  <body>
    <div class="container mt-4">
        
        <h3 class="text-center text-muted">FAQ's</h3>
        
        <p class="text-muted text-center mb-4">Updated Oct 11, 2022</p>
        
        <div class="accordion" id="faqs_gelera">
        <?php $i = 0;?>
        @foreach($faqs as $faq)
        <?php $i = $i + 1;?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading_{{$faq->id}}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$faq->id}}" aria-expanded="true" aria-controls="collapse_{{$faq->id}}">
                    Question #{{$i}} {{$faq->question}}
                    </button>
                </h2>
                <div id="collapse_{{$faq->id}}" class="accordion-collapse collapse" aria-labelledby="heading_{{$faq->id}}" data-bs-parent="#faqs_gelera">
                    <div class="accordion-body">
                        {{$faq->answer}}
                    </div>
                </div>
            </div>

        @endforeach
        
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>