@extends('admin_dashboard')
<style>
    .td {
        border: 1px solid black;
        border-top: 1px solid black
    }
</style>
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Accounts Payables</h4>

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
                        <form action="{{ route('post.expenditure') }}" method="post">
                            @csrf
                            <div class="fieldset">
                                <h1>Accounts Payables</h1>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-floating mb-3">
                                            <select name="batchType" id="batchType" class="form-control">
                                                <option value="">-- Select Option --</option>


                                                {{-- <option value="Vendor">Vendor</option> --}}
                                            </select>
                                            <label for="floatingInput">Batch Type</label>
                                            <div id="floatingInputHelp" class="form-text"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">

                                                <select name="expenditureType" id="expenditureType" class="form-control">
                                                    <option value="">-- Select Option --</option>

                                                </select>
                                            <label for="floatingInput">Batch Type</label>
                                            <div id="floatingInputHelp" class="form-text"></div>
                                            @error('batch_type')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="date" name="date" id="date" class="form-control" >
                                            <label for="floatingInput">Date</label>
                                            <div id="floatingInputHelp" class="form-text"></div>
                                            @error('batch_type')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('authority_document_ref_no') is-invalid @enderror" id="floatingInput" name="authority_document_ref_no" placeholder="Authority Document Ref. No" value="{{ old('authority_document_ref_no')}}" />
                                            <label for="floatingInput">Authority Document Ref. No</label>

                                            @error('authority_document_ref_no')
                                            <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Year" value="" />
                                            <label for="floatingInput">Paid to</label>
                                            <div id="floatingInputHelp" class="form-text"> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-5">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingInput" name="amount" placeholder="Amount" />
                                            <label for="floatingInput">Amount</label>
                                            <div id="floatingInputHelp" class="form-text"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingInput" name="narration" placeholder="Narration"  />
                                            <label for="floatingInput">Narration/Description of Payment</label>
                                            <div id="floatingInputHelp" class="form-text"> </div>

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

            @if (count($account_payable) > 0)
            <div class="card mb-4">
                <h5 class="card-header">Accounts Payables</h5>
                <div class="card-body">
                    <div class="table-reponsive">
                        <table class="table table-stripe table-bordered ">
                                <thead>
                                    <tr>
                                        <th>Vendor Type</th>
                                        <th>Receivable From</th>
                                        <th>Amount Receivable</th>
                                        <th>Nassarion</th>
                                        <th>Due Date</th>
                                        <th>Created On  </th>
                                        <th>Created By</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($account_payable as $key => $item)
                                        <tr>
                                            <td> {{ $item->vendor }} </td>
                                            <td> {{ $item->payable_to }} </td>
                                            <td> {{ number_format($item->payable_amount, 2) }} </td>
                                            <td> {{ $item->narration }} </td>

                                            <td> {{ date('Y-m-d', strtotime($item->due_date)) }} </td>
                                            <td> {{ date('Y-m-d', strtotime($item->created_on)) }} </td>

                                            <td> {{ $item->name }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @else
            <div class="card text-center">
                <div class="card-header">Accounts payable</div>
                <div class="card-body">
                  <h5 class="card-title">Accounts payable (AP)</h5>
                  <p class="card-text">Amounts due to vendors or suppliers for goods or services received that have not yet been paid for</p>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add new</button>
                </div>
                <div class="card-footer text-muted">{{  now()->toDateTimeString() }}</div>
            </div>
            @endif



      </div>






    </div>
  </div>


   <!-- Modal -->
   <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Add Payable</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('post.account_payable') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="payable_to" class="form-label">Vendor</label>
                            <input type="text" id="vendor" name="vendor" value="{{ old('vendor') }}" class="form-control  @error('vendor') is-invalid @enderror" placeholder="Enter Name" />
                            @error('vendor')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-7 mb-3">
                            <label for="payable_to" class="form-label">Payable to</label>
                            <input type="text" id="payable_to" name="payable_to" value="{{ old('payable_to') }}" class="form-control  @error('payable_to') is-invalid @enderror" placeholder="Enter Name" />
                            @error('payable_to')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="payable_amount" class="form-label">Payable Amount</label>
                            <input type="text" id="payable_amount" name="payable_amount" value="{{ old('payable_amount') }}" class="form-control  @error('payable_amount') is-invalid @enderror" placeholder="10000.00" />
                            @error('payable_amount')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}" class="form-control  @error('due_date') is-invalid @enderror" />
                            @error('due_date')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="description" class="form-label">Description</label>
                            <textarea type="text" id="description" name="description" class="form-control  @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

  @endsection

