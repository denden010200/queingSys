<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <style>
      
        #footer {
          height: 60px;
          background-color: #f5f5f5;
        }
    
        #footer p {
          margin-top: 20px;
        }
      </style>

    <script>
        $(document).ready(function() {
            alert("Attention! This is the UEP Appointment System. Displayed slots are not your examination date.")
            $('#ModalClose').click(function() {
                $('.modal').hide();
            });
        })

    </script>
    <title>UEP Admission Slot</title>
</head>



    <body style="background-color:maroon">
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('images/UEP Logo.png')}}" width="50"><b>UNIVERISTY OF EASTERN PANGASINAN</b> </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('checkAppointment')}}">Check Appointment</a>
                  </li>
              </div>
          </nav>
            <br>

            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="card shadow-lg p-3 m-3">

    <form action="/searchAppointment" method="post">
    @csrf
    <div class="form-floating mb-3">
        <input type="input" class="form-control" id="floatingInput" name='control_id'>
        <label for="floatingInput">Enter your Control ID</label>
    </div>
      <div class="form-floating mb-3">
        <input type="date" class="form-control" id="floatingInput" name='date'>
        <label for="floatingInput">Date of Appointment</label>
      </div>
      <button class="btn btn-primary" type="submit">Check</button>
    </form>



</div>
@if (session('message'))
    <script>
      $(document).ready(function(){
        $('.modal').show();


       $('#close').click(function(){
        $('.modal').hide();
       })
      })
    </script>
<div class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Result</h5>
 
      </div>
      <div class="modal-body">
        {!! session('message')!!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id='close' data-bs-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>

@endif     
        </div>



    </body>
    <footer id="footer" class="fixed-bottom">
        <div class="container text-center">
          <p>Copyright &copy; 2024 UEP MIS. All rights reserved.</p>
        </div>
      </footer>


</html>
