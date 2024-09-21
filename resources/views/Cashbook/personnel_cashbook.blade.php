@extends('admin_dashboard')
@section('title', 'Personnel cashbook')

@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Cashbook /</span> Personnel Cashbook</h4>

    <div class="row">
      <div class="col-md-8">
        <div class="accordion mb-4" id="accordionExample">
            <div class="card accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                  Search
                </button>
              </h2>

              <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="{{ route('personnel.cashbook') }}" method="get" class="mt-3">
                        @csrf
                        <div class="fieldset">
                            <h1>Search</h1>
                            <div class="row mb-3">








                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="from" name="from" placeholder="" value="{{ old('from')}}" />
                                        <label for="floatingInput">From</label>

                                        @error('settlement_date')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="to" name="to" placeholder="" value="{{ old('to')}}" />
                                        <label for="floatingInput">To</label>
                                        @error('settlement_date')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-10">.</div>
                                <div class="col-2" style="text-align: right">
                                    <button type="submit" class="btn btn-primary me-2">Search</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
              </div>
            </div>
        </div>

      </div>

      <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">PERSONNEL CASHBOOK</h5>
          <div class="card-body">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="display" id="pagelength-btn">
                                <thead>

                                    <tr>
                                        <th>Transaction Date</th>
                                        <th>Authority ref no.</th>
                                        <th>Line </th>
                                        <th>Description </th>
                                        <th>NCOA (ECONOMIC CODE)</th>
                                        <th>Expenditure (DR)</th>
                                        <th>Revenue (CR)</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $balance = 0;
                                        $cr = 0;
                                        $db = 0;
                                    ?>
                                    @foreach ($personnel as $item)
                                    <?php
                                        $exp = $item->code[0] == 1 ? (float) $item->amount : 0;
                                        $rev = $item->code[0] == 2 ? (float) $item->amount : 0;
                                        $ba = $rev - $exp;
                                        $cr = $cr + $rev;
                                        $db = $db + $exp;
                                        $balance = $balance + $ba;
                                    ?>
                                    <tr>
                                        <td>{{ date("Y-m-d", strtotime($item->date)) }}</td>
                                        <td>{{ $item->payment_ref }}</td>
                                        <td>{{ $item->line }}</td>
                                        <td>{{ $item->narration }}</td>
                                        <td>{{ $item->code }}</td>

                                        <td>{{ $item->code[0] == 1 ? number_format($item->amount, 2) : "0.00" }}</td>
                                        <td>{{ $item->code[0] == 2 ? number_format($item->amount, 2) : "0.00" }}</td>
                                        <td>{{ $balance < 0 ? "(".number_format(abs($balance), 2).")" : number_format($balance, 2) }}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ number_format($db, 2) }}</td>
                                        <td>{{ number_format($cr, 2) }}</td>
                                        <td>{{ number_format($balance, 2) }}</td>
                                    </tr>
                                </tfoot>


                            </table>

                        </div>
                    </div>


                </div>

          </div>
        </div>
      </div>






    </div>
  </div>



  @endsection

<script>

</script>