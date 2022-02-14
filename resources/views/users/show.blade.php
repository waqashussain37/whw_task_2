@extends('layouts.users')
@section('title','Show All users')
@section('content')

<div class="table-responsive">         
  <table class="table table-hover">
    <a href="{{url('users/create')}}" class="btn btn-primary btn-lg">Add User</a> <br><br>
        <div id="message" style="display: none;"></div>
    <thead>
      <tr>
        <th>#</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Age</th>
        <th>DOB</th>
        <th>Phone#</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
     @if($user != null)
        @php
        $count=1;
        @endphp
        @foreach($user as $user_data)
        @php
        $date = $user_data->dob;
        @endphp
      <tr id='row{{$user_data->id}}'>
        <td>{{$count}}</td>
        <td>{{$user_data->firstName}}</td>
        <td>{{$user_data->lastName}}</td>
        <td>{{$user_data->email}}</td>
        <td>{{$user_data->age}}</td>
        <td>{{date('d-M-Y', strtotime($date))}}</td>
        <td>{{$user_data->phoneNumber}}</td>
        <td><button class="btn btn-info editUser" data-id="{{$user_data->id}}" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-edit"></i> Edit</button></td>
     <td><button data-id='{{$user_data->id}}' class="btn btn-danger deleteRecord"><i class="fa fa-trash"></i> Delete</button></td>
      </tr> 
      @php $count++; @endphp
      @endforeach
    @endif
    </tbody>
  </table>
  </div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle" style="position: relative;
    top: 22px;">Edit The User </h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form id="userEditFormId">
    <div class="form-group">
      <input type="hidden" name="id" id="userId">
      <label for="firstName">First Name:</label>
      <input type="text" class="form-control" id="firstName" placeholder="Enter First Name" name="firstName" required data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup">
    </div>
    @csrf
    <div class="form-group">
      <label for="lastName">Last Name:</label>
      <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lastName" required data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup" value="">
    </div>
    <div class="form-group">
      <label for="age">Age:</label>
      <input type="text" class="form-control" id="age" placeholder="Enter age" name="age" required min="0" max="200" step="100" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" data-parsley-type="digits" value="">
    </div>
    <div class="form-group">
      <label for="dob">Date Of Birth(MM/DD/YYYY):</label>
      <input type="text" class="form-control" id="dob" placeholder="MM/DD/YYYY" data-parsley-required-message="Date is required." data-parsley-pattern="^[0-9]{2}/[0-9]{2}/[0-9]{4}$" data-parsley-pattern-message="Invalid Date." data-parsley-maxdate="<?php echo date('m/d/Y'); ?>" data-parsley-mindate="01/01/1920" data-date-format="MM/DD/YYYY" name="dob" data-parsley-trigger="keyup" required value="">
    </div>
    <div class="form-group">
      <label for="phoneNumber">Phone Number(123-12-123):</label>
      <input type="tel" class="form-control" id="phoneNumber" placeholder="123-45-678" name="phoneNumber" required data-parsley-trigger="keyup" data-parsley-pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" value="">  
    </div>
    <div class="form-group">
       <label for="Bio">Your Bio:</label>
      <textarea class="form-control" name="Bio" required data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10" id="bio"></textarea>
    </div>
    <div class="invalid-form-error-message"></div>
    <button type="submit" name="submit" class="btn btn-default">Submit</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

  @endsection