@extends('admin_dashboard')


@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Transactions /</span> Treasure casbook</h4>

    <div class="row">
      <div class="col-md-12">
        <div class="accordion mb-4" id="accordionExample">
            <div class="card accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                  Search
                </button>
              </h2>

              <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="{{ route('revenue.transaction') }}" method="get" class="mt-3">
                        @csrf
                        <div class="fieldset">
                            <h1>Search</h1>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <select name="revenue_code" id="revenue_code" class="form-control selects" style="width: 100%">
                                            <option value="">SELECT REVENUE LINE</option>
                                            @foreach ($revenue_lines as $item)
                                                <option value="{{ $item->economic_code  }}" {{ old('revenue_code') == $item->description ? 'selected': ''}}>
                                                    {{ $item->description." :: ".$item->economic_code  }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- <label for="floatingInput">Revenue Line/Economic Code</label> --}}


                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="form-floating">
                                        <select name="created_by" id="created_by" class="form-control selects" style="width: 100%">
                                            <option value="">SELECT CREATED BY</option>
                                            @foreach ($initiators as $item)
                                                <option value="{{ $item->username  }}">
                                                    {{ $item->name  }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" class="form-control" id="authority_ref" name="authority_ref" placeholder=""  /> --}}
                                        {{-- <label for="floatingInput">CREATED BY</label> --}}
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="rrr" name="rrr" placeholder="" value="{{ old('to')}}" />
                                        <label for="floatingInput">RRR</label>

                                        @error('settlement_date')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="authority_ref" name="authority_ref" placeholder=""  />
                                        <label for="floatingInput">AUTHORITY DOCUMENT REF. NO</label>

                                        @error('settlement_date')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="received_from" name="received_from" placeholder=""  />
                                        <label for="floatingInput">RECEIVED FROM</label>

                                        @error('settlement_date')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="from" name="from" placeholder="" value="{{ old('from')}}" />
                                        <label for="floatingInput">From</label>

                                        @error('settlement_date')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
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
          <h5 class="card-header">TREASURE CASHBOOK</h5>
          <div class="card-body">
                <div class="table-responsive">
                    <table>
                        <tr>
                            <td>
                                <table class="table table-stripe">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Receive from </th>
                                            <th>Description Details of Receipt </th>
                                            <th>NCOA (ECONOMIC CODE)</th>
                                            <th>Authority Document ref no.</th>
                                            <th>Amount Received </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($revenue as $item)
                                        <tr>
                                            <td>{{ $item->revenue_date }}</td>
                                            <td>{{ $item->received_from }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->revenue_code }}</td>
                                            <td>{{ $item->authority_document_ref_no }}</td>
                                            <td>{{ number_format($item->revenue_amount, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </td>
                            <td>
                                <table class="table table-stripe">
                                    <thead>
                                        <tr>
                                            <th>Date </th>
                                            <th>Paid To </th>
                                            <th>Description of Payment </th>
                                            <th>NCOA (ECONOMIC CODE)</th>
                                            <th>Authority Document ref no.</th>
                                            <th>Amount Received </th>
                                            {{-- <th>Created By</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($expenses as $item1)
                                        <tr>
                                            <td>{{ $item1->created_at }}</td>
                                            <td>{{ $item1->name }}</td>
                                            <td>{{ $item1->narration }}</td>
                                            <td>{{ $item1->expenditure_code }}</td>
                                            <td>{{ $item1->payment_ref }}</td>
                                            <td>{{ number_format($item1->amount, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>

                </div>

          </div>
        </div>
      </div>






    </div>
  </div>



  @endsection

<script>

</script>
