@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Asset Categories</h4>

    <div class="row">

      <div class="col-md-6">
        <div class="card mb-4">
          <h5 class="card-header">New Asset Class</h5>
          <div class="card-body">
            <form action="{{ route('asset.categories.post') }}" method="post">
                @csrf
                <div class="fieldset">
                    <h1>Asset Class</h1>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control  @error('assest_category') is-invalid @enderror" name="assest_category" id="floatingInput" placeholder="Asset Catogory" value="{{ old('assest_category')}}" />
                        <label for="floatingInput">Asset Class</label>
                        <div id="floatingInputHelp" class="form-text">
                          {{-- Revenue line in other word revenue name --}}
                        </div>
                        @error('assest_category')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control @error('assest_category_description') is-invalid @enderror" id="floatingInput" name="assest_category_description" placeholder="Description" value="{{ old('assest_category_description')}}" />
                        <label for="floatingInput">Description</label>
                        <div id="floatingInputHelp" class="form-text">
                          {{-- Revenue code for the above inputed revenue name --}}
                        </div>
                        @error('assest_category_description')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-4" style="text-align: center">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </div>

                        {{-- <button type="reset" class="btn btn-outline-secondary">Discard</button> --}}
                    </div>
                </div>

            </form>

          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card mb-4">
          <h5 class="card-header">Asset Class</h5>
          <div class="card-body">
                <table class="table table-stripe">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Asset Class</th>
                            <th>Description</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assetCategory as  $key=>$item)
                            <tr>
                                <td>{{ $key + 1}}</td>
                                <td>{{ $item->assest_category }}</td>
                                <td>{{ $item->assest_category_description }}</td>
                                {{-- <td>
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
                                </td> --}}
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
