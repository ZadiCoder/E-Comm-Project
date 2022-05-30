@extends('front.layout.layout')

@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Login</li>
    </ul>
	<h3>Login</h3>	
    <div class="well">
        <form class="form-horizontal" >
            <div class="control-group">
                <label class="control-label" for="input_email">Email <sup>*</sup></label>
                <div class="controls">
                    <input type="email" id="input_email" placeholder="Enter Email">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="input_email">Password <sup>*</sup></label>
                <div class="controls">
                    <input type="password" id="input_password" placeholder="*********">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input type="submit" value="Login">
                </div>
            </div>

        </form>
    </div>
    <h3> Registration</h3>	
	<div class="well">
        <form action="{{route('user_store')}}" method="POST" class="form-horizontal">
            @csrf
            <div class="control-group">
                <label class="control-label" for="inputFname1">First name <sup>*</sup></label>
                <div class="controls">
                <input type="text" id="inputFname1" name="first_name" required placeholder="First Name">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputLnam">Last name <sup>*</sup></label>
                <div class="controls">
                <input type="text" id="inputLnam" name="last_name" required placeholder="Last Name">
                </div>
            </div>
            <div class="control-group">
            <label class="control-label" for="input_email">Email <sup>*</sup></label>
            <div class="controls">
            <input type="email" id="input_email" name="email" required placeholder="Email">
            </div>
        </div>	  
        <div class="control-group">
            <label class="control-label" for="inputPassword1">Password <sup>*</sup></label>
            <div class="controls">
            <input type="password" id="inputPassword1" name="password" required placeholder="Password">
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input type="submit" value="Registration">
            </div>
        </div>
        </form>
    </div>
@endsection