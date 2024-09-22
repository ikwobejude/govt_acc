@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Chart of Account /</span> Assets</h4>

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
                    <form action="" method="get" class="mt-3">
                        @csrf
                        <div class="fieldset">
                            <h1>Search Asset</h1>
                            <div class="row">
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-floating">
                                        <select name="revenue_code" id="revenue_code" class="form-control selects" style="width: 100%">
                                            <option value="">Select Revenue Line/Economic Code</option>
                                            @foreach ($revenue_lines as $item)
                                                <option value="{{ $item->economic_code }}" {{ old('revenue_code') == $item->economic_code ? 'selected': ''}}>
                                                    {{ $item->description." :: ".$item->economic_code  }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- <label for="floatingInput">Revenue Line/Economic Code</label> --}}
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-floating mb-3">
                                        <select name="asset_type" id="asset_type" class="form-control selects" style="width: 100%">
                                            <option value="">--     SELECT ASSET TYPE --</option>
                                            @foreach ($types as $item)
                                                <option value="{{ $item->id}}" {{ old('asset_type') == $item->id ? 'selected': ''}}>
                                                    {{ $item->assest_type}}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- <label for="floatingInput">ASSET TYPE</label> --}}
                                        <div id="floatingInputHelp" class="form-text"></div>

                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-floating mb-3">
                                        <select name="asset_category" id="asset_category" class="form-control selects" style="width: 100%">
                                            <option value="">-- SELECT ASSET CATEGORIES --</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->assest_category_id}}" {{ old('asset_category') == $item->assest_category_id ? 'selected': ''}}>
                                                    {{ $item->assest_category}}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- <label for="floatingInput">ASSET CATEGORIES</label> --}}
                                        <div id="floatingInputHelp" class="form-text"></div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="form-floating mb-3">
                                        <select name="asset_size" id="asset_size" class="form-control selects" style="width: 100%">
                                            <option value="">-- SELECT ASSET SIZE --</option>
                                            @foreach ($sizes as $item)
                                                <option value="{{ $item->id}}" {{ old('asset_size') == $item->id ? 'selected': ''}}>
                                                    {{ $item->assest_size}}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- <label for="floatingInput">ASSET SIZE</label> --}}
                                        <div id="floatingInputHelp" class="form-text"></div>

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="assest_name" id="assest_name" value="{{ old('assest_name')}}" placeholder="Asset Name" class="form-control" >
                                        <label for="floatingInput">Asset Name</label>
                                        <div id="floatingInputHelp" class="form-text"></div>
                                    </div>
                                </div>


                                <div class="col-md-3 col-sm-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="from" name="from" placeholder="" value="{{ old('from')}}" />
                                        <label for="floatingInput">From</label>
                                        <div id="floatingInputHelp" class="form-text"> </div>
                                        @error('date_purchased')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="to" name="to" placeholder="" value="{{ old('from')}}" />
                                        <label for="floatingInput">To</label>
                                        <div id="floatingInputHelp" class="form-text"> </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <select name="approvalLevels" id="approvalLevels" class="form-control selects" style="width: 100%">
                                            <option value="">Select Approvals</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Reveiewer Approavl</option>
                                            <option value="2">Approved</option>
                                            <option value="3">Rejected</option>
                                        </select>
                                        {{-- <label for="floatingInput">Approvals</label> --}}

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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add New Asset</button>
                </div>
            </div>
        </div>
          <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('finalize_asset') }}" method="post">
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
                                <th>Economic Line</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Asset Type</th>
                                <th>Asset Category</th>
                                <th>Action Type</th>
                                <th></th>
                                <th>Opening Value</th>
                                <th>Status </th>
                                <th>Created By </th>
                                <th>Purchased Date </th>
                                <th>Drafted On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assets as $item)
                            <tr>
                                <td>
                                    <div class="form-check form-check-flat mt-0">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="checkSingle form-check-input"
                                                id="checkSingle" aria-checked="false" name="itemid[]"
                                                value="{{ $item->assest_id }}"><i
                                                class="input-helper"></i></label>
                                    </div>
                                </td>
                                <td>{{ $item->asset_rev_name }}</td>
                                <td>{{ $item->asset_rev }}</td>
                                <td>{{ $item->assest_name }}</td>
                                <td>{{ $item->assest_type }}</td>
                                <td>{{ $item->assest_sub_type }}</td>
                                <td>{{ $item->action_type }}</td>
                                <td>{{ $item->asset_input_category }}</td>
                                <td>{{ number_format($item->opening_value, 2)  }}</td>
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
                                <td>{{ date('d-m-Y', strtotime($item->date_purchased)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->drafted_on)) }}</td>

                                <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"data-bs-target="#updateModal" onclick="update(
                                            '{{ $item->assest_id }}',
                                            '{{ $item->asset_rev_name.','.$item->asset_rev.','.$item->asset_rev_type }}',
                                            '{{ $item->asset_rev }}',
                                            '{{ $item->assest_name }}',
                                            '{{ $item->assest_type_id }}',
                                            '{{ $item->assest_sub_type }}',
                                            '{{ $item->action_type }}',
                                            '{{ $item->asset_input_category }}',
                                            '{{ $item->opening_value }}',
                                            '{{ date('Y-m-d', strtotime($item->date_purchased)) }}',
                                            '{{ $item->assest_decription }}',
                                            '{{ $item->assest_sub_type_id }}'
                                        )">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="{{ route('delete_asset', $item->assest_id) }}" onclick="confirm('Are you sure you want to delete?')"><i class="bx bx-trash me-1"></i> Delete</a>
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
          <h5 class="modal-title" id="modalCenterTitle">Edit detail</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <form action="{{ route('put.asset') }}" method="post">
            @method('PUT')
            <div class="modal-body">
                    @csrf
                    <div class="fieldset">
                        <h1>Asset</h1>
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-floating mb-2">
                                    <input type="hidden" name="id" id="id">
                                    <select name="revenue_code" id="erevenue_code" class="form-control selectu" style="width: 100%">
                                        <option value="">Select option</option>
                                        @foreach ($revenue_lines as $item)
                                            <option value="{{ $item->description.",".$item->economic_code.",".$item->type  }}" {{ old('revenue_code') == $item->economic_code ? 'selected': ''}}>
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
                            <div class="col-md-4 col-sm-6">
                                <div class="form-floating mb-3">
                                    <select name="asset_type" id="easset_type" class="form-control @error('asset_type') is-invalid @enderror"  style="width: 100%" onchange="getAssetSubType('eassest_sub_type_id')">
                                        <option value="">-- SELECT ASSET TYPE  --</option>
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
                            <div class="col-md-4 col-sm-6">
                                <div class="form-floating mb-3">
                                    <select name="assest_sub_type_id" id="eassest_sub_type_id" class="form-control " style="width: 100%">

                                    </select>
                                    <label for="floatingInput">ASSET CATEGORIES</label>
                                    <div id="floatingInputHelp" class="form-text"></div>
                                    @error('expenditure_category')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-floating mb-3">
                                    <select name="action_type" id="eaction_type" class="form-control" style="width: 100%">
                                        <option value="">-- SELECT ACTION TYPE --</option>
                                        <option value="Addition">Addition</option>
                                        <option value="Disposal/Transfer">Disposal/Transfer</option>
                                    </select>
                                    <label for="floatingInput">Action Type</label>

                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-floating mb-3">
                                    <select name="asset_input_category" id="easset_input_category" class="form-control" style="width: 100%">
                                        <option value="">-- TO --</option>
                                        <option value="ASSET">ASSET</option>
                                        <option value="AMORTISATION">AMORTISATION</option>
                                        <option value="IMPAIRMENT">IMPAIRMENT</option>
                                    </select>
                                    <label for="floatingInput">Action Category</label>

                                </div>
                            </div>


                            <div class="col-md-4 col-sm-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="assest_name" id="eassest_name" value="{{ old('assest_name')}}" placeholder="Asset Name" class="form-control" >
                                    <label for="floatingInput">Asset Name</label>
                                    <div id="floatingInputHelp" class="form-text"></div>
                                    @error('assest_name')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-floating mb-3">
                                    <input type="text" id="eauthority_document_ref_no" name="authority_document_ref_no" class="form-control  @error('authority_document_ref_no') is-invalid @enderror"  placeholder="Authority Document Ref. No" value="{{ old('authority_document_ref_no')}}" />
                                    <label for="floatingInput">Authority Document Ref. No</label>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control  @error('date_purchased') is-invalid @enderror" id="edate_purchased" name="date_purchased" placeholder="Date of purchase" value="{{ old('date_purchased')}}" />
                                    <label for="floatingInput">Date of purchase</label>
                                    <div id="floatingInputHelp" class="form-text"> </div>
                                    @error('date_purchased')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-5">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control  @error('opening_value') is-invalid @enderror" value="{{ old('opening_value')}}" id="eopening_value" name="opening_value" placeholder="Opening value" />
                                    <label for="floatingInput">Opening value</label>
                                    <div id="floatingInputHelp" class="form-text"> </div>
                                    @error('opening_value')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="eassest_decription" value="{{ old('assest_decription')}}" name="assest_decription" placeholder="Asset Description"  />
                                    <label for="floatingInput">Asset Description</label>
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
          <h5 class="modal-title" id="modalCenterTitle">Add New Asset</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('post.asset') }}" method="post">
                @csrf
                <div class="fieldset">
                    <h1>Asset</h1>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="form-floating">
                                <select name="revenue_code" id="select" class="form-control" style="width: 100%">
                                    <option value="">Select Revenue Line/Economic Code</option>
                                    @foreach ($revenue_lines as $item)
                                        <option value="{{ $item->description.",".$item->economic_code.",".$item->type  }}" {{ old('revenue_code') == $item->economic_code ? 'selected': ''}}>
                                            {{ $item->description." :: ".$item->economic_code  }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- <label for="floatingInput">Revenue Line/Economic Code</label> --}}

                                @error('revenue_code')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-floating mb-3">
                                <select name="asset_type" id="select1" class="form-control @error('asset_type') is-invalid @enderror" style="width: 100%" onchange="getAssetSubType('select3')">
                                    <option value="">-- SELECT ASSET TYPE --</option>
                                    @foreach ($types as $item)
                                        <option value="{{ $item->id}}" {{ old('asset_type') == $item->id ? 'selected': ''}}>
                                            {{ $item->assest_type}}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- <label for="floatingInput">ASSET TYPE</label> --}}
                                <div id="floatingInputHelp" class="form-text"></div>
                                @error('asset_type')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-floating mb-3">
                                <select name="assest_sub_type_id" id="select3" class="form-control @error('expenditure_category') is-invalid @enderror" style="width: 100%">

                                </select>
                                {{-- <label for="floatingInput">ASSET CATEGORIES</label> --}}
                                <div id="floatingInputHelp" class="form-text"></div>
                                @error('expenditure_category')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="form-floating mb-3">
                                <select name="action_type" id="select2" class="form-control select @error('asset_size') is-invalid @enderror " style="width: 100%">
                                    <option value="">-- SELECT ACTION TYPE --</option>
                                    <option value="Addition">Addition</option>
                                    <option value="Disposal/Transfer">Disposal/Transfer</option>
                                </select>

                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="form-floating mb-3">
                                <select name="asset_input_category" id="asset_input_category" class="form-control select @error('asset_size') is-invalid @enderror " style="width: 100%">
                                    <option value="">-- TO --</option>
                                    <option value="ASSET">ASSET</option>
                                    <option value="AMORTISATION">AMORTISATION</option>
                                    <option value="IMPAIRMENT">IMPAIRMENT</option>
                                </select>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" name="assest_name" id="assest_name" value="{{ old('assest_name')}}" placeholder="Asset Name" class="form-control" >
                                <label for="floatingInput">Asset Name</label>
                                <div id="floatingInputHelp" class="form-text"></div>
                                @error('assest_name')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('authority_document_ref_no') is-invalid @enderror" id="floatingInput" name="authority_document_ref_no" placeholder="Authority Document Ref. No" value="{{ old('authority_document_ref_no')}}" />
                                <label for="floatingInput">Authority Document Ref. No</label>
                            </div>
                        </div>

                        <div class="col-md-4  col-sm-6">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control  @error('date_purchased') is-invalid @enderror" id="date_purchased" name="date_purchased" placeholder="Date of purchase" value="{{ old('date_purchased')}}" />
                                <label for="floatingInput">Date of purchase</label>
                                <div id="floatingInputHelp" class="form-text"> </div>
                                @error('date_purchased')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-5 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control  @error('opening_value') is-invalid @enderror" value="{{ old('opening_value')}}" id="opening_value" name="opening_value" placeholder="Opening value" />
                                <label for="floatingInput">Opening value</label>
                                <div id="floatingInputHelp" class="form-text"> </div>
                                @error('opening_value')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" value="{{ old('assest_decription')}}" name="assest_decription" placeholder="Asset Description"  />
                                <label for="floatingInput">Asset Description</label>
                                <div id="floatingInputHelp" class="form-text"> </div>

                            </div>
                        </div>
                    </div>

                    {{-- <div id="addw">

                    </div> --}}



                    <hr>
                    <div class="row m-4">
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
    // $(document).ready( function () {
    //     $('#select1').select2({
    //         dropdownParent: $('#addModal')
    //     });
    // })
    var i = 1;

    function deleteemprow(h) {
      console.log(h);
      $(`#row${h}`).remove();
    }


    function update(assest_id, asset_rev_name, asset_rev, assest_name, assest_type, assest_sub_type, action_type, asset_input_category, opening_value, date_purchased, assest_decription, assest_sub_type_id) {
        console.log({assest_sub_type_id})
        $('#id').val(assest_id)
        $('#erevenue_code').val(asset_rev_name)
        $('#easset_type').val(assest_type)
        // $('#eassest_sub_type_id').val(assest_sub_type)
        $('#eaction_type').val(action_type)
        $('#easset_input_category').val(asset_input_category)
        $('#eassest_name').val(assest_name)
        $('#eauthority_document_ref_no').val()
        $('#edate_purchased').val(date_purchased)
        $('#eopening_value').val(opening_value)
        $('#eassest_decription').val(assest_decription)

        const selection = document.getElementById("eassest_sub_type_id");
        const option = document.createElement("option");
        option.value = assest_sub_type_id;
        option.textContent = assest_sub_type;
        selection.appendChild(option);

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


        // document.getElementById("select1").addEventListener("change", getAssetSubType);
        function getAssetSubType(id) {
            const select1 = id ==  "eassest_sub_type_id" ? document.getElementById("easset_type").value : document.getElementById("select1").value;
            // eassest_sub_type_id
            fetch('/settings/fetch-asset-sub-type?id='+select1)
            .then(response => response.json())
            .then(data => {
                // console.log(data)
                populateItem(data.data, id)
            })
            .catch(error => console.error('Error:', error));
        }

        function populateItem(rows, id) {

            // $('#cover-spin').hide(0)
            const selection = document.getElementById(id);
            selection.innerHTML = "";
            const option1 = document.createElement("option");
            option1.value = "";
            option1.textContent = "Select option";
            selection.appendChild(option1);
            rows.forEach((st) => {
                const option = document.createElement("option");
                option.value = st.id;
                option.textContent = st.assest_sub_type;
                selection.appendChild(option);
            });
        }
</script>
