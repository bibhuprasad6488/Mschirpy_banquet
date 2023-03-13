<!doctype html>
<html lang="en">

<head>
    <title>
        Ms Chirpy Banquet Booking | Thank You
    </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/assets/img/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://kit.fontawesome.com/1640028a46.css" crossorigin="anonymous">

   
    <style>
@import url('https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Playfair+Display&display=swap');

        body::-webkit-scrollbar {
            display: none;
            /* overflow: hidden; */
        }

        #mob:focus {
            box-shadow: none !important;
        }
        img{
            opacity: 0.5;
        }

        body{
            margin: 0;
        }

        .contain{
          position:absolute;
          bottom: 5px;
      }

        .bg-opacity{
            position: relative;
            background-color: #ff5b61;
        }

        .bg-opacity::before{
            content: ' ';
            display: block;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            opacity: 0.5;
            background:url("{{ asset('front/assets/img/thankyou.png') }}") no-repeat center center;
            background-size: cover;
        }

        .content{
          position: relative;
          width: 100%;
          height: 100vh;
        }
        .btn{
            background-color: #ff5b61 !important;
            font-weight: 500;
            font-size: 20px;
            border-radius: 5px;
            color: #fff;
            font-family: 'Playfair Display',sans-serif !important;
        }
        .btn:hover{
            cursor: pointer;
            background-color: #fff !important;
            color: #ff5b61;
            font-weight: 600;
            letter-spacing: 1px;
            transition: 0.5s ease-in-out;
            transform: scale(1.1);
        }
    </style>

</head>

<body>
<div class="bg-opacity">
    
  <div class="content">
<div class="container-fluid contain">
        <div class="row">
            <div class="col-md-12 m-auto text-center ">
                <div class="btn-group mx-2">
                    <a href="/banquet/all-venues" class="btn  m-1">Go to Home <i class="fa-solid fa-house mx-1"></i></a>
                </div>
                <div class="btn-group mx-2">
                    <a href="/banquet/profile" class="btn  m-1">Go to Profile <i class="fa-solid fa-user mx-1"></i></a>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

    {{-- <img src="{{ asset('front/assets/img/thankyou.png') }}" alt="Forest" width="100%" height="100%"> --}}

    <main  >
        <!--? slider Area Start-->
       
        <div class="container  h-100">
            
            <!-- div class="row  justify-content-center align-items-center h-100">
                <div class="col-md-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card  text-white " >
                        
                        <div class="card-body p-1" style="background-image: url('');">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="{{ asset('front/assets/img/thankyou.png') }}" class="img-responsive img-fluid">
                                </div>
                            </div>
                            


                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- slider Area End-->

    </main>
   
    <script>
        // document.addEventListener('contextmenu', (e) => e.preventDefault());

        // function ctrlShiftKey(e, keyCode) {
        //     return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
        // }

        // document.onkeydown = (e) => {
        //     // Disable F12, Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U
        //     if (
        //         event.keyCode === 123 ||
        //         ctrlShiftKey(e, 'I') ||
        //         ctrlShiftKey(e, 'J') ||
        //         ctrlShiftKey(e, 'C') ||
        //         (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
        //     )
        //         return false;
        // };
    </script>
   
</body>
<script src="https://kit.fontawesome.com/1640028a46.js" crossorigin="anonymous"></script>

</html>
