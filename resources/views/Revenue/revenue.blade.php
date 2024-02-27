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
                                                    <select name="revenuecode" id="revenuecode" class="form-control">
                                                        <option value="">Select option</option>
                                                        @foreach ($revenue_lines as $item)
                                                            <option value="{{ $item->economic_code }}"
                                                                {{ old('revenue_code') == $item->economic_code ? 'selected' : '' }}>
                                                                {{ $item->description . ' :: ' . $item->economic_code }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="floatingInput">Revenue Line/Economic Code</label>
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
                                    data-bs-target="#newRevenue">Add new revenue</button>
                            </div>
                        </div>
                    </div>


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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($revenues as $key => $item)
                                        <tr>
                                            <td>{{ $item->revenue_line }}</td>
                                            <td>{{ $item->received_from }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->authority_document_ref_no }}</td>
                                            <td>{{ number_format($item->revenue_amount, 2) }}</td>
                                            <td>{{ date('Y-m-d', strtotime($item->settlement_date)) }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"data-bs-target="#modalCenter"
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
                                                        <a class="dropdown-item" href="{{ route('delete_revenue', $item->revenue_id) }}" onclick="confirm('Are you sure you want to delate?')"><i
                                                                class="bx bx-trash me-1"></i> Delete</a>
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
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
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
                                        <select name="revenue_code" id="erevenue_code" class="form-control">
                                            <option value="">Select option</option>
                                            @foreach ($revenue_lines as $item)
                                                <option
                                                    value="{{ $item->description . ',' . $item->economic_code . ',' . $item->type }}"
                                                    {{ old('revenue_code') == $item->description ? 'selected' : '' }}>
                                                    {{ $item->description . ' :: ' . $item->economic_code }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="floatingInput">Revenue Line/Economic Code</label>

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
    <div class="modal fade" id="newRevenue" tabindex="-1" aria-hidden="true">
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
                                    <div class="form-floating">
                                        <select name="revenue_code" id="revenue_code" class="form-control">
                                            <option value="">Select option</option>
                                            @foreach ($revenue_lines as $item)
                                                <option
                                                    value="{{ $item->description . ',' . $item->economic_code . ',' . $item->type }}"
                                                    {{ old('revenue_code') == $item->description ? 'selected' : '' }}>
                                                    {{ $item->description . ' :: ' . $item->economic_code }}
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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

                                <div class="col-md-2">
                                    <div class="form-check form-switch mt-3 mb-3">
                                        <input class="form-check-input" type="checkbox" name="rrr_status"
                                            class="checkSingle" id="checkSingle" onclick="chk('checkSingle', 'rrr_input_field')" />
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








    <script>
        function chk(ck, id) {
            const cb = document.querySelector(`#${ck}`);
            // console.log(cb.checked); // false
            if (cb.checked == true) {
                let html = `
                <div class="form-floating mt-3 mb-3" >
                    <input type="text" class="form-control" id="floatingInput" name="rrr" placeholder="" value="{{ old('rrr') }}" />
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
    </script>
@endsection
