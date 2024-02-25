@extends('admin_dashboard')
<style>
    .td {
        border: 1px solid black;
        border-top: 1px solid black
    }
</style>
@section('admin')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Accounts Receivables</h4>

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
                                                <select name="revenue_code" id="revenue_code" class="form-control">
                                                    <option value="">Select option</option>
                                                    @foreach ($revenue_lines as $item)
                                                        <option value="{{ $item->economic_code  }}" {{ old('revenue_code') == $item->description ? 'selected': ''}}>
                                                            {{ $item->description." :: ".$item->economic_code  }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <label for="floatingInput">Revenue Line/Economic Code</label>

                                                @error('revenue_code')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="from" name="from" placeholder="" value="{{ old('from')}}" />
                                                <label for="floatingInput">From</label>

                                                @error('settlement_date')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
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
                    <h5 class="card-header">Accounts Receivables</h5>
                    <div class="card-body">
                        <div class="table-reponsive">
                            <table class="table table-stripe table-bordered ">


                                @foreach ($revenue->groupBy('revenue_line') as $revenue_line => $rev)
                                    <thead>
                                        <tr>
                                            <th>LINE ITEM</th>
                                            <th>{{ $revenue_line }}</th>
                                            <th colspan="3" style="text-align-last: center">NCOA</th>
                                            <th>{{ $rev[0]->revenue_code }}</th>
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

                                        @foreach ($rev as $key => $item)
                                            <tr>
                                                {{-- <td>{{ $key + 1}}</td> --}}
                                                <td class="td"> {{ date('Y-m-d', strtotime($item->created_at)) }} </td>
                                                <td class="td"> {{ $item->description }} </td>
                                                <td class="td"> </td>
                                                <td class="td"> </td>
                                                <td class="td">{{ number_format($item->revenue_amount, 2) }} </td>
                                                <td class="td">{{ number_format($item->revenue_amount, 2) }} </td>


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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Revenue Line</label>
                            <input type="text" id="nameWithTitle" class="form-control" placeholder="Enter Name" />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Revenue Code</label>
                            <input type="email" id="emailWithTitle" class="form-control" placeholder="xxxx@xxx.xx" />
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
