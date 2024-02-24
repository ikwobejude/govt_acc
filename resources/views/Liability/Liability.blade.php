@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Chart of Account /</span> Liability</h4>

    <div class="row">

      <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">Liability</h5>
          <div class="card-body">
            <form action="" method="get">
                @csrf
                <div class="fieldset">
                    <h1>liability</h1>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="form-floating">
                                <select name="revenue_code" id="revenue_code" class="form-control">
                                    <option value="">Select option</option>
                                    @foreach ($EconomicLines as $item)
                                        <option value="{{ $item->economic_code  }}" {{ old('revenue_code') == $item->economic_code ? 'selected': ''}}>
                                            {{ $item->description." :: ".$item->economic_code  }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="floatingInput">Revenue Line/Economic Code</label>

                                @error('economic_code')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" name="liability" id="liability" value="{{ old('liability')}}" placeholder="Liability" class="form-control" >
                                <label for="floatingInput">Liability</label>
                                <div id="floatingInputHelp" class="form-text"></div>
                                @error('liability')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="form-floating">
                                <select name="type_of_liability" id="type_of_liability" class="form-control">
                                    <option value="">Select option</option>
                                    <option value="Current liabilities">Current liabilities</option>
                                    <option value="Non-current liabilities">Non-current liabilities</option>
                                    <option value="Current liabilities">Contingent liabilities</option>
                                </select>
                                <label for="floatingInput">Types of liabilities</label>
                                <div id="floatingInputHelp" class="form-text"> </div>
                                @error('type_of_liability')
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


                        <div class="col-md-3 col-sm-5">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="from" name="from" placeholder="" />
                                <label for="floatingInput">From</label>
                                <div id="floatingInputHelp" class="form-text"> </div>

                            </div>
                        </div>
                        <div class="col-md-3 col-sm-5">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="to" name="to" placeholder="" />
                                <label for="floatingInput">From</label>
                                <div id="floatingInputHelp" class="form-text"> </div>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-floating">
                                <select name="approvalLevels" id="approvalLevels" class="form-control">
                                    <option value="">Select option</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Reveiewer Approavl</option>
                                    <option value="2">Approved</option>
                                    <option value="3">Rejected</option>
                                </select>
                                <label for="floatingInput">Approvals</label>

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
                            <button type="submit" class="btn btn-primary me-2">Search</button>
                        </div>
                    </div>
                </div>

            </form>

          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card mb-4">

          <div class="row">
                <div class="col-6">
                    <h5 class="card-header">Drafted asset(s)</h5>
                </div>
                <div class="col-6">
                    <div style="text-align: right; padding: 20px">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newRevenue">Add New Asset</button>
                    </div>
                </div>
            </div>
          <div class="card-body">
            <div class="table-reponsive">
                <table class="table table-stripe">
                    <thead>
                        <tr>
                            {{-- <th>S/N</th> --}}
                            <th>Economic Line/Code</th>
                            <th>Name</th>
                            <th>Liability Type</th>
                            <th>Authorization Ref</th>
                            <th>Date </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($liabilities as $item)
                        <tr>
                            <td>{{ $item->economic_name."/".
                                $item->economic_code }}</td>
                            <td>{{ $item->liability }}</td>
                            <td>{{ $item->type_of_liability }}</td>
                            <td>{{ $item->authorize_ref }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <div class="dropdown">
                                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"data-bs-target="#modalCenter">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
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


   <!-- Modal -->
   <div class="modal fade" id="newRevenue" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Add New Liability</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('post.liability') }}" method="post">
                @csrf
                <div class="fieldset">
                    <h1>liability</h1>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="form-floating">
                                <select name="revenue_code" id="revenue_code" class="form-control">
                                    <option value="">Select option</option>
                                    @foreach ($EconomicLines as $item)
                                        <option value="{{ $item->description.",".$item->economic_code.",".$item->type  }}" {{ old('revenue_code') == $item->economic_code ? 'selected': ''}}>
                                            {{ $item->description." :: ".$item->economic_code  }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="floatingInput">Revenue Line/Economic Code</label>

                                @error('economic_code')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" name="liability" id="liability" value="{{ old('liability')}}" placeholder="Liability" class="form-control" >
                                <label for="floatingInput">Liability</label>
                                <div id="floatingInputHelp" class="form-text"></div>
                                @error('liability')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="form-floating">
                                <select name="type_of_liability" id="type_of_liability" class="form-control">
                                    <option value="">Select option</option>
                                    <option value="Current liabilities">Current liabilities</option>
                                    <option value="Non-current liabilities">Non-current liabilities</option>
                                    <option value="Current liabilities">Contingent liabilities</option>
                                </select>
                                <label for="floatingInput">Types of liabilities</label>
                                <div id="floatingInputHelp" class="form-text"> </div>
                                @error('type_of_liability')
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


                        <div class="col-md-4 col-sm-5">
                            <div class="form-floating">
                                <input type="text" class="form-control  @error('amount') is-invalid @enderror" value="{{ old('amount')}}" id="amount" name="amount" placeholder="Opening value" />
                                <label for="floatingInput">Amount</label>
                                <div id="floatingInputHelp" class="form-text"> </div>
                                @error('amount')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="description" value="{{ old('description')}}" name="description" placeholder="Description"  />
                                <label for="floatingInput">Description</label>
                                <div id="floatingInputHelp" class="form-text"> </div>
                                @error('description')
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

  @endsection

  <script>
    var i = 1;



function deleteemprow(h) {
  console.log(h);
  $(`#row${h}`).remove();
}
</script>
  </script>
