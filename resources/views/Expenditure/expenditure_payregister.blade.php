@extends('admin_dashboard')
@section('admin')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Expenditure Pay Register</h4>

        <div class="row">

            <div class="col-md-12">
                <div class="accordion mb-4" id="accordionExample">
                    <div class="card accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                                Search
                            </button>
                        </h2>

                        <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <form action="{{ route('get.expenditure') }}" method="get" class="mt-3">
                                    @csrf
                                    <div class="fieldset">
                                        <h1>Search Expenditure</h1>
                                        <div class="row">
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="form-floating ">
                                                    <select name="expenditureType" id="expenditureType"
                                                        class="form-control selects" style="width: 100%">
                                                        <option value="">-- Select Option --</option>
                                                        @foreach ($expenditureType as $Etype)
                                                            <option value="{{ $Etype->economic_code }}"
                                                                {{ old('expenditure_type') == $Etype->economic_code ? 'selected' : '' }}>
                                                                {{ $Etype->description . '::' . $Etype->economic_code }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="floatingInput">EXPENDITURE TYPE</label>
                                                    <div id="floatingInputHelp" class="form-text"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating mb-3">
                                                    <select name="batchType" id="batchType" class="form-control">
                                                        <option value="">-- Select Option --</option>
                                                        @foreach ($batchName as $batch)
                                                            <option value="{{ $batch->name }}">{{ $batch->name }}</option>
                                                        @endforeach

                                                        {{-- <option value="Vendor">Vendor</option> --}}
                                                    </select>
                                                    <label for="floatingInput">Batch Type</label>
                                                    <div id="floatingInputHelp" class="form-text"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="dateFrom" id="dateFrom"
                                                        class="form-control">
                                                    <label for="floatingInput">From</label>
                                                    <div id="floatingInputHelp" class="form-text"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="dateTo" id="dateTo"
                                                        class="form-control">
                                                    <label for="floatingInput">To</label>
                                                    <div id="floatingInputHelp" class="form-text"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingInput"
                                                        name="document_ref_no" placeholder="Authority Document Ref. No"
                                                        value="{{ old('document_ref_no') }}" />
                                                    <label for="floatingInput">Authority Document Ref. No</label>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingInput"
                                                        name="name" placeholder="Paid to" value="" />
                                                    <label for="floatingInput">Paid to</label>
                                                    <div id="floatingInputHelp" class="form-text"> </div>
                                                </div>
                                            </div>


                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingInput"
                                                        name="description" placeholder="description" />
                                                    <label for="floatingInput">Narration/Description of Payment</label>
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
                </div>

            </div>

            <div class="col-md-12">
                <div class="card mb-4">
                    {{-- <h5 class="card-header"></h5> --}}
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-header">Expenditure Pay Register</h5>
                        </div>
                        <div class="col-6">
                            <div style="text-align: right; padding: 20px">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addModal">Add New Expenditure</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="{{ route('finalize_expenditure') }}" method="post">
                                @csrf
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
                                            <th>Batch Name</th>
                                            <th>Expenditure Type</th>
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                            <th>Approval Status </th>
                                            <th>Transaction Date </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ExpenditureRegister as $key => $item)
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
                                                <td> {{ $item->batch_name }} </td>
                                                <td> {{ $item->expenditure_name }} </td>
                                                <td> {{ $item->name }} </td>
                                                <td> {{ $item->amount }}</td>
                                                <td> {{ $item->narration }} </td>
                                                <td>

                                                    @if ($item->approved == 0)
                                                        <span class="badge bg-label-warning">Pending</span>
                                                    @endif
                                                    @if ($item->approved == 1)
                                                        <span class="badge bg-label-primary">Await Final Approval</span>
                                                    @endif
                                                    @if ($item->approved == 2)
                                                        <span class="badge bg-label-success">Approved</span>
                                                    @endif
                                                    @if ($item->approved == 3)
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="viewDisapproveR('{{ $item->reason }}')">
                                                            Rejected
                                                            <span class="badge bg-white text-primary ms-1">View why</span>
                                                        </button>
                                                    @endif

                                                </td>
                                                <td> {{ date('Y-m-d', strtotime($item->created_at)) }}</td>

                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                data-bs-toggle="modal"data-bs-target="#updateModal"
                                                                onclick="update(
                                                '{{ $item->idexpenditure_payregister }}',
                                                '{{ $item->expenditure_name . ',' . $item->expenditure_code . ',' . $item->expenditure_type }}',
                                                '{{ $item->batch_name }}',
                                                '{{ $item->name }}',
                                                '{{ $item->amount }}',
                                                '{{ $item->narration }}',
                                                '{{ date('Y-m-d', strtotime($item->created_at)) }}',
                                                '{{ $item->payment_ref }}'
                                            )">
                                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('deleted_expenditure', $item->idexpenditure_payregister) }}"
                                                                onchange="confirm('Are you sure you want to delete?')"><i
                                                                    class="bx bx-trash me-1"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="9"><button type="submit"
                                                    class="btn btn-sm btn-primary">Submit</button></td>
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
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Update detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('post.expenditure') }}" method="post">
                    @method('PUT')
                    <div class="modal-body">

                        @csrf
                        <div class="fieldset">
                            <h1>Expenditure</h1>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-floating mb-3">
                                        <select name="expenditure_type" id="eexpenditure_type" style="width: 100%"
                                            class="form-control selectu @error('batch_type') is-invalid @enderror">
                                            <option value="">-- Select Option --</option>
                                            @foreach ($expenditureType as $Etype)
                                                <option
                                                    value="{{ $Etype->description . ',' . $Etype->economic_code . ',' . $Etype->type }}"
                                                    {{ old('expenditure_type') == $Etype->description ? 'selected' : '' }}>
                                                    {{ $Etype->description . ' :: ' . $Etype->economic_code }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="floatingInput">EXPENDITURE TYPE</label>
                                        <div id="floatingInputHelp" class="form-text"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="batch_type" id="ebatch_type"
                                            class="form-control @error('batch_type') is-invalid @enderror">
                                            <option value="">-- Select Option --</option>
                                            @foreach ($batchName as $batch)
                                                <option value="{{ $batch->name }}">{{ $batch->name }}</option>
                                            @endforeach

                                            {{-- <option value="Vendor">Vendor</option> --}}
                                        </select>
                                        <label for="floatingInput">Batch Type</label>
                                        <div id="floatingInputHelp" class="form-text"></div>
                                        @error('batch_type')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" name="date" id="edate" class="form-control">
                                        <label for="floatingInput">Date</label>
                                        <div id="floatingInputHelp" class="form-text"></div>
                                        @error('batch_type')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6  mb-3">
                                    <div class="form-floating">
                                        <input type="text"
                                            class="form-control @error('authority_document_ref_no') is-invalid @enderror"
                                            id="eauthority_document_ref_no" name="eauthority_document_ref_no"
                                            placeholder="Authority Document Ref. No"
                                            value="{{ old('authority_document_ref_no') }}" />
                                        <label for="floatingInput">Authority Document Ref. No</label>

                                        @error('authority_document_ref_no')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6  mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="ename" name="name"
                                            placeholder="Paid to" value="" />
                                        <label for="floatingInput">Paid to</label>
                                        <div id="floatingInputHelp" class="form-text"> </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6  mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="eamount" name="amount"
                                            placeholder="Amount" />
                                        <label for="floatingInput">Amount</label>
                                        <div id="floatingInputHelp" class="form-text"> </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12  mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="enarration" name="narration"
                                            placeholder="Narration" />
                                        <label for="floatingInput">Narration/Description of Payment</label>
                                        <div id="floatingInputHelp" class="form-text"> </div>

                                    </div>
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
                    <h5 class="modal-title" id="modalCenterTitle">Add New Expenditure</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('put.expenditure') }}" method="post">

                        @csrf
                        <div class="fieldset">
                            <h1>Expenditure</h1>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-floating mb-3">
                                        <select name="expenditure_type" style="width: 100%" id="expenditure_type"
                                            class="form-control select @error('batch_type') is-invalid @enderror">
                                            <option value="">-- Select Option --</option>
                                            @foreach ($expenditureType as $Etype)
                                                <option
                                                    value="{{ $Etype->description . ',' . $Etype->economic_code . ',' . $Etype->type }}"
                                                    {{ old('expenditure_type') == $Etype->description ? 'selected' : '' }}>
                                                    {{ $Etype->description . ' :: ' . $Etype->economic_code }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="floatingInput">EXPENDITURE TYPE</label>
                                        <div id="floatingInputHelp" class="form-text"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="batch_type" id="batch_type"
                                            class="form-control @error('batch_type') is-invalid @enderror">
                                            <option value="">-- Select Option --</option>
                                            @foreach ($batchName as $batch)
                                                <option value="{{ $batch->name }}">{{ $batch->name }}</option>
                                            @endforeach

                                            {{-- <option value="Vendor">Vendor</option> --}}
                                        </select>
                                        <label for="floatingInput">Batch Type</label>
                                        <div id="floatingInputHelp" class="form-text"></div>
                                        @error('batch_type')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" name="date" id="date" class="form-control">
                                        <label for="floatingInput">Date</label>
                                        <div id="floatingInputHelp" class="form-text"></div>
                                        @error('batch_type')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6  mb-3">
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

                                <div class="col-md-6 col-sm-6  mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingInput" name="name"
                                            placeholder="Paid to" value="" />
                                        <label for="floatingInput">Paid to</label>
                                        <div id="floatingInputHelp" class="form-text"> </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-5  mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingInput" name="amount"
                                            placeholder="Amount" />
                                        <label for="floatingInput">Amount</label>
                                        <div id="floatingInputHelp" class="form-text"> </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12  mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingInput" name="narration"
                                            placeholder="Narration" />
                                        <label for="floatingInput">Narration/Description of Payment</label>
                                        <div id="floatingInputHelp" class="form-text"> </div>

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


    <div class="modal fade" id="reason" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Reason for rejection rejected</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

    function add() {
        //   console.log("ko");
        var markup = `
    <div class="row" id="row${i}">
        <div class="col-md-3 col-sm-6">
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" name="name[]" placeholder="Year" value="" />
                <label for="floatingInput">Name</label>
                <div id="floatingInputHelp" class="form-text"> </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-5">
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" name="amount[]" placeholder="Amount" />
                <label for="floatingInput">Amount</label>
                <div id="floatingInputHelp" class="form-text"> </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="form-floating mb-3">
                <select name="expenditure_type[]" id="expenditure_type" class="form-control @error('batch_type') is-invalid @enderror">
                    <option value="">-- Select Option --</option>
                    @foreach ($expenditureType as $Etype)
                    <option value="{{ $Etype->description . ',' . $Etype->economic_code . ',' . $Etype->type }}" {{ old('expenditure_type') == $Etype->description ? 'selected' : '' }}>
                                        {{ $Etype->description }}
                                    </option>
                    @endforeach
                </select>
                <label for="floatingInput">EXPENDITURE TYPE</label>
                <div id="floatingInputHelp" class="form-text"></div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" name="narration[]" placeholder="Narration"  />
                <label for="floatingInput">Narration</label>
                <div id="floatingInputHelp" class="form-text"> </div>

            </div>
        </div>

      <div class="col-md-1 col-sm-1">
          <div class="form-group">
          <a href="javascript:;" class="btn btn-danger" onclick='deleteemprow(${i})'>-</a>
          </div>
      </div>

    </div>`;

        $("#addw").append(markup);
        i++;
    }

    function deleteemprow(h) {
        console.log(h);
        $(`#row${h}`).remove();
    }


    function update(idexpenditure_payregister, expenditure_code, batch_name, name, amount, narration, created_at,
        payment_ref) {
        // console.log({idexpenditure_payregister, expenditure_code, batch_name, name, amount, narration, created_at})
        $('#id').val(idexpenditure_payregister)
        $('#eexpenditure_type').val(expenditure_code)
        $('#ebatch_type').val(batch_name)
        $('#edate').val(created_at)
        $('#eauthority_document_ref_no').val(payment_ref)
        $('#ename').val(name)
        $('#eamount').val(amount)
        $('#enarration').val(narration)
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
