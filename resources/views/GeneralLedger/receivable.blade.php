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
                @if (count($receivables) > 0)
                <div class="card mb-4">
                    <div class="row">
                        <div class="col-6">
                            {{-- <h5 class="card-header">Drafted asset(s)</h5> --}}
                        </div>
                        <div class="col-6">
                            <div style="text-align: right; padding: 20px">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add new receivables</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-reponsive">
                            <table class="table table-stripe table-bordered ">
                                    <thead>
                                        <tr>
                                            {{-- <th>Vendor Type</th> --}}
                                            <th>Receivable From</th>
                                            <th>Amount Receivable</th>
                                            <th>Nassarion</th>
                                            <th>Due Date</th>
                                            <th>Created On  </th>
                                            <th>Created By</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($receivables as $key => $item)
                                            <tr>
                                                <td> {{ $item->receivable_from }} </td>
                                                <td> {{ number_format($item->receivable_amount, 2) }} </td>
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
                    <div class="card-header">Accounts Receivable</div>
                    <div class="card-body">
                      <h5 class="card-title">Accounts Receivable (AR)</h5>
                      <p class="card-text">Payment which the company will receive from its customers who have purchased its goods & services on credit</p>
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
                    <h5 class="modal-title" id="modalCenterTitle">Add Receivable</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('post.account_receivable') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="receivable_from" class="form-label">Receivable from</label>
                                <input type="text" id="receivable_from" name="receivable_from" value="{{ old('receivable_from') }}" class="form-control  @error('receivale_from') is-invalid @enderror" placeholder="Enter Name" />
                                @error('receivable_from')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="text" id="amount" name="amount" value="{{ old('amount') }}" class="form-control  @error('amount') is-invalid @enderror" placeholder="10000.00" />
                                @error('amount')
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

