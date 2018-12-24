<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  @php
    print_r($test)
  @endphp
  {{-- @foreach($invoice->product as $product)
  <tr>
    <td class="__item-name">{{ $product->name }}</td>
    <td class="__item-term">{{ $product->pivot->start_date }} - {{ $product->pivot->completion_date }}</td>
    <td class="__item-quantity">{{ $product->pivot->quantity }}</td>
    <td class="__item-price">{{ $product->pivot->price }}</td>
    <td class="__item-total">
      {{ $product->pivot->price * $product->pivot->quantity }}
    </td>
  </tr>
  @endforeach --}}
</body>
</html>