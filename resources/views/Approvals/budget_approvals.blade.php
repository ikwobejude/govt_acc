@extends('admin_dashboard')


@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Approvals /</span> Budget</h4>

    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="accordion mt-3" id="accordionExample">
                <div class="card accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                      Search
                    </button>
                  </h2>

                  <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form action="" method="get" class="mt-3">
                            @csrf
                            <div class="fieldset">
                                <h1>Search</h1>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <div class="form-floating">
                                            <select name="budgetType" id="sbudgetType" class="form-control selects" style="width: 100%" onchange="getRevenueType('sbudgetType')">
                                                <option value="">Select option</option>
                                                <option value="2">Personnel</option>
                                                <option value="3">Overhead</option>
                                                <option value="4">Capital</option>
                                            </select>
                                            <label for="floatingInput">Budget Type<span class="required">*</span></label>

                                            @error('budgetType')
                                            <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <span id="seco_noti"></span>
                                        <div class="form-floating">
                                            <select name="economicCode" id="seconomicCode" class="form-control selects" style="width: 100%">
                                                <option value="">Select option</option>

                                            </select>
                                            <label for="floatingInput">Economic Code<span class="required">*</span></label>

                                            @error('economicCode')
                                            <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12 mb-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control " id="project" name="project" placeholder="Received From" value="{{ old('project')}}" />
                                            <label for="floatingInput">Project</label>
                                        </div>
                                    </div>


                                    <div class="col-md-4 col-sm-12 mb-3">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="from" name="from" placeholder="" value="{{ old('dateFrom')}}" />
                                            <label for="floatingInput">From</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 mb-3">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="to" name="to" placeholder="" value="{{ old('dateTo')}}" />
                                            <label for="floatingInput">To</label>
                                        </div>
                                    </div>


                                    <div class="modal-footer" >
                                        <button type="submit" class="btn btn-primary me-2">Search</button>
                                        {{-- <button type="reset" class="btn btn-outline-secondary">Discard</button> --}}
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
          <h5 class="card-header">Budget(s)</h5>
          <div class="card-body">
            <form action="{{ route('multiple.budget.approval') }}" method="post">
                @csrf
                <div class="table-responsive">
                    <table class="table table-stripe">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check form-check-flat mt-0">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" id="checkedAll"
                                                aria-checked="false"><i class="input-helper"></i> All</label>
                                    </div>
                                </th>
                                <th>Action</th>
                                <th></th>
                                <th colspan="2"><u>Economic Code (Line Item)</u></th>
                                <th>Fund Sources </th>
                                <th>Project</th>
                                <th>Current Budget </th>
                                <th>Remaining Balance </th>
                                <th>Change (+/-) </th>
                                <th>Revised Budget</th>
                                <th>Budget Type</th>
                                <th>Created On</th>
                                <th>Created By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($budges as  $key=>$item)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="checkSingle form-check-input"
                                                    id="checkSingle" aria-checked="false" name="itemid[]"
                                                    value="{{ $item->id }}"><i
                                                    class="input-helper"></i></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="dropdown">
                                            Approvals
                                        </button>
                                        <div class="dropdown-menu">
                                            @if ($item->approved == 0 || $item->approved == 3 || $item->approved == 4 && groupId() == 3000)
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="approvalLevel1({{ $item->id }})">
                                                <i class="bx bx bxs-like me-1"></i> Approve
                                            </a>
                                            @endif
                                            @if ($item->approved == 1  && groupId() == 1500)
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="approvalLevel1({{ $item->id }})">
                                                <i class="bx bx bxs-like me-1"></i> Approve {{ $item->approved  }}
                                            </a>
                                            @endif
                                            @if (groupId() == 111111)
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="approvalLevel1({{ $item->id }})">
                                                <i class="bx bx bxs-like me-1"></i> Approve
                                            </a>
                                            @endif


                                            <a class="dropdown-item" href="javascript:void(0);" onclick="disApprove({{ $item->id }})">
                                                <i class="bx bxs-like bx-rotate-180 me-1"></i> Reject
                                            </a>
                                        </div>
                                        </div>
                                    </td>
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
                                    <td>{{ $item->economic_code }}</td>
                                    <td>{{ $item->line }}</td>
                                    <td>{{ $item->found_source }}</td>
                                    <td>{{ $item->project }}</td>
                                    <td>{{ number_format($item->current_budget, 2) }}</td>
                                    <td>{{ number_format($item->current_budget, 2) }}</td>
                                    <td>{{ $item->change }}</td>
                                    <td>{{ number_format($item->current_budget, 2) }}</td>
                                    <td>
                                        @if($item->budget_type == 2)
                                            <span class="badge bg-label-success">Personel</span>
                                        @endif
                                        @if($item->budget_type == 3)
                                            <span class="badge bg-label-primary">Overhead</span>
                                        @endif
                                        @if($item->budget_type == 4)
                                            <span class="badge bg-label-info">Capital</span>
                                        @endif

                                    </td>
                                    <td> {{ date("Y-m-d", strtotime($item->created_at)) }}</td>
                                    <td>{{ $item->name }}</td>

                                </tr>
                            @endforeach

                            <tr>
                               <td colspan="9"><button type="submit" class="btn btn-md btn-primary">Submit</button></td>
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
  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

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
          <h5 class="modal-title" id="modalCenterTitle">Dis approved reasons</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p id="reson">
              Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis
              in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
            </p>

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
    async function approvalLevel1(id) {
        console.log(id)
        // var coverSpin = document.getElementById("cover-spin");
        const confirmed = confirm("Are you sure you want to approve?");
        if(confirmed) {
            // coverSpin.style.display = 'black';
            try {
                const response = await fetch('/approve/budget/approval?id='+id);
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
                console.log(payload)
                const response = await fetch("/approve/budget/disapproval?" + new URLSearchParams(payload).toString())

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
