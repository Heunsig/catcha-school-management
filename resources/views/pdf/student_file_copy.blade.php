<div class="section">
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
        <span class="meta-value">{{ $payment->id }}</span>
      </div>
      <div class="meta">
        <span class="meta-label">Method</span>
        <span class="meta-value">{{ $payment->payment_method->method }}</span>
      </div>
      <div class="meta">
        <span class="meta-label">Name</span>
        <span class="meta-value">{{ $payment->student->full_name }}</span>
      </div>
    </div>
    <div class="meta-box">
      <div class="meta">
        <span class="meta-label">Issued at</span>
        <span class="meta-value">{{ Carbon::parse($payment->updated_at)->format('m/d/Y') }}</span>
        <span class="meta-value"></span>
      </div>
      <div class="meta">
        <span class="meta-label">Print date</span>
        <span class="meta-value">{{ Carbon::now()->format('m/d/Y g:iA') }}</span>
        <span class="meta-value"></span>
      </div>
    </div>
    <div class="item-box">
      <table class="table-fluid">
        <thead>
          <tr>
            <th style="text-align: left;">Name</th>
            <th>Week</th>
            <th>Quantity</th>
            <th style="text-align: right">Price</th>
            <th style="text-align: right">Amount</th>
          </tr>
        </thead>
        <tbody>
          @foreach($payment->payment_detail as $item)
          <tr>
            <td class="__item-name">
              {{ $item->product->name }}
              @if (count($item->attribute) > 0)
                <span class="__option">Options - </span>
                @foreach($item->attribute as $att)
                  <div class="__option_box">
                    <span class="__option_name">{{ $att->attribute->name }}:</span>
                    <span class="__option_value">{{ $att->value->value }}</span>
                  </div>
                @endforeach
              @endif
            </td>
            <td class="__item-term">{{ $item->week }}</td>
            <td class="__item-quantity">{{ $item->quantity }}</td>
            <td class="__item-price">
              ${{ number_format($item->price, 2, ',', '.') }}
            </td>
            <td class="__item-total">
              ${{ number_format($item->price * $item->quantity, 2, ',', '.') }}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="footer">
      <div class="issuer">
        <strong class="issuer-label">Issued by</strong>
        <span class="issuer-value">{{ $payment->creator->full_name }}</span>
      </div>
      <div class="total">
        <strong class="total-label">Total</strong>
        <span class="total-value">
          @php
            $total = 0;
            foreach ($payment->payment_detail as $item) {
              $total += ($item->quantity * $item->price);
            }
            echo '$'.number_format($total, 2, ',', '.');
          @endphp
        </span>
      </div>
    </div>
  </div>
</div>