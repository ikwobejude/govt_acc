@extends('admin_dashboard')
<style>
    .td {
        border: 1px solid black;
        border-top: 1px solid black
    }

    .tdleft {
        text-align: right
    }
</style>
@section('admin')
    <div class="container flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Accounts Receivables</h4>
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="pages-account-settings-account.html"
                        ><i class="bx bx-user me-1"></i> PERSONNEL </a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="pages-account-settings-notifications.html"
                        ><i class="bx bx-bell me-1"></i> OVERHEAD</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="javascript:void(0);"
                        ><i class="bx bx-link-alt me-1"></i> CAPITAL</a
                      >
                    </li>
                </ul>
            </div>

            <div class="col-md mb-4 mb-md-2">
              {{-- <small class="text-light fw-medium">Basic Accordion</small> --}}
              <div class="accordion mt-3" id="accordionExample">
                <div class="card accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                      Search
                    </button>
                  </h2>

                  <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form action="{{ route('post.expenditure') }}" method="post" class="mt-3">
                            @csrf
                            <div class="fieldset">
                                <h1>Search</h1>
                                <div class="row ">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-floating mb-3">
                                            <select name="expenditure_type" id="expenditure_type"
                                                class="form-control @error('batch_type') is-invalid @enderror">
                                                <option value="">-- Select Option --</option>

                                            </select>
                                            <label for="floatingInput">REVENUE TYPE</label>
                                            <div id="floatingInputHelp" class="form-text"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <select name="batch_type" id="batch_type"
                                                class="form-control @error('batch_type') is-invalid @enderror">
                                                <option value="">-- Select Option --</option>


                                                {{-- <option value="Vendor">Vendor</option> --}}
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
                                            <input type="date" name="date" id="date" class="form-control">
                                            <label for="floatingInput">Date</label>
                                            <div id="floatingInputHelp" class="form-text"></div>
                                            @error('batch_type')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control @error('authority_document_ref_no') is-invalid @enderror"
                                                id="floatingInput" name="authority_document_ref_no"
                                                placeholder="Authority Document Ref. No"
                                                value="{{ old('authority_document_ref_no') }}" />
                                            <label for="floatingInput">Authority Document Ref. No</label>

                                            @error('authority_document_ref_no')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingInput" name="name"
                                                placeholder="Year" value="" />
                                            <label for="floatingInput">Paid to</label>
                                            <div id="floatingInputHelp" class="form-text"> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-5">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingInput" name="amount"
                                                placeholder="Amount" />
                                            <label for="floatingInput">Amount</label>
                                            <div id="floatingInputHelp" class="form-text"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingInput" name="narration"
                                                placeholder="Narration" />
                                            <label for="floatingInput">Narration/Description of Payment</label>
                                            <div id="floatingInputHelp" class="form-text"> </div>

                                        </div>
                                    </div>
                                </div>


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

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Budget Year: 2024</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripe table-bordered " style="border-top: 2px solid black">



                                    <thead>

                                        <tr >
                                            <th >Organization</th>
                                            <th >Fund</th>
                                            <th >Account</th>
                                            <th >Program</th>
                                            <th >Region</th>
                                            <th >Account Name </th>
                                            <th >Budget Amount</th>
                                            <th class="tdleft">Legal Commitments</th>
                                            <th class="tdleft">Financial Commitments</th>
                                            <th class="tdleft">Actual Expenditures</th>
                                            <th class="tdleft">Total Expenditures</th>
                                            <th >Available</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                            $budgetedAmount = 0;
                                            $actualAmount = 0;
                                            $totalExpenditure = 0;
                                            $totalAvailable =0;
                                        ?>
                                        @foreach ($budges as $key => $item)
                                        <?php
                                           $avialable = (float)$item->current_budget - (float)$item->amount;

                                            $budgetedAmount += (float)$item->current_budget;
                                            $actualAmount += (float)$item->amount;
                                            $totalAvailable += (float)$avialable;
                                        ?>
                                            <tr>
                                                <td>{{ $item->economic_code  }}</td>
                                                <td>{{ $item->found_source }}</td>
                                                <td>{{ $item->economic_code }}</td>
                                                <td>{{ $item->project }}</td>
                                                <td>AUJA MUNICIPAL</td>
                                                <td>{{ $item->line }}</td>
                                                <td>{{ number_format($item->current_budget, 2)  }}</td>

                                                <td>0.00</td>
                                                <td>0.00</td>
                                                <td>{{ number_format($item->amount, 2)  }}</td>
                                                <td>{{ number_format($item->amount, 2)  }}</td>
                                                <td>

                                                    {{ number_format($avialable, 2)  }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <tr>
                                                <td colspan="6"><strong>Total</strong></td>
                                                <td>{{ number_format($budgetedAmount, 2) }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ number_format($actualAmount, 2) }}</td>
                                                <td>{{ number_format($actualAmount, 2) }}</td>
                                                <td>{{ number_format($totalAvailable, 2) }}</td>
                                            </tr>
                                        </tr>
                                    </tbody>

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
