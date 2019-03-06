@extends('pdf.layout')

@section('content')
  @include('pdf.student_copy')
  @include('pdf.school_copy')
  @include('pdf.student_file_copy')
@endsection

@section('style')
<style>
  .section {
    margin: 65px 0;
  }

  .__option{
    margin-left: 15px;
  }
  .__option_box {
    display: inline-block;
    margin-right: 7px;
  }

  .__option_name {
    font-size: 13px;
    font-weight: bold;
  }

  .__option_value {
    font-size: 13px;
  }

  .table-fluid {
    width: 100%;
  }

  .__item-name {
    width: auto;
  }

  .__item-term {
    width: 25%;
    text-align: center;
  }

  .__item-quantity {
    width: 6%;
    text-align: center;
  }

  .__item-price {
    width: 13%;
    text-align: right;
  }

  .__item-total {
    width: 15%;
    text-align: right;
  }

  .header {
    border-bottom: 1px dashed grey;
    padding-bottom: 10px;
    margin-bottom: 20px;
    position: relative;
  }

  .header:after {
    content: "";
    display: block;
    clear: both;
  }
  .basic-info {
    /*float: left;*/
  }
  .group {
    position: absolute;
    bottom: 10px;
    right: 0px;
    /*float: right;*/
  }
  
  .meta-box .meta:first-child {
    padding-left: 0px;
  }

  .meta-box .meta {
    display: inline-block;
    padding: 3px 10px;
  }

  .meta-box .meta .meta-label {
    font-size: 18px;
    font-weight: bold;
    padding-right: 5px;
  }

  .meta-box .meta .meta-value {
    font-size: 18px;
  }

  .item-box {
    padding-top: 20px;
    min-height: 270px;
  }

  .footer {
  
  }
  
  .footer:after {
    content: "";
    display: block;
    clear: both;
  }

  .issuer {
    float: left;
  }

  .issuer-label {
    font-size: 20px;
    padding-right: 6px;
  }

  .issuer-value {
    font-size: 20px;
  }

  .total {
    float: right;
  }

  .total-label {
    font-size: 20px;
    padding-right: 6px;
  }

  .total-value {
    font-size: 20px;
  }
  
  h1 {
    padding: 0;
    margin: 0;
    font-size: 30px;
  }

  h2 {
    font-size: 20px;
  }

  table tbody tr td {
    padding: 3px 0;
  }
</style>
@endsection