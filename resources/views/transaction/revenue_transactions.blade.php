@extends('admin_dashboard')


@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Revenue Transactions /</span> Revenue Receipts</h4>

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
                    <form action="{{ route('view.approve.revenue') }}" method="get" class="mt-3">
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
          <h5 class="card-header">Revenue(s)</h5>
          <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-stripe">
                        <thead>
                            <tr>


                                {{-- <th>Action</th> --}}
                                <th>Revenue Line</th>
                                <th>Received From </th>
                                <th>Description </th>
                                <th>Authority Document Ref. No </th>
                                <th>RRR</th>
                                <th>Amount </th>
                                <th>Date </th>
                                <th>Created By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($revenue as  $key=>$item)
                                <tr>
                                    <td>{{ $item->revenue_line }}</td>
                                    <td>{{ $item->received_from }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->authority_document_ref_no }}</td>
                                    <td>{{ $item->rrr }}</td>
                                    <td>{{ number_format($item->revenue_amount, 2)  }}</td>
                                    <td>{{ date("Y-m-d", strtotime($item->settlement_date)) }}</td>
                                    <td>{{ $item->name }}</td>
                                </tr>
                            @endforeach

                        </tbody>
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
