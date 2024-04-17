<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />

    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

    <style>
      
        #footer {
          height: 60px;
          background-color: #f5f5f5;
        }
    
        #footer p {
          margin-top: 20px;
        }
      </style>

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


        @if(session('message'))
        <div class="alert alert-success">
            <p>{!!session('message')!!}</p>
        </div>
        @endif
        <div class="card p-5 m-5 shadow-lg">
        
            <table class="table table-sm table-light table-hover table-striped" id="datatables">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Control ID</th>
                        <th>Fullname</th>
                        <th>Appointment Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
           
                    @foreach ($appointment as $item)
                    <tr>
                       
                        <td> {{$item->id;}}</td>
                        <td> {{$item->date;}}</td>
                        <td> {{$item->control_id;}}</td>
                        <td> {{$item->fullname;}}</td>
                        <td> {{$item->queingNumber;}}</td>
                        <td><a href="/delete/{{$item->id;}}" class="btn btn-danger">Delete</a></td>
                       
              
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>





    </div>
    </div>


    <script>
        
        $(document).ready(function() {
            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
            $('#datatables').DataTable();

        })
    </script>

</body>
<footer id="footer" class="fixed-bottom">
    <div class="container text-center">
      <p>Copyright &copy; 2024 UEP MIS. All rights reserved.</p>
    </div>
  </footer>


</html>
