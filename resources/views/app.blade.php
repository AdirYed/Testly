<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ config('app.direction') }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta name="description"
        content="טסטלי מבחני תאוריה. האתר מספק סימולציית מבחני תאוריה לכל הרישיונות באופן חדשני, מקצועי, איכותי וחינמי!">
  <meta name="keywords" content="מבחני תאוריה, טסטלי, לימוד מבחני תאוריה, לימוד, תאוריה, תחבורה">

  <title>טסטלי - מבחני תאוריה</title>
  <meta itemprop="name">
  <meta property="og:title">
  <meta name="twitter:title">
  <meta name="description"/>
  <meta itemprop="description">
  <meta property="og:description">
  <meta name="twitter:description">

  <link rel="icon" href="{{ URL::asset('/assets/icon.png') }}" type="image/x-icon"/>
  <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
<div id="app">
  <testly-app></testly-app>
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
