@extends('admin_dashboard')


@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Chart of Account /</span> Revenue</h4>

    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">Revenue(s)</h5>
          <div class="card-body">
            <form action="{{ route('post.revenue') }}" method="post">
                @csrf
                <div class="fieldset">
                    <h1>Revenue</h1>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select name="revenue_code" id="revenue_code" class="form-control">
                                    <option value="">Select option</option>
                                    @foreach ($revenue_lines as $item)
                                        <option value="{{ $item->description.",".$item->economic_code.",".$item->type  }}" {{ old('revenue_code') == $item->description ? 'selected': ''}}>
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
                                <input type="text" class="form-control @error('received_from') is-invalid @enderror" id="floatingInput" name="received_from" placeholder="Received From" value="{{ old('received_from')}}" />
                                <label for="floatingInput">Received From</label>

                                @error('received_from')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('description') is-invalid @enderror" id="floatingInput" name="description" placeholder="Description/Details of Receipt" value="{{ old('description')}}" />
                                <label for="floatingInput">Description</label>

                                @error('description')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('revenue_amount') is-invalid @enderror" id="floatingInput" name="revenue_amount" placeholder="Amount Recieved" value="{{ old('revenue_amount')}}" />
                                <label for="floatingInput">Amount Received</label>

                                @error('revenue_amount')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="date" class="form-control @error('settlement_date') is-invalid @enderror" id="floatingInput" name="settlement_date" placeholder="" value="{{ old('settlement_date')}}" />
                                <label for="floatingInput">Date</label>

                                @error('settlement_date')
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

                        <div class="col-md-2">
                            <div class="form-check form-switch mt-3 mb-3">
                                <input class="form-check-input" type="checkbox" name="rrr_status" class="checkSingle" id="checkSingle" onclick="chk()"/>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Has RRR </label>
                            </div>
                        </div>
                        <div class="col-md-6" id="rrr_input_field">

                        </div>

                    </div>



                    <div class="row">
                        <div class="col-2" style="text-align: right">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </div>
                        <div class="col-10">.</div>

                    </div>
                </div>

            </form>

          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">Revenue(s)</h5>
          <div class="card-body">
                <table class="table table-stripe">
                    <thead>
                        <tr>
                            <th>Revenue Line</th>
                            <th>Received From </th>
                            <th>Description </th>
                            <th>Authority Document Ref. No </th>
                            <th>Amount </th>
                            <th>Date </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($revenues as  $key=>$item)
                            <tr>
                                <td>{{ $item->revenue_line }}</td>
                                <td>{{ $item->received_from }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->authority_document_ref_no }}</td>
                                <td>{{ number_format($item->revenue_amount, 2)  }}</td>
                                <td>{{ date("Y-m-d", strtotime($item->settlement_date)) }}</td>
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



  <script>


    function chk() {
        const cb = document.querySelector('#checkSingle');
        // console.log(cb.checked); // false
        if(cb.checked == true) {
            let html =`
                <div class="form-floating mt-3 mb-3" >
                    <input type="text" class="form-control" id="floatingInput" name="rrr" placeholder="" value="{{ old('rrr')}}" />
                    <label for="floatingInput">RRR</label>
                </div>
                `;

            document.getElementById('rrr_input_field').innerHTML = html;
        } else {
            document.getElementById('rrr_input_field').innerHTML = "";
        }
    }


 </script>
  @endsection


