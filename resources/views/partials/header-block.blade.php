<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="{{url('files/ie7.css')}}" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="{{url('files/ie6.css')}}" />
<script type="text/javascript" src="{{url('files/DD_belatedPNG_0.0.8a-min.js')}}"></script>
<script type="text/javascript">
    DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->

<head>
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
    <!-- the necessary css for yukari -->
    <link rel="stylesheet" type="text/css" media="screen,projection" href="{{url('files/yukari.css')}}" />

    <style type="text/css" media="screen">
        *{margin:0 auto;}
        #wrapper {width:90%;margin:15px auto;}
        p { margin:20px 0;}
    </style>
    <!-- yukari plugin -->
    <script src="{{url('files/yukari.js')}}" type="text/javascript"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            /*
             var defaults = {
             containerID: 'yukari', // fading element id
             containerHoverClass: 'yukarihover', // fading element hover class
             scrollSpeed: 1000,
             easingType: 'linear'
             };
             */

            $().yukari({ easingType: 'easeOutQuart' });

        });
    </script>
</head>
</head>