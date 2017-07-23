<!DOCTYPE html>
<html lang='en' xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Juan Merkado</title>
<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">
<link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet" type="text/css">
 
    
</head>
<body>
<div id="app">
    <main-layout></main-layout>
    <main-footer></main-footer>
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
</body>
</html>
