<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{$set->site_name}}</title>
</head>

<body>
<form action="{{$url}}" method="{{$method}}" id="auto_submit">
    @csrf
    @foreach($param as $k=> $v)
        <input type="hidden" name="{{$k}}" value="{{$v}}"/>
    @endforeach
</form>

<script>
	"use strict";
    document.getElementById("auto_submit").submit();
</script>
</body>

</html>

