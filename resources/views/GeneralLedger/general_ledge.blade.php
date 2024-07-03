@extends('admin_dashboard')
<style>
    .td {
        border: 1px solid black;
        border-top: 1px solid black
    }
</style>
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>General Ledger</h4>

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
                    <div class="card-body">
                        <form action="{{ route('view.general.ledger') }}" method="get">
                            @csrf
                            <div class="fieldset">
                                <h1>Accounts Payables</h1>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-floating">
                                            <select name="revenue_code" id="revenue_code" class="form-control selects" style="width: 100%">
                                                <option value="">-- Economic Line Select Option --</option>
                                                @foreach ($expenditureType as $Etype)
                                                <option value="{{ $Etype->economic_code  }}" {{ old('expenditure_type') == $Etype->economic_code ? 'selected': ''}}>
                                                    {{ $Etype->description."::".$Etype->economic_code  }}
                                                </option>
                                                @endforeach
                                            </select>

                                            {{-- <label for="floatingInput">Economic Line</label> --}}

                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-floating mb-3">
                                            <input type="date" name="from" id="from" class="form-control" >
                                            <label for="floatingInput">From</label>
                                            <div id="floatingInputHelp" class="form-text"></div>
                                            @error('batch_type')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-floating mb-3">
                                            <input type="date" name="to" id="to" class="form-control" >
                                            <label for="floatingInput">TO</label>
                                            <div id="floatingInputHelp" class="form-text"></div>
                                            @error('batch_type')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- <div id="addw">

                                </div> --}}




                                <div class="row">
                                    <div class="col">
                                        {{-- <button type="button" class="btn btn-outline-secondary" onclick="add()">Add</button> --}}
                                    </div>
                                    <div class="col" style="text-align: right">
                                        <button type="submit" class="btn btn-primary me-2">SAVE</button>
                                    </div>
                                </div>
                            </div>

                        </form>

                      </div>
                </div>
              </div>
            </div>
        </div>

      </div>

      <div class="col-md-12">
        <div class="card mb-4">

          <div class="card-body">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <a href="{{ route('download.general.ledger.excel', ["from"=>$from, "to"=>$to])}}" class="btn btn-primary">Download to excel</a>
                </div>
            </div>
            <h5 class="card-header">CR</h5>
            <div class="table-reponsive">
                <table class="table table-stripe ">
                    @if ($revenue)

                    @endif

                        @foreach ($revenue->groupBy('economic_name') as $economic_name => $items)

                                <thead>
                                    <tr>
                                        <th>LINE ITEM</th>
                                        <th>{{ $economic_name }}</th>
                                        <th colspan="3" style="text-align-last: center">NCOA</th>
                                        <th>{{ $items[0]->economic_code }}</th>
                                    </tr>
                                    <tr style="border-top: 2px solid black">
                                        <th class="td">Date</th>
                                        <th class="td">NARRATION</th>
                                        <th class="td">REF</th>
                                        <th class="td">DR(N)</th>
                                        <th class="td">CR(N)</th>
                                        <th class="td">BALANCE </th>
                                    </tr>
                                </thead>
                                <tbody>
                            @foreach ($items as  $key=>$item)

                                <tr>
                                    {{-- <td>{{ $key + 1}}</td> --}}
                                    <td class="td"> {{ date("Y-m-d", strtotime($item->created_at)) }} </td>
                                    <td class="td"> {{ $item->narration }} </td>
                                    <td class="td">  </td>
                                    <td class="td">  </td>
                                    <td class="td"> {{ number_format($item->amount, 2)  }} </td>
                                    <td class="td">{{ number_format($item->amount, 2) }} </td>


                                </tr>

                            @endforeach
                        </tbody>
                        @endforeach

                        @foreach ($liabilities->groupBy('economic_name') as $economic_name => $items)

                                <thead>
                                    <tr>
                                        <th>LINE ITEM</th>
                                        <th>{{ $economic_name }}</th>
                                        <th colspan="3" style="text-align-last: center">NCOA</th>
                                        <th>{{ $items[0]->economic_code }}</th>
                                    </tr>
                                    <tr style="border-top: 2px solid black">
                                        <th class="td">Date</th>
                                        <th class="td">NARRATION</th>
                                        <th class="td">REF</th>
                                        <th class="td">DR(N)</th>
                                        <th class="td">CR(N)</th>
                                        <th class="td">BALANCE </th>
                                    </tr>
                                </thead>
                                <tbody>
                            @foreach ($items as  $key=>$item)

                                <tr>
                                    {{-- <td>{{ $key + 1}}</td> --}}
                                    <td class="td"> {{ date("Y-m-d", strtotime($item->created_at)) }} </td>
                                    <td class="td"> {{ $item->narration }} </td>
                                    <td class="td">  </td>
                                    <td class="td">  </td>
                                    <td class="td"> {{ number_format($item->amount, 2)  }} </td>
                                    <td class="td">{{ number_format($item->amount, 2) }} </td>


                                </tr>

                            @endforeach
                        </tbody>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <div class="table-reponsive">
                <h5 class="card-header">DB</h5>
                <table class="table table-stripe ">


                        @foreach ($ExpenditureRegister->groupBy('economic_name') as $economic_name => $items)

                                <thead>
                                    <tr>
                                        <th>LINE ITEM</th>
                                        <th>{{ $economic_name }}</th>
                                        <th colspan="3" style="text-align-last: center">NCOA</th>
                                        <th>{{ $items[0]->economic_code }}</th>
                                    </tr>
                                    <tr style="border-top: 2px solid black">
                                        <th class="td">Date</th>
                                        <th class="td">NARRATION</th>
                                        <th class="td">REF</th>
                                        <th class="td">DR(N)</th>
                                        <th class="td">CR(N)</th>
                                        <th class="td">BALANCE </th>
                                    </tr>
                                </thead>
                                <tbody>
                            @foreach ($items as  $key=>$item)

                                <tr>
                                    {{-- <td>{{ $key + 1}}</td> --}}
                                    <td class="td"> {{ date("Y-m-d", strtotime($item->created_at)) }} </td>
                                    <td class="td"> {{ $item->narration }} </td>
                                    <td class="td">  </td>
                                    <td class="td"> {{ number_format($item->amount, 2)  }} </td>
                                    <td class="td">  </td>
                                    <td class="td">{{ number_format($item->amount, 2) }} </td>


                                </tr>

                            @endforeach
                        </tbody>
                        @endforeach

                        @foreach ($assests->groupBy('economic_name') as $economic_name => $items)

                                <thead>
                                    <tr>
                                        <th>LINE ITEM</th>
                                        <th>{{ $economic_name }}</th>
                                        <th colspan="3" style="text-align-last: center">NCOA</th>
                                        <th>{{ $items[0]->economic_code }}</th>
                                    </tr>
                                    <tr style="border-top: 2px solid black">
                                        <th class="td">Date</th>
                                        <th class="td">NARRATION</th>
                                        <th class="td">REF</th>
                                        <th class="td">DR(N)</th>
                                        <th class="td">CR(N)</th>
                                        <th class="td">BALANCE </th>
                                    </tr>
                                </thead>
                                <tbody>
                            @foreach ($items as  $key=>$item)

                                <tr>
                                    {{-- <td>{{ $key + 1}}</td> --}}
                                    <td class="td"> {{ date("Y-m-d", strtotime($item->created_at)) }} </td>
                                    <td class="td"> {{ $item->narration }} </td>
                                    <td class="td">  </td>
                                    <td class="td"> {{ number_format($item->amount, 2)  }} </td>
                                    <td class="td">  </td>
                                    <td class="td">{{ number_format($item->amount, 2) }} </td>


                                </tr>

                            @endforeach
                        </tbody>
                        @endforeach
                    </tbody>
                </table>
            </div>

          </div>
        </div>
      </div>






    </div>
  </div>


   <!-- Modal -->
   <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="nameWithTitle" class="form-label">Revenue Line</label>
              <input
                type="text"
                id="nameWithTitle"
                class="form-control"
                placeholder="Enter Name" />
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-0">
              <label for="emailWithTitle" class="form-label">Revenue Code</label>
              <input
                type="email"
                id="emailWithTitle"
                class="form-control"
                placeholder="xxxx@xxx.xx" />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  @endsection

