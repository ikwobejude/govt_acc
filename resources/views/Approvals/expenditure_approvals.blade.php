@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Expenditure Pay Register</h4>

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
                    <form action="{{ route('view.approve.expenditure') }}" method="get" class="mt-3">
                        @csrf
                        <div class="fieldset">
                            <h1>Search</h1>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select name="batch_type" id="batch_type" class="form-control @error('batch_type') is-invalid @enderror selects" style="width: 100%">
                                            <option value="">-- Select Batch Type --</option>
                                            @foreach($batchName as $batch)
                                                <option value="{{ $batch->name }}">{{ $batch->name }}</option>
                                            @endforeach

                                            {{-- <option value="Vendor">Vendor</option> --}}
                                        </select>
                                        {{-- <label for="floatingInput">Batch Type</label> --}}
                                        <div id="floatingInputHelp" class="form-text"></div>
                                        @error('batch_type')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('authority_document_ref_no') is-invalid @enderror" id="floatingInput" name="authority_document_ref_no" placeholder="Authority Document Ref. No" value="{{ old('authority_document_ref_no')}}" />
                                        <label for="floatingInput">Authority Document Ref. No</label>

                                        @error('authority_document_ref_no')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-4 col-sm-6">
                                    <div class="form-floating mb-3">
                                        <select name="expenditure_type" id="selects1" style="width: 100%" class="form-control @error('batch_type') is-invalid @enderror">
                                            <option value="">SELECT EXPENDITURE TYPE</option>
                                            @foreach ($expenditureType as $Etype)
                                            <option value="{{ $Etype->economic_code }}" {{ old('expenditure_type') == $Etype->description ? 'selected': ''}}>
                                                {{ $Etype->description  }}
                                            </option>
                                            @endforeach
                                        </select>
                                        {{-- <label for="floatingInput"></label> --}}
                                        <div id="floatingInputHelp" class="form-text"></div>
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
                                <div class="col">
                                    {{-- <button type="button" class="btn btn-outline-secondary" onclick="add()">Add</button> --}}
                                </div>
                                <div class="col" style="text-align: right">
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
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
          <h5 class="card-header">Expenditure Pay Register</h5>
          <div class="card-body">
            <form action="{{ route('multiple.expenditure.approval') }}" method="post">
                @csrf
                <div class="table-reponsive">
                    <table class="table table-stripe">
                        <thead>
                            <tr>
                                {{-- <th>S/N</th> --}}
                                <th>
                                    <div class="form-check form-check-flat mt-0">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" id="checkedAll"
                                                aria-checked="false"><i class="input-helper"></i> All</label>
                                    </div>
                                </th>
                                <th>Action</th>
                                <th>Batch Name</th>
                                <th>Expenditure Type</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Date </th>
                                <th>Approval Status </th>
                                <th>Created by </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ExpenditureRegister as  $key=>$item)
                                <tr>
                                    {{-- <td>{{ $key + 1}}</td> --}}
                                    <td>
                                        <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="checkSingle form-check-input"
                                                    id="checkSingle" aria-checked="false" name="itemid[]"
                                                    value="{{ $item->idexpenditure_payregister }}"><i
                                                    class="input-helper"></i></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="dropdown">
                                            Approvals
                                        </button>
                                        <div class="dropdown-menu">
                                            @if ($item->approved == 0 || $item->approved == 3 && groupId() == 3000)
                                                <a class="dropdown-item" href="javascript:void(0);" onclick="approveExpenditure({{ $item->idexpenditure_payregister }})">
                                                    <i class="bx bx bxs-like me-1"></i> Approve
                                                </a>
                                            @endif
                                            @if ($item->approved == 1  && groupId() == 1500)
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="approveExpenditure({{ $item->idexpenditure_payregister }})">
                                                <i class="bx bx bxs-like me-1"></i> Approve
                                            </a>
                                            @endif
                                            @if (groupId() == 111111)
                                                <a class="dropdown-item" href="javascript:void(0);" onclick="approveExpenditure({{ $item->idexpenditure_payregister }})">
                                                    <i class="bx bx bxs-like me-1"></i> Approve
                                                </a>
                                            @endif
                                            {{-- <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"data-bs-target="#modalCenter">
                                                <i class="bx bx-edit-alt me-1"></i> Approve
                                            </a> --}}
                                            {{-- @if ($item->approved == 1) --}}
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="disApprove({{ $item->idexpenditure_payregister }})">
                                                <i class="bx bxs-like bx-rotate-180 me-1"></i> Reject
                                            </a>
                                            {{-- @ --}}
                                        </div>
                                        </div>
                                    </td>
                                    <td> {{ $item->batch_name }} </td>
                                    <td> {{ $item->expenditure_name }} </td>
                                    <td> {{ $item->name }} </td>
                                    <td> {{ $item->amount }}</td>
                                    <td> {{ $item->narration }} </td>
                                    <td> {{ date("Y-m-d", strtotime($item->created_at)) }}</td>
                                    <td>

                                        @if($item->approved == 0 || $item->approved == 4)
                                            <span class="badge bg-label-warning">Pending</span>
                                        @endif
                                        @if($item->approved == 1)
                                            <span class="badge bg-label-primary">Await Final Approval</span>
                                        @endif
                                        @if($item->approved == 2)
                                            <span class="badge bg-label-success">Approved</span>
                                        @endif
                                        @if($item->approved == 3)
                                        <button type="button" class="btn btn-sm btn-danger" onclick="viewDisapproveR('{{ $item->reason }}')">
                                            Rejected
                                            <span class="badge bg-white text-primary ms-1">View why</span>
                                            </button>
                                        @endif

                                    </td>
                                    <td> {{ $item->user_name }} </td>

                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="9"><button type="submit"
                                        class="btn btn-sm btn-primary">Submit</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>

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

  <div class="modal fade" id="reason" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Reason for rejection rejected</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p id="reson"> </p>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Close
            </button>
            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
          </div>
      </div>
    </div>
  </div>

  @endsection

  <script>

    async function approveExpenditure(id) {
        console.log(id)
        // var coverSpin = document.getElementById("cover-spin");
        const confirmed = confirm("Are you sure you want to approve?");
        if(confirmed) {
            // coverSpin.style.display = 'black';
            try {
                const response = await fetch('/approve/expenditure/approval?id='+id);
                const res = await response.json();

                // console.log(res);

                if(res.status == true) {
                    toastr.success(res.message);
                    location.reload()
                } else {
                    toastr.error(res.message);
                }
            } catch (error) {
                console.log({error})
                toastr.error(error.message);
            }

        } else {
        }
    }

    async function disApprove(id) {
        const reason = prompt("Please enter your reason:");
        // console.log(reason)
        if(reason) {
            try {
                const payload = {
                    "_token":  @json(csrf_token()),
                    id,
                    reason
                }
                console.log("/approve/expenditure/disapproval?" + new URLSearchParams(payload).toString())
                const response = await fetch("/approve/expenditure/disapproval?" + new URLSearchParams(payload).toString())

                const res = await response.json();
                if(res.status == true) {
                    toastr.success(res.message);
                    location.reload()
                } else {
                    toastr.error(res.message);
                }
            } catch (error) {
                console.log(error)
                toastr.error(error.message);
            }
        } else {

        }

    }

    function viewDisapproveR(str) {
        document.getElementById('reson').textContent = str;
        console.log(str)
        new bootstrap.Modal(document.querySelector("#reason")).show();
    }

    window.addEventListener('load', function() {
        console.log("Helo")
        $("#checkedAll").change(function() {
            if (this.checked) {
                $(".checkSingle").each(function() {
                    this.checked = true;
                });
            } else {
                $(".checkSingle").each(function() {
                    this.checked = false;
                });
            }
        });

        $(".checkSingle").click(function() {
            if ($(this).is(":checked")) {
                var isAllChecked = 0;
                $(".checkSingle").each(function() {

                    if (!this.checked) isAllChecked = 1;
                });

                if (isAllChecked == 0) {
                    $("#checkedAll").prop("checked", true);
                }

            } else {
                $("#checkedAll").prop("checked", false);
            }
        });
    });
</script>
