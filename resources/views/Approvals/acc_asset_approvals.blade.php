@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Asset approvals</h4>

    <div class="row">

      <div class="col-md-12">
        <div class="card mb-4">
          {{-- <h5 class="card-header">Asset(s)</h5> --}}
          <div class="card-body">
            <form action="{{ route('view.approve.asset') }}" method="get">
                @csrf
                <div class="fieldset">
                    <h1>Search</h1>
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="form-floating">
                                <select name="revenue_code" id="revenue_code" class="form-control">
                                    <option value="">Select option</option>
                                    @foreach ($revenue_lines as $item)
                                        <option value="{{ $item->economic_code }}" {{ old('revenue_code') == $item->economic_code ? 'selected': ''}}>
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
                        <div class="col-md-3 col-sm-6">
                            <div class="form-floating mb-3">
                                <select name="asset_type" id="asset_type" class="form-control @error('asset_type') is-invalid @enderror">
                                    <option value="">-- Select Option --</option>
                                    @foreach ($types as $item)
                                        <option value="{{ $item->id}}" {{ old('asset_type') == $item->id ? 'selected': ''}}>
                                            {{ $item->assest_type}}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="floatingInput">ASSET TYPE</label>
                                <div id="floatingInputHelp" class="form-text"></div>
                                @error('asset_type')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="form-floating mb-3">
                                <select name="asset_category" id="asset_category" class="form-control @error('expenditure_category') is-invalid @enderror">
                                    <option value="">-- Select Option --</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->assest_category_id}}" {{ old('asset_category') == $item->assest_category_id ? 'selected': ''}}>
                                            {{ $item->assest_category}}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="floatingInput">ASSET CATEGORIES</label>
                                <div id="floatingInputHelp" class="form-text"></div>
                                @error('expenditure_category')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="form-floating mb-3">
                                <select name="asset_size" id="asset_size" class="form-control @error('asset_size') is-invalid @enderror">
                                    <option value="">-- Select Option --</option>
                                    @foreach ($sizes as $item)
                                        <option value="{{ $item->id}}" {{ old('asset_size') == $item->id ? 'selected': ''}}>
                                            {{ $item->assest_size}}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="floatingInput">Asset size</label>
                                <div id="floatingInputHelp" class="form-text"></div>
                                @error('asset_size')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('authority_document_ref_no') is-invalid @enderror" id="floatingInput" name="authority_document_ref_no" placeholder="Authority Document Ref. No" value="{{ old('authority_document_ref_no')}}" />
                                <label for="floatingInput">Authority Document Ref. No</label>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="date_purchased" name="date_purchased" placeholder="Date of purchase" value="{{ old('date_purchased')}}" />
                                <label for="floatingInput">Date of purchase</label>
                                <div id="floatingInputHelp" class="form-text"> </div>
                                @error('date_purchased')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="from" name="from" placeholder="From" value="{{ old('from')}}" />
                                <label for="floatingInput">from</label>
                                <div id="floatingInputHelp" class="form-text"> </div>
                                @error('date_purchased')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="to" name="to" placeholder="To" value="{{ old('to')}}" />
                                <label for="floatingInput">To</label>
                                <div id="floatingInputHelp" class="form-text"> </div>
                                @error('date_purchased')
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

      <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">Asset(s)</h5>
          <div class="card-body">
            <div class="table-reponsive">
                <table class="table table-stripe">
                    <thead>
                        <tr>
                            {{-- <th>S/N</th> --}}
                            <th>Economic Line/Code</th>
                            <th>Name</th>
                            <th>Asset Type</th>
                            <th>Asset Category</th>
                            <th>Asset Size</th>
                            <th>Opening Value</th>
                            <th>Date </th>
                            <th>Status </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assets as $item)
                        <tr>
                            <td>{{ $item->asset_rev_name." ".
                                $item->asset_rev }}</td>
                            <td>{{ $item->assest_name }}</td>
                            <td>{{ $item->assest_type }}</td>
                            <td>{{ $item->assest_category }}</td>
                            <td>{{ $item->assest_size }}</td>
                            <td>{{ $item->opening_value }}</td>
                            <td>{{ date("Y-m-d", strtotime($item->date_purchased)) }}</td>
                            <td>

                                @if($item->approved == 0)
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
                                      {{-- <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"data-bs-target="#modalCenter">
                                          <i class="bx bx-edit-alt me-1"></i> Approve
                                      </a> --}}
                                      <a class="dropdown-item" href="javascript:void(0);" onclick="approveAsset({{ $item->assest_id }})">
                                          <i class="bx bx bxs-like me-1"></i> Approve
                                      </a>
                                      <a class="dropdown-item" href="javascript:void(0);" onclick="disApprove({{ $item->assest_id }})">
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
    var i = 1;



    async function approveAsset(id) {
        console.log(id)
        // var coverSpin = document.getElementById("cover-spin");
        const confirmed = confirm("Are you sure you want to approve?");
        if(confirmed) {
            // coverSpin.style.display = 'black';
            try {
                const response = await fetch('/approve/asset/approval?id='+id);
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
                // console.log("/approve/expenditure/disapproval?" + new URLSearchParams(payload).toString())
                const response = await fetch("/approve/asset/disapproval?" + new URLSearchParams(payload).toString())

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
