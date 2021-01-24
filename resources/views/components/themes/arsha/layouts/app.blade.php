
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Piofx Media</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="@if(isset(Session::get('settings')->favicon)){!! Session::get('settings')->favicon !!}@else /favicon.ico @endif" rel="icon">

  @include('components.themes.arsha.blocks.styles')

</head>

<body>

  @include('components.themes.arsha.blocks.header')

  <main id="main">
    <section class="inner-page">
      <div class="p-4"></div>
      <div class="container">
        <p>
          {{$slot}}
        </p>
      </div>
    </section>

  </main><!-- End #main -->

  @include('components.themes.arsha.blocks.footer')
  @include('components.themes.arsha.blocks.scrolltop')
  @include('components.themes.arsha.blocks.scripts')

</body>

</html>