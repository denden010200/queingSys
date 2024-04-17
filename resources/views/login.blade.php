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



    <title>UEP Admission Slot</title>

    <script>
        $(document).ready(function() {
            $('#signup').click(function() {
                $('.modal').show();
            })
            $('#close').click(function() {
                $('.modal').hide();
            })

            $('#repassword').keyup(function() {
                if ($('#typepassword').val() != $('#repassword').val()) {
                    $("#alert").html("Password do not match").css("color", "red");

                } else {
                    $("#alert").html("Password matched").css("color", "green");
                }
            })
            $('#typepassword').keyup(function() {
                if ($('#typepassword').val() != $('#repassword').val()) {
                    $("#alert").html("Password do not match").css("color", "red");

                } else {
                    $("#alert").html("Password matched").css("color", "green");
                }
            })
        })
    </script>
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
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
            </div>

        </div>
    </nav>
    <div class="container">
      <br>
           
            <div class="col card shadow-lg p-3 w-50" style="margin: auto;">
                @if (session('message'))
                    <h6 class="alert alert-danger">
                        {!! session('message') !!}
                    </h6>
                @endif

                @if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif
                <form method="post" action="/loginUser">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" type="text" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control" type="password" id="password" name="password" minlength="8">
                    </div>

                    <button class="btn btn-primary">Login</button>
                    <p>No account? <a href="#" id="signup">Click Here</a></p>

                </form>
            </div>
         

            <div class="modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Signup</h5>

                        </div>
                        <div class="modal-body">

                            <form action="/addUser" method="post">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="input" class="form-control" name="name" id="name"
                                        placeholder="Juan Dela Cruz" required>
                                    <label for="name">Name</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="typeemail" id="typeemail"
                                        placeholder="email@gmail.com" required>
                                    <label for="typeemail">Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" name="typepassword" id="typepassword"
                                        minlength="8" required>
                                    <label for="typepassword">Type Password</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" name="repassword" id="repassword"
                                        minlength="8" required>
                                    <label for="repassword">Re-type password</label>
                                </div>
                                <div id="alert">

                                </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="close"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>
                        </div>
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
