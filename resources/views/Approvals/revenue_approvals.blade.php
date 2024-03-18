@extends('admin_dashboard')


@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Approvals /</span> Revenue</h4>

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
          <h5 class="card-header">Revenue(s)</h5>
          <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-stripe">
                        <thead>
                            <tr>
                                <th>Revenue Line</th>
                                <th>Received From </th>
                                <th>Description </th>
                                <th>Authority Document Ref. No </th>
                                <th>Amount </th>
                                <th>Date </th>
                                <th>Approvals Status </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($revenue as  $key=>$item)
                                <tr>
                                    <td>{{ $item->revenue_line }}</td>
                                    <td>{{ $item->received_from }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->authority_document_ref_no }}</td>
                                    <td>{{ number_format($item->revenue_amount, 2)  }}</td>
                                    <td>{{ date("Y-m-d", strtotime($item->settlement_date)) }}</td>
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
                                    <td>
                                        <div class="dropdown">
                                          <button type="button" class="btn btn-outline-primary" data-bs-toggle="dropdown">
                                            Approvals
                                          </button>
                                          <div class="dropdown-menu">
                                            @if ($item->approved == 0 || $item->approved == 3 || $item->approved == 4 && groupId() == 3000)
                                                <a class="dropdown-item" href="javascript:void(0);" onclick="approvalLevel1({{ $item->revenue_id }})">
                                                    <i class="bx bx bxs-like me-1"></i> Approve
                                                </a>
                                            @endif
                                            @if ($item->approved == 1  && groupId() == 1500)
                                                <a class="dropdown-item" href="javascript:void(0);" onclick="approvalLevel1({{ $item->revenue_id }})">
                                                    <i class="bx bx bxs-like me-1"></i> Approve
                                                </a>
                                            @endif
                                            @if (groupId() == 111111)
                                                <a class="dropdown-item" href="javascript:void(0);" onclick="approvalLevel1({{ $item->revenue_id }})">
                                                    <i class="bx bx bxs-like me-1"></i> Approve
                                                </a>
                                            @endif
                                                <a class="dropdown-item" href="javascript:void(0);" onclick="disApprove({{ $item->revenue_id }})">
                                                    <i class="bx bxs-like bx-rotate-180 me-1"></i> Reject
                                                </a>

                                          </div>
                                        </div>
                                    </td>
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
                const response = await fetch('/approve/revenue/approval?id='+id);
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
                const response = await fetch("/approve/revenue/disapproval?" + new URLSearchParams(payload).toString())

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
</script>
