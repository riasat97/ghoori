<!DOCTYPE html>
<html>
<head>
  <title>Ghoori</title>
  <link href='https://fonts.googleapis.com/css?family=Lato:900' rel='stylesheet' type='text/css'>
  <style type="text/css">
  h2 {
    font-family: "lato", sans-serif;
  }
.loader-wrap{
  background: #fff;
  height: 100%;
  width: 100%;
  position: fixed;
  z-index: 99999;
  top: 0;
}
.loader{
  font-size: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translateX(-50%) translateY(-50%);
      -ms-transform: translateX(-50%) translateY(-50%);
                transform: translateX(-50%) translateY(-50%);
  width: 90px;
  height: 90px;
}
.loader img.wheeler{
  width: 90px;
  height: 90px;
  -webkit-animation: ghoorifly_toomuch 6s ease-in infinite;
        animation: ghoorifly_toomuch 6s ease-in infinite;
}
.notice {
  position: absolute;
  bottom: 20%;
  width: 100%;
  text-align: center;
}

@-webkit-keyframes ghoorifly_toomuch {
    0% {-webkit-transform: rotate(0deg)  translate(0px, 0px);}
    20% {-webkit-transform: rotate(-5deg) translate(50px, -50px);}
    40% {-webkit-transform: rotate(-15deg) translate(100px, 0px);}
    60% {-webkit-transform: rotate(-30deg) translate(-50px, -50px);}
    80% {-webkit-transform: rotate(-20deg) translate(50px, -25px);}
}

/* Standard syntax */
@keyframes ghoorifly_toomuch {
    0% {-webkit-transform: rotate(0deg)  translate(0px, 0px);transform: rotate(0deg)  translate(0px, 0px);}
    20% {-webkit-transform: rotate(-5deg) translate(50px, -50px);transform: rotate(-5deg) translate(50px, -50px);}
    40% {-webkit-transform: rotate(-15deg) translate(100px, 0px);transform: rotate(-15deg) translate(100px, 0px);}
    60% {-webkit-transform: rotate(-30deg) translate(-50px, -50px);transform: rotate(-30deg) translate(-50px, -50px);}
    80% {-webkit-transform: rotate(-20deg) translate(50px, -25px);transform: rotate(-20deg) translate(50px, -25px);}
}

  </style>
</head>
<body>
<div class="loader-wrap">
    <div class="loader">
        <img class="wheeler" src="{{asset('img/wheels.png')}}">
    </div>
    <div class="notice"><h2>We will be right back in 15 minutes!</h2></div>
</div>
</body>
</html>