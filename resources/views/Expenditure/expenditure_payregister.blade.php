@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Expenditure Pay Register</h4>

    <div class="row">

      <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">Expenditure(s)</h5>
          <div class="card-body">
            <form action="{{ route('post.expenditure') }}" method="post">
                @csrf
                <div class="fieldset">
                    <h1>Expenditure</h1>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="form-floating mb-3">
                                <select name="expenditure_type" id="expenditure_type" class="form-control @error('batch_type') is-invalid @enderror">
                                    <option value="">-- Select Option --</option>
                                    @foreach ($expenditureType as $Etype)
                                    <option value="{{ $Etype->description.",".$Etype->economic_code.",".$Etype->type  }}" {{ old('expenditure_type') == $Etype->description ? 'selected': ''}}>
                                        {{ $Etype->description  }}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="floatingInput">EXPENDITURE TYPE</label>
                                <div id="floatingInputHelp" class="form-text"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <select name="batch_type" id="batch_type" class="form-control @error('batch_type') is-invalid @enderror">
                                    <option value="">-- Select Option --</option>
                                    @foreach($batchName as $batch)
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
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="date" name="date" id="date" class="form-control" >
                                <label for="floatingInput">Date</label>
                                <div id="floatingInputHelp" class="form-text"></div>
                                @error('batch_type')
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

                        <div class="col-md-3 col-sm-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Paid to" value="" />
                                <label for="floatingInput">Paid to</label>
                                <div id="floatingInputHelp" class="form-text"> </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-5">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" name="amount" placeholder="Amount" />
                                <label for="floatingInput">Amount</label>
                                <div id="floatingInputHelp" class="form-text"> </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" name="narration" placeholder="Narration"  />
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

      <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">Expenditure Pay Register</h5>
          <div class="card-body">
            <div class="table-reponsive">
                <table class="table table-stripe">
                    <thead>
                        <tr>
                            {{-- <th>S/N</th> --}}
                            <th>Batch Name</th>
                            <th>Expenditure Type</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Date </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ExpenditureRegister as  $key=>$item)
                            <tr>
                                {{-- <td>{{ $key + 1}}</td> --}}
                                <td> {{ $item->batch_name }} </td>
                                <td> {{ $item->expenditure_name }} </td>
                                <td> {{ $item->name }} </td>
                                <td> {{ $item->amount }}</td>
                                <td> {{ $item->narration }} </td>
                                <td> {{ date("Y-m-d", strtotime($item->created_at)) }}</td>

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
                    <option value="{{ $Etype->description.",".$Etype->economic_code.",".$Etype->type  }}" {{ old('expenditure_type') == $Etype->description ? 'selected': ''}}>
                                        {{ $Etype->description  }}
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
</script>
  </script>
