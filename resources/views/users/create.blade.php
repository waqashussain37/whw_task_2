  @extends('layouts.users')
  @section('title','Add Users Form')
  @section('content')
  <form id="userFormId">
    <div id="message" style="display: none;"></div>
    <div class="form-group">
      <label for="firstName">First Name:</label>
      <input type="text" class="form-control" id="firstName" placeholder="Enter First Name" name="firstName" required data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup">
    </div>
    @csrf
    <div class="form-group">
      <label for="lastName">Last Name:</label>
      <input type="text" class="form-control" id="" placeholder="Enter Last Name" name="lastName" required data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required data-parsley-type="email" data-parsley-trigger="keyup">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required data-parsley-length="[8,16]" data-parsley-trigger="keyup">
    </div>
    <div class="form-group">
      <label for="confirmPassword">Confirm Password:</label>
      <input type="password" class="form-control" id="confirmPassword" placeholder="Enter Confirm Password" name="confirmPassword" required data-parsley-equalto="#password" data-parsley-trigger="keyup">
    </div>
    <div class="form-group">
      <label for="age">Age:</label>
      <input type="text" class="form-control" id="age" placeholder="Enter age" name="age" required min="0" max="200" step="100" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" data-parsley-type="digits">
    </div>
    <div class="form-group">
      <label for="dob">Date Of Birth(MM/DD/YYYY):</label>
      <input type="text" class="form-control" id="dob" placeholder="MM/DD/YYYY" data-parsley-required-message="Date is required." data-parsley-pattern="^[0-9]{2}/[0-9]{2}/[0-9]{4}$" data-parsley-pattern-message="Invalid Date." data-parsley-maxdate="<?php echo date('m/d/Y'); ?>" data-parsley-mindate="01/01/1920" data-date-format="MM/DD/YYYY" name="dob" data-parsley-trigger="keyup" required>
    </div>
    <div class="form-group">
      <label for="phoneNumber">Phone Number(123-12-123):</label>
      <input type="tel" class="form-control" id="phoneNumber" placeholder="123-45-678" name="phoneNumber" required data-parsley-trigger="keyup" data-parsley-pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}">  
    </div>
    <div class="form-group">
       <label for="Bio">Your Bio:</label>
      <textarea class="form-control" name="Bio" required data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10"></textarea>
    </div>
    <div class="invalid-form-error-message"></div>
    <button type="submit" name="submit" class="btn btn-default">Submit</button>
      <a href="{{url('users')}}" class="btn btn-primary">Go Back Table</a> 
  </form>
  <br><br><br><br>

  @endsection