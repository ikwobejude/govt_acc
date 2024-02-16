@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">PPE /</span> PPE clase</h4>

    <div class="row">

      <div class="col-md-12">
        <div class="card mb-4">
          {{-- <h5 class="card-header">PPEClass(s)</h5> --}}
          <div class="card-body">
            <form action="{{ route('post.revenue') }}" method="post">
                @csrf
                <div class="fieldset">
                    <h1>Asset Register</h1>
                    <div class="row mb-3">

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('ppename') is-invalid @enderror" id="floatingInput" name="ppename" placeholder="Received From" value="{{ old('ppename')}}" />
                                <label for="floatingInput">Property, Plant & Equiptment Name</label>

                                @error('ppename')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('ppedesc') is-invalid @enderror" id="floatingInput" name="ppedesc" placeholder="Description/Details of Receipt" value="{{ old('description')}}" />
                                <label for="floatingInput">PPE Description</label>

                                @error('ppedesc')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">

                                <select name="ppeclass" id="ppeclass" class="form-control">
                                    <option value="">Select option</option>
                                    @foreach ($ppeClass as  $item)
                                        <option value="{{ $item->classid."/".$item->depreciation_type_id }}"> {{ $item->ppeclass }}</option>
                                    @endforeach



                                </select>
                                <label for="floatingInput">PPE Class</label>

                                @error('ppeclass')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">

                        <div class="col-md-4">
                            <div class="form-floating">
                                <select name="ppestate" id="ppestate" class="form-control">
                                    <option value="">Select option</option>
                                    @foreach ($state as $item)
                                    <option value="{{ $item->state_id }}">{{ $item->state }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingInput">PPE State</label>

                                @error('ppestate')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('location') is-invalid @enderror" id="floatingInput" name="location" placeholder="Gwarimpa" value="{{ old('location')}}" />
                                <label for="floatingInput">Property, Plant & Equiptment Location</label>

                                @error('location')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="date" class="form-control @error('warranty') is-invalid @enderror" id="floatingInput" name="warranty" placeholder="" value="{{ old('settlement_date')}}" />
                                <label for="floatingInput">Warranty</label>

                                @error('warranty')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>



                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('usefulyears') is-invalid @enderror" id="floatingInput" name="usefulyears" placeholder="3" value="{{ old('usefulyears')}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                <label for="floatingInput">Usefull Years</label>

                                @error('usefulyears')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('residualval') is-invalid @enderror" id="floatingInput" name="residualval" placeholder="Residual Value" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{ old('residualval')}}" />
                                <label for="floatingInput">Residual Value</label>

                                @error('residualval')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('salvage_value') is-invalid @enderror" id="floatingInput" name="salvage_value" placeholder="Salvage Value" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{ old('salvage_value')}}" />
                                <label for="floatingInput">Salvage Value</label>

                                @error('salvage_value')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-10">.</div>
                        <div class="col-2" style="text-align: right">
                            <button type="submit" class="btn btn-primary me-2">Save</button>
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
                <table class="table table-stripe">
                    <thead>
                        <tr>
                            <th>PPE Name</th>
                            <th>Description</th>
                            <th>PPE Class</th>
                            <th>PPE State</th>
                            <th>Location</th>
                            <th>Warrenty</th>
                            <th>Userfull Years</th>
                            <th>Residual Value</th>
                            <th>Salvage Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($acctPPE as  $key=>$item)
                            <tr>
                                <td>{{ $item->ppename }}</td>
                                <td>{{ $item->ppedesc }}</td>
                                <td>{{ $item->ppeclass }}</td>
                                <td>{{ $item->ppestate }}</td>
                                <td>{{ $item->location }}</td>
                                <td>{{ $item->warranty }}</td>
                                <td>{{ $item->usefulyears }}</td>
                                <td>{{ $item->residualval }}</td>
                                <td>{{ $item->salvage_value }}</td>
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

  @endsection
