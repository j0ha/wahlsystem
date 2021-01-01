<!DOCTYPE html>
<html lang="en">
<head>
    <title>Accepting - Wahlsystem</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/bootstrap/css/bootstrap.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/fonts/iconic/css/material-design-iconic-font.min.css')}}">
    <!--===============================================================================================-->

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background: url({{asset('../img/bg-pattern.png')}}), linear-gradient(to left, #141414, #474747);">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">

					<span class="login100-form-title p-b-49">
						Accept your invitation
                        for the election: {{$election[0]->name}}
					</span>



                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <form action="{{route('helper.Accept')}}" method="post">
                            @csrf
                        <input type="hidden" name="eUUID" value="{{$election[0]->uuid}}">
                        <input type="hidden" name="token" value="{{$helper->token}}">
                        <button type="submit" class="login100-form-btn">
                            Accept
                        </button>
                        </form>
                    </div>
                </div>
                <br>
                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn-decline"></div>
                        <form action="{{route('helper.Decline')}}" method="post">
                            @csrf
                        <input type="hidden" name="eUUID" value="{{$election[0]->uuid}}">
                        <input type="hidden" name="token" value="{{$helper->token}}">
                        <button type="submit" class="login100-form-btn">
                            Decline
                        </button>
                        </form>
                    </div>
                </div>


        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="{{asset('backend/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
<!--===============================================================================================-->
<!--===============================================================================================-->
<script src="{{asset('backend/vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('backend/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('js/main.js')}}"></script>

</body>
</html>