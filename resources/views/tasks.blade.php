<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	{{ Form::open([
		'url' => 'tasks',
		'method' => 'post'

	]) }}

		<input type="text" name="name" value="{{$task->name }}">
		<input type="submit" name="">
	{{ Form::close() }}
</body>
</html>