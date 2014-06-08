<!DOCTYPE html>
<html lang="en">
  <head>
    <title>URL Shortener</title>
    <link rel="stylesheet" href="/assets/css/styles.css" />
  </head>
  <body>
	@if(Session::has('errors'))
		<h3 class="error">{{$errors->first('link')}}</h3>
	@endif
	@if(Session::has('link'))
		<h3 class="success">
		<h4>The shortened url is : localhost:8080/{{(Session::get('link'))}}</h4>
		{{HTML::link(Session::get('link'),'Click here for your shortened URL')}} 
		</h3>
	@endif
	@if(Session::has('message'))
		<h3 class="error">{{Session::get('message')}}</h3>
	@endif
    <div id="container">
      <h2>Uber-Shortener</h2>
      {{Form::open(array('url'=>'/','method'=>'post'))}}
      {{Form::text('link',Input::old('link'), 
        array('placeholder'=> 
        'Insert your URL here and press enter!'))}}
      {{Form::close()}}
    </div>
  </body>
</html>