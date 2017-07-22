<!DOCTYPE html>
<html lang='en' xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Juan Merkado</title>
    <link rel='stylesheet' href="{{ asset('template3/assets/css/template3.css') }}">
   
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i;Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    
</head>
<body>
<div id="app">
        <header class="header header-style1">
            <header-top></header-top>
            <header-mid></header-mid>
            <header-bottom></header-bottom>
            <menu-primary></menu-primary>
        </header>
        <main-content></main-content>
        <juan-footer></juan-footer>

    
</div>
<script type="text/javascript">
    window.SiteKey = {!!  json_encode([
                    'googleSiteKey' => env('RE_CAP_SITE')
                  ]) !!}
    
    window.Laravel = {!!

                json_encode([
                    'csrfToken' => csrf_token()
                  ])

              !!}
</script>

<script type='text/javascript' src="{{ asset('template3/assets/js/template3.js') }}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>
