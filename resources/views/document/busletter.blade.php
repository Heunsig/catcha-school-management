@extends('document.layout')

@section('content')
<div style="padding: 120px;">

  <p>{{ $issuing_date }}</p>
  
  <div class="info-box">
    <div class="info"><strong>Name:</strong> {{ $sex }}. {{ $name }}</div>
    <div class="info"><strong>Country of Citizenship:</strong> {{ $country_of_citizenship }}</div>
    <div class="info"><strong>DOB:</strong> {{ $date_of_birth }}</div>
  </div>

  <div class="letter">
    <p>To Whom It May Concern:</p>
    <p>This is to verify that the above named student is enrolled in an ESL (English as a Second Language) Program at our institution. The class schedule is from 8:30 a.m. to 12:45 p.m., Monday through Thursday.</p>
    <p>The above mentioned student began the study at our institution on {{ $start_date }} and is expected to complete the current program on {{ $completion_date }}.</p>
    <p>Should you have any questions please do not hesitate to contact us.</p>
  </div>

  <p class="wrap-up-greeting">Sincerely,</p>

  <div class="office-manager">
    Haiwei Wang, <br/>
    Office Manager
  </div>


</div>
@endsection
@section('style')
<style>
  p {
    font-size: 28px;
  }
    
  .info-box {
    padding-top: 20px;
  }

  .info {
    font-size: 33px;
  }

  .letter {
    padding-top: 40px;
    padding-bottom: 70px;
  }

  .wrap-up-greeting {
    font-size: 28px;
  }

  .office-manager {
    font-size: 28px;
    padding-top : 150px;
  }

</style>
@endsection