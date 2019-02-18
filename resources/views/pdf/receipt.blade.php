@extends('pdf.layout')

@section('content')
  <div>
    <h2>Mentor Language Institute - Hollywood</h2>
    <div class="header">
      <div class="basic-info">
        <div>7080 HOLLYWOOD BLVD, HOLLYWOOD, CA 90028</div>
        <div><strong>TEL</strong> (323) 870-7102, <strong>FAX</strong> (323) 488-9748</div>
      </div>
      <div class="group">
        <h1>RECEIPT <small>(Studnet Copy)</small></h1>
      </div>
    </div>
    <div class="detail-wrapper">
      <div class="meta-box">
        <div class="meta">
          <span class="meta-label">Receipt ID</span>
          <span class="meta-value">{{ $invoice->id }}</span>
        </div>
        <div class="meta">
          <span class="meta-label">Name</span>
          <span class="meta-value">{{ $invoice->student->full_name }}</span>
        </div>
        <div class="meta">
          <span class="meta-label">Method</span>
          <span class="meta-value">{{ $invoice->payment_method->method }}</span>
        </div>
        <div class="meta">
          <span class="meta-label">Issued At</span>
          <span class="meta-value">{{ $invoice->updated_at }}</span>
          <span class="meta-value"></span>
        </div>
      </div>
      <div class="item-box">
        <table class="table-fluid">
          <thead>
            <tr>
              <th>Name</th>
              <th>Date</th>
              <th>Quantity</th>
              <th style="text-align: right">Price</th>
              <th style="text-align: right">Amount</th>
            </tr>
          </thead>
          <tbody>
            @foreach($invoice->product as $product)
            <tr>
              <td class="__item-name">{{ $product->name }}</td>
              <td class="__item-term">{{ $product->pivot->start_date }} - {{ $product->pivot->completion_date }}</td>
              <td class="__item-quantity">{{ $product->pivot->quantity }}</td>
              <td class="__item-price">{{ $product->pivot->price }}</td>
              <td class="__item-total">
                {{ $product->pivot->price * $product->pivot->quantity }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="footer">
        <div class="issuer">
          <strong class="issuer-label">Issued By</strong>
          <span class="issuer-value">{{ $invoice->creator->full_name }}</span>
        </div>
        <div class="total">
          <strong class="total-label">Total</strong>
          <span class="total-value">
            @php
              $total = 0;
              foreach ($invoice->product as $product) {
                $total += ($product->pivot->quantity * $product->pivot->price);
              }
              echo $total;
            @endphp
          </span>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('style')
<style>
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
    min-height: 300px;
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