@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Chart of Account /</span> Liability</h4>

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
                    <form action="" method="get">
                        @csrf
                        <div class="fieldset">
                            <h1>liability</h1>
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-floating">
                                        <select name="revenue_code" id="revenue_code" class="form-control selects" style="width: 100%">
                                            <option value="">Select Revenue Line/Economic Code</option>
                                            @foreach ($EconomicLines as $item)
                                                <option value="{{ $item->economic_code  }}" {{ old('revenue_code') == $item->economic_code ? 'selected': ''}}>
                                                    {{ $item->description." :: ".$item->economic_code  }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- <label for="floatingInput">Revenue Line/Economic Code</label> --}}

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
                                        <select name="type_of_liability" id="type_of_liability" class="form-control selects" style="width: 100%">
                                            <option value="">Select Types of liabilities</option>
                                            <option value="Current liabilities">Current liabilities</option>
                                            <option value="Non-current liabilities">Non-current liabilities</option>
                                            <option value="Current liabilities">Contingent liabilities</option>
                                        </select>
                                        {{-- <label for="floatingInput">Types of liabilities</label> --}}
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add New Liability</button>
                    </div>
                </div>
            </div>
          <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('finalization_liability') }}" method="post">
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
                                <th>Action</th>
                                <th>Economic Line/Code</th>
                                <th>Name</th>
                                <th>Liability Type</th>
                                <th>Narration</th>
                                <th>Authorization Ref</th>
                                <th>Amount</th>
                                <th>Transaction Date </th>
                                <th>Created By </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($liabilities as $item)
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
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"data-bs-target="#updateModal" onclick="update(
                                            '{{ $item->economic_name.','.$item->economic_code.','.$item->economic_type }}',
                                            '{{ $item->liability }}',
                                            '{{ $item->type_of_liability }}',
                                            '{{ $item->authorize_ref }}',
                                            '{{  \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}',
                                            '{{ $item->narration }}',
                                            '{{ $item->amount }}',
                                            '{{ $item->id }}'
                                        )">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="{{ route('delete.liability', $item->id)}}" onclick="confirm('Are you sure you want to delete?')"><i class="bx bx-trash me-1"></i> Delete</a>
                                      </div>
                                    </div>
                                </td>
                                <td>{{ $item->economic_name."/".
                                    $item->economic_code }}</td>
                                <td>{{ $item->liability }}</td>
                                <td>{{ $item->type_of_liability }}</td>
                                <td>{{ $item->narration }}</td>
                                <td>{{ $item->authorize_ref }}</td>
                                <td>{{  number_format($item->amount, 2) }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->name }}</td>

                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="9"><button type="submit" class="btn btn-md btn-primary">Submit</button></td>
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
          <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <form action="{{ route('put.liability') }}" method="post">
            @method('PUT')
            @csrf
            <div class="modal-body">

                    <div class="fieldset">
                        <h1>liability</h1>
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-floating mb-2">
                                    <input type="hidden" name="id" id="id">
                                    <select name="revenue_code" id="erevenue_code" class="form-control selectu" style="width: 100%">
                                        <option value="">Select Revenue Line/Economic Code</option>
                                        @foreach ($EconomicLines as $item)
                                            <option value="{{ $item->description.",".$item->economic_code.",".$item->type  }}" {{ old('revenue_code') == $item->economic_code ? 'selected': ''}}>
                                                {{ $item->description." :: ".$item->economic_code  }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- <label for="floatingInput">Revenue Line/Economic Code</label> --}}

                                    @error('economic_code')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="col-md-4 col-sm-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="liability" id="eliability" value="{{ old('liability')}}" placeholder="Liability" class="form-control" >
                                    <label for="floatingInput">Liability</label>
                                    <div id="floatingInputHelp" class="form-text"></div>
                                    @error('liability')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-floating">
                                    <select name="type_of_liability" id="etype_of_liability" class="form-control selectu" style="width: 100%">
                                        <option value="">Select Types of liabilities</option>
                                        <option value="Current liabilities">Current liabilities</option>
                                        <option value="Non-current liabilities">Non-current liabilities</option>
                                        <option value="Current liabilities">Contingent liabilities</option>
                                    </select>
                                    {{-- <label for="floatingInput">Types of liabilities</label> --}}
                                    <div id="floatingInputHelp" class="form-text"> </div>
                                    @error('type_of_liability')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-floating">
                                    <input id="eauthority_document_ref_no" name="authority_document_ref_no" type="text" class="form-control @error('authority_document_ref_no') is-invalid @enderror"  placeholder="Authority Document Ref. No" value="{{ old('authority_document_ref_no')}}" />
                                    <label for="floatingInput">Authority Document Ref. No</label>
                                    @error('authority_document_ref_no')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-4 col-sm-6">
                                <div class="form-floating">
                                    <input type="text" id="eamount" name="amount"  class="form-control  @error('amount') is-invalid @enderror" value="{{ old('amount')}}" placeholder="Opening value" />
                                    <label for="floatingInput">Amount</label>
                                    <div id="floatingInputHelp" class="form-text"> </div>
                                    @error('amount')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="edescription" value="{{ old('description')}}" name="description" placeholder="Description"  />
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
                                <select name="revenue_code" id="select2" class="form-control " style="width: 100%">
                                    <option value="">Select Revenue Line/Economic Code</option>
                                    @foreach ($EconomicLines as $item)
                                        <option value="{{ $item->description.",".$item->economic_code.",".$item->type  }}" {{ old('revenue_code') == $item->economic_code ? 'selected': ''}}>
                                            {{ $item->description." :: ".$item->economic_code  }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- <label for="floatingInput">Revenue Line/Economic Code</label> --}}

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
                                <select name="type_of_liability" id="select1" class="form-control " style="width: 100%">
                                    <option value="">Select Types of liabilities</option>
                                    <option value="Current liabilities">Current liabilities</option>
                                    <option value="Non-current liabilities">Non-current liabilities</option>
                                    <option value="Current liabilities">Contingent liabilities</option>
                                </select>
                                {{-- <label for="floatingInput">Types of liabilities</label> --}}
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


function update(economic_name, liability, type_of_liability, authorize_ref, created_at, narration, amount, id) {
    // console.log({economic_name, liability, type_of_liability, authorize_ref, created_at, id})
    $('#erevenue_code').val(economic_name)
    $('#eliability').val(liability)
    $('#etype_of_liability').val(type_of_liability)
    $('#eauthority_document_ref_no').val(authorize_ref)
    $('#eamount').val(amount)
    $('#edescription').val(narration)
    $('#id').val(id)
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
  </script>
