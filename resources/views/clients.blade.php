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

        document.addEventListener('DOMContentLoaded', function() {
          
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
               
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap5',
                

                dateClick: function(info) {
                    var queque = Math.floor((Math.random() * 100000) + 1);
                    $('.modal').show();

                    $('#queingNumber').val(queque);
                    $('#date').val(info.dateStr);
                },
                validRange: function(nowDate){
    return {start: nowDate} //to prevent anterior dates
},


                events: {
                        url: '{{ route('ShowDate') }}',
                        method: 'GET',
                        type: "JSON",
                        extraParams: {
                            custom_param1: 'something',
                            custom_param2: 'somethingelse'
                        },
                        failure: function() {
                            alert('there was an error while fetching events!');
                        }
                    },


            });
            calendar.render();
        });
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
         
            </div>
          </nav>
        <div class="container">
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
@if(session('message'))
<script>
    $(document).ready(function(){
        $('#success').modal('show');
    })
</script>

<div class="modal" id="success" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h6 class="alert alert-success">
                {!! session('message') !!}
            </h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>
 
@endif
            <div id='calendar' class="card m-2 p-2 shadow-lg"></div>
        </div>


        <div class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">


                    </div>
                    <div class="modal-body">
                        
                        <form method="post" action="/addAppointment">
                            @csrf
                            <div class="alert alert-info">
                                <p>Note: You should have received your control ID number from OrangeApps after your online registration.</p>
                                <i>Example: 2024-00000</i>
                                <p></p>
                                <p>Note: Use your full name.</p>
                                <i>Example: Juan Garcia Dela Cruz</i>
                            </div>


                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" name="date" id="date" placeholder="2024-00000">
                                <label for="floatingInput">Date</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control"  name="control_id" placeholder="2024-00000">
                                <label for="floatingInput">Control ID</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control"  name="fullname"
                                    placeholder="Juan Dela Cruz">
                                <label for="floatingInput">Fullname</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control"  name="queingNumber" id="queingNumber"
                                    placeholder="Juan Dela Cruz">
                                <label for="floatingInput">Queque Number</label>
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="ModalClose">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </body>
    <footer id="footer" class="fixed-bottom">
        <div class="container text-center">
          <p>Copyright &copy; 2024 UEP MIS. All rights reserved.</p>
        </div>
      </footer>


</html>
