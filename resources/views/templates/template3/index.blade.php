<!DOCTYPE html>
<html lang='en' xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>RbeSell</title>
    <link rel='stylesheet' href="{{ asset('material-design/css/app.css') }}">
</head>
<body>
<div id="app">
    
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

<script type='text/javascript' src="{{ asset('material-design/js/app.js') }}"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>
