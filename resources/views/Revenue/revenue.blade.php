@extends('admin_dashboard')


@section('admin')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Chart of Account /</span> Revenue</h4>

        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="accordion mt-3" id="accordionExample">
                    <div class="card accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
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
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control " id="doc_ref_no"
                                                        name="doc_ref_no" placeholder="Authority Document Ref. No"
                                                        value="{{ old('authority_document_ref_no') }}" />
                                                    <label for="floatingInput">Authority Document Ref. No</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <select name="revenuecode" id="revenuecode" style="width: 100%" class="form-control selects">
                                                        <option value="">Select Revenue Line/Economic Code</option>
                                                        @foreach ($revenue_lines as $item)
                                                            <option value="{{ $item->economic_code }}"
                                                                {{ old('revenue_code') == $item->economic_code ? 'selected' : '' }}>
                                                                {{ $item->description . ' :: ' . $item->economic_code }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <label for="floatingInput">Revenue Line/Economic Code</label> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control " id="floatingInput"
                                                        name="received_from" placeholder="Received From"
                                                        value="{{ old('received_from') }}" />
                                                    <label for="floatingInput">Received From</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">

                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="date" class="form-control" id="dateFrom"
                                                        name="dateFrom" placeholder="" value="{{ old('dateFrom') }}" />
                                                    <label for="floatingInput">From</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="date" class="form-control" id="dateTo" name="dateTo"
                                                        placeholder="" value="{{ old('dateTo') }}" />
                                                    <label for="floatingInput">To</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
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



                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput"
                                                        name="rrr" placeholder="" value="{{ old('rrr') }}" />
                                                    <label for="floatingInput">RRR</label>
                                                </div>
                                            </div>
                                            <div class="col-6" style="text-align: right">
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
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-header">Revenue(s)</h5>
                        </div>
                        <div class="col-6">
                            <div style="text-align: right; padding: 20px">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addModal">Add new revenue</button>
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="{{ route('confirm_submission') }}" method="post">
                                @csrf
                                <table class="table table-stripe" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check form-check-flat mt-0">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" id="checkedAll"
                                                            aria-checked="false"><i class="input-helper"></i> All</label>
                                                </div>
                                            </th>
                                            <th>Revenue Line</th>
                                            <th>Received From </th>
                                            <th>Description </th>
                                            <th>RRR </th>
                                            <th>Authority Document Ref. No </th>
                                            <th>Amount </th>
                                            <th>Approvals Status </th>
                                            <th>Created By </th>
                                            <th>Transaction Date </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($revenues as $key => $item)
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-flat mt-0">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="checkSingle form-check-input"
                                                                id="checkSingle" aria-checked="false" name="itemid[]"
                                                                value="{{ $item->revenue_id }}"><i
                                                                class="input-helper"></i></label>
                                                    </div>
                                                </td>
                                                <td>{{ $item->revenue_line }}</td>
                                                <td>{{ $item->received_from }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>{{ $item->rrr }}</td>
                                                <td>{{ $item->authority_document_ref_no }}</td>

                                                <td>{{ number_format($item->revenue_amount, 2) }}</td>
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
                                                <td>{{ $item->name }}</td>
                                                <td>{{ date('Y-m-d', strtotime($item->settlement_date)) }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"data-bs-target="#updateModal"
                                                            onclick="update(
                                                                '{{ $item->revenue_id}}',
                                                                '{{ $item->revenue_line . ',' . $item->revenue_code . ',' . $item->asset_name }}',
                                                                '{{ $item->received_from }}',
                                                                '{{ $item->description }}',
                                                                '{{ $item->authority_document_ref_no }}',
                                                                '{{ $item->revenue_amount }}',
                                                                '{{  \Carbon\Carbon::parse($item->settlement_date)->format('Y-m-d') }}',
                                                                '{{ $item->rrr_status }}',
                                                                '{{ $item->rrr }}',
                                                            )">
                                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item" href="{{ route('delete_revenue', $item->revenue_id) }}" onclick="return confirm('Are you sure you want to delate?')"><i
                                                                    class="bx bx-trash me-1"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="9"><button type="submit" class="btn btn-sm btn-primary">Submit</button></td>
                                         </tr>
                                    </tbody>
                                </table>
                            </form>

                        </div>

                    </div>
                </div>
            </div>






        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Update Revenue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('put.revenue') }}" method="post">
                    @method('PUT')
                    <div class="modal-body">

                        @csrf
                        <div class="fieldset">
                            <h1>Revenue</h1>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="hidden" name="id" id="id">
                                        <select name="revenue_code" id="erevenue_code" style="width: 100%" class="form-control selectu">
                                            <option value="">Select Revenue Line/Economic Code</option>
                                            @foreach ($revenue_lines as $item)
                                                <option
                                                    value="{{ $item->description . ',' . $item->economic_code . ',' . $item->type }}"
                                                    {{ old('revenue_code') == $item->description ? 'selected' : '' }}>
                                                    {{ $item->description . ' :: ' . $item->economic_code }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- <label for="floatingInput">Revenue Line/Economic Code</label> --}}

                                        @error('revenue_code')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('received_from') is-invalid @enderror"
                                            id="ereceived_from" name="received_from" placeholder="Received From"
                                            value="{{ old('received_from') }}" />
                                        <label for="floatingInput">Received From</label>

                                        @error('received_from')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('description') is-invalid @enderror"
                                            id="edescription" name="description"
                                            placeholder="Description/Details of Receipt"
                                            value="{{ old('description') }}" />
                                        <label for="floatingInput">Description</label>

                                        @error('description')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 ">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('revenue_amount') is-invalid @enderror"
                                            id="erevenue_amount" name="revenue_amount" placeholder="Amount Recieved"
                                            value="{{ old('revenue_amount') }}" />
                                        <label for="floatingInput">Amount Received</label>

                                        @error('revenue_amount')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating  mb-3">
                                        <input type="date"
                                            class="form-control @error('settlement_date') is-invalid @enderror"
                                            id="esettlement_date" name="settlement_date" placeholder=""
                                            value="{{ old('settlement_date') }}" />
                                        <label for="floatingInput">Date</label>

                                        @error('settlement_date')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating  mb-3">
                                        <input type="text"
                                            class="form-control @error('authority_document_ref_no') is-invalid @enderror"
                                            id="eauthority_document_ref_no" name="authority_document_ref_no"
                                            placeholder="Authority Document Ref. No"
                                            value="{{ old('authority_document_ref_no') }}" />
                                        <label for="floatingInput">Authority Document Ref. No</label>

                                        @error('authority_document_ref_no')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-check form-switch mt-3 mb-3">
                                        <input class="form-check-input" type="checkbox" name="rrr_status"
                                            class="checkSingle" id="echeckSingle" onclick="chk('echeckSingle', 'errr_input_field')" />
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Has RRR </label>
                                    </div>
                                </div>
                                <div class="col-md-6" id="errr_input_field">

                                </div>

                            </div>




                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Add New Revenue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('post.revenue') }}" method="post">
                        @csrf
                        <div class="fieldset">
                            <h1>Revenue</h1>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating mt-2 mb-3">
                                        <select name="revenue_code" id="revenue_code" style="width: 100%" class="form-control select">
                                            <option value="">Select Revenue Line/Economic Code</option>
                                            @foreach ($revenue_lines as $item)
                                                <option
                                                    value="{{ $item->description . ',' . $item->economic_code . ',' . $item->type }}"
                                                    {{ old('revenue_code') == $item->description ? 'selected' : '' }}>
                                                    {{ $item->description . ' :: ' . $item->economic_code }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- <label for="floatingInput">Revenue Line/Economic Code</label> --}}

                                        @error('revenue_code')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-floating">
                                        <input type="text"
                                            class="form-control @error('received_from') is-invalid @enderror"
                                            id="floatingInput" name="received_from" placeholder="Received From"
                                            value="{{ old('received_from') }}" />
                                        <label for="floatingInput">Received From</label>

                                        @error('received_from')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-floating">
                                        <input type="text"
                                            class="form-control @error('description') is-invalid @enderror"
                                            id="floatingInput" name="description"
                                            placeholder="Description/Details of Receipt"
                                            value="{{ old('description') }}" />
                                        <label for="floatingInput">Description</label>

                                        @error('description')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <div class="form-floating">
                                        <input type="text"
                                            class="form-control @error('revenue_amount') is-invalid @enderror"
                                            id="floatingInput" name="revenue_amount" placeholder="Amount Recieved"
                                            value="{{ old('revenue_amount') }}" />
                                        <label for="floatingInput">Amount Received</label>

                                        @error('revenue_amount')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-floating">
                                        <input type="date"
                                            class="form-control @error('settlement_date') is-invalid @enderror"
                                            id="floatingInput" name="settlement_date" placeholder=""
                                            value="{{ old('settlement_date') }}" />
                                        <label for="floatingInput">Date</label>

                                        @error('settlement_date')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
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

                                <div class="col-md-2 ">
                                    <div class="form-check form-switch mt-3 mb-3">
                                        <input class="form-check-input" type="checkbox" name="rrr_status"
                                            class="checkSingle1" id="checkSingle1" onclick="chk('checkSingle1', 'rrr_input_field')" />
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Has RRR </label>
                                    </div>
                                </div>
                                <div class="col-md-6" id="rrr_input_field">

                                </div>

                            </div>




                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>

                    </form>
                </div>

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









    <script>
// $('#myTable').DataTable( {
//     autoFill: true
// } );

        function chk(ck, id) {
            console.log(ck, id)
            const cb = document.querySelector(`#${ck}`);
            // console.log(cb.checked); // false
            if (cb.checked == true) {
                let html = `
                <div class="form-floating mt-3 mb-3" >
                    <input type="text" class="form-control" maxlength="12" id="floatingInput" name="rrr" placeholder="" value="{{ old('rrr') }}" />
                    <label for="floatingInput">RRR</label>
                </div>
                `;

                document.getElementById(`${id}`).innerHTML = html;
            } else {
                document.getElementById(`${id}`).innerHTML = "";
            }
        }


        function update(id, revenue_line, received_from, description, authority_document_ref_no, revenue_amount, settlement_date, rrr_status, rrr) {
            // console.log(revenue_line, received_from, description, authority_document_ref_no, revenue_amount, settlement_date)
            $('#erevenue_code').val(revenue_line);
            $('#ereceived_from').val(received_from);
            $('#edescription').val(description);
            $('#erevenue_amount').val(revenue_amount);
            $('#esettlement_date').val(settlement_date);
            $('#eauthority_document_ref_no').val(authority_document_ref_no);
            $('#id').val(id)
            // document.querySelector(`#echeckSingle:${rrr_status == 1 ? 'checked': ''  }`) !== null
            if(rrr_status == 1) {
                $('#echeckSingle')[0].checked
                let html = `
                <div class="form-floating mt-3 mb-3" >
                    <input type="text" class="form-control" id="floatingInput" name="rrr" placeholder="" value="${rrr_status}" />
                    <label for="floatingInput">RRR</label>
                </div>
                `;

                document.getElementById(`${id}`).innerHTML = html;
            }

        }

        function viewDisapproveR(str) {
            document.getElementById('reson').textContent = str;
            console.log(str)
            new bootstrap.Modal(document.querySelector("#reason")).show();
        }

        window.addEventListener('load', function() {
            // console.log("Helo")
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
@endsection
