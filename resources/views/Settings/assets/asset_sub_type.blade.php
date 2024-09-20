@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Asset Sub Type</h4>

    <div class="row">

      <div class="col-md-6">
        <div class="card mb-4">
          <h5 class="card-header">New Asset Sub Type</h5>
          <div class="card-body">
            <form action="{{ route('asset.sub_type.post') }}" method="post">
                @csrf
                <div class="fieldset">
                    <h1>Asset Sub Type</h1>
                    <div class="form-floating">
                        <select name="asset" id="asset" class="form-control">
                            <option value="">Select option</option>
                            @foreach ($assetType as  $key=>$item)
                            <option value="{{ $item->id }}">{{ $item->assest_type }}</option>
                            @endforeach
                        </select>
                        <label for="floatingInput">Asset Sub Type</label>
                        <div id="floatingInputHelp" class="form-text">
                        </div>
                        @error('revenue_line')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control  @error('assest_sub_type') is-invalid @enderror" name="assest_sub_type" id="floatingInput" placeholder="Asset Type" value="{{ old('assest_sub_type')}}" />
                        <label for="floatingInput">Asset Sub Type</label>
                        <div id="floatingInputHelp" class="form-text">
                          {{-- Revenue line in other word revenue name --}}
                        </div>
                        @error('revenue_line')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control @error('assest_sub_type_description') is-invalid @enderror" id="floatingInput" name="assest_sub_type_description" placeholder="Description" value="{{ old('assest_sub_type_description')}}" />
                        <label for="floatingInput">Description</label>
                        <div id="floatingInputHelp" class="form-text">
                          {{-- Revenue code for the above inputed revenue name --}}
                        </div>
                        @error('assest_sub_type_description')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>

                    <div class="float-right" >
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        {{-- <button type="reset" class="btn btn-outline-secondary">Discard</button> --}}
                    </div>
                </div>

            </form>

          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card mb-4">
          <h5 class="card-header">ASSET SUB TYPE</h5>
          <div class="card-body">
                <table class="table table-stripe">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Asset Type</th>
                            <th>Asset Sub Type</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assetSubType as  $key=>$item)
                            <tr>
                                <td>{{ $key + 1}}</td>
                                <td>{{ $item->assest_type }}</td>
                                <td>{{ $item->assest_sub_type }}</td>
                                <td>{{ $item->assest_sub_type_description }}</td>
                                <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"data-bs-target="#modalCenter" onclick="edit(
                                            '{{ $item->assest_type }}',
                                            '{{ $item->assest_sub_type }}',
                                            '{{ $item->assest_sub_type_description }}',
                                             {{ $item->id }}
                                        )">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="{{ route('asset.type.delete', $item->id) }}" onclick="return confirm('Are you sure you want to delete?')"><i class="bx bx-trash me-1"></i> Delete</a>
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
          <h5 class="modal-title" id="modalCenterTitle">UPDATE ASSET SUB TYPE</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <form action="{{ route('asset.type.edit') }}" method="post">
            @method('PUT')
             @csrf
            <div class="modal-body">
                <div class="row">
                  <div class="col mb-3">
                    <label for="nameWithTitle" class="form-label">Revenue Line</label>
                    <input type="text" class="form-control  @error('assest_type') is-invalid @enderror" name="assest_type" id="assest_type" placeholder="Asset Type" value="{{ old('assest_type')}}" />
                  </div>
                </div>
                <div class="row g-2">
                  <div class="col mb-0">
                    <label for="emailWithTitle" class="form-label">Revenue Code</label>
                    <input type="text" class="form-control @error('assest_type_description') is-invalid @enderror" id="assest_type_description" name="assest_type_description" placeholder="Description" value="{{ old('assest_type_description')}}" />
                  </div>
                </div>
              </div>
              <input type="hidden" name="id" id="id">
              <div class="modal-footer">
                {{-- <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                  Close
                </button> --}}
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
        </form>

      </div>
    </div>
  </div>

  @endsection

  <script>
    function edit(assest_type, assest_type_description, id) {
        $('#assest_type').val(assest_type);
        $('#assest_type_description').val(assest_type_description);
        $('#id').val(id);
    }
  </script>
