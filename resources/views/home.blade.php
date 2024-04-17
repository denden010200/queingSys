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
            $('#modal-close').click(function() {
                $('.modal').hide();
            })
        })

        document.addEventListener('DOMContentLoaded', function() {

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {

                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap5',


                dateClick: function(info) {
                    

                    $('.modal').show();
                    $('#date').val(info.dateStr);

                    var date = info.dateStr;

                    $.ajax({ //create an ajax request to display.php
                        type: "GET",
                        url: "{{route('ShowDate')}}",
                        dataType: "json", //expect html to be returned                
                        success: function(response) {
                         
                            for(var i = 0; i<response.length; i++){
                                
                                if(response[i].start === date){
                                    console.log(response[i].remaining)
                                    $('#slots').val(response[i].remaining);
                                }
                            }
                        }

                    });
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
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/UEP Logo.png') }}"
                    width="50"><b>UNIVERISTY OF EASTERN PANGASINAN</b> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>




                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Session::get('name') }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('appointments') }}">All Appointments</a></li>

                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>
    </nav>
    <div class="container">
        @if (Session::has('user_id'))
        @else{
            <script>
                window.location = "/";
            </script>
            }
        @endif

        @if (session('message'))
            <div class="alert alert-success">
                <p>{!! session('message') !!}</p>
            </div>
        @endif
        <div id='calendar' class="card p-2 m-2 shadow-lg"></div>
        <div class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6>Enter Slot</h6>
                    </div>
                    <form method="post" action="/addslot">
                        @csrf
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" name="date" id="date"
                                    placeholder="2024-00000">
                                <label for="floatingInput">Date</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="slots" id="slots"
                                    placeholder="100">
                                <label for="floatingInput">Slot</label>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="modal-close"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
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
