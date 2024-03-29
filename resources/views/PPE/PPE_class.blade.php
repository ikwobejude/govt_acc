@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">ASSET /</span> ASSET CLASSIFICATION</h4>

    <div class="row">

      <div class="col-md-6">
        <div class="card mb-4">
          {{-- <h5 class="card-header">PPEClass(s)</h5> --}}
          <div class="card-body">
            <form action="{{ route('post.ppe.class') }}" method="post">
                @csrf
                <div class="fieldset">
                    <h1>ASSET CLASSIFICATION</h1>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control  @error('ppeclass') is-invalid @enderror" name="ppeclass" id="floatingInput" placeholder="PPE Class" value="{{ old('PPEClass')}}" />
                        <label for="floatingInput">PPE Class</label>
                        <div id="floatingInputHelp" class="form-text"></div>
                        @error('ppeclass')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control  @error('ppeclass_description') is-invalid @enderror" name="ppeclass_description" id="ppeclass_description" placeholder="PPE Class" value="{{ old('ppeclass_description')}}" />
                        <label for="floatingInput">PPE Class Description</label>
                        <div id="floatingInputHelp" class="form-text"></div>
                        @error('ppeclass_description')
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
          <h5 class="card-header">ASSET CLASSIFICATION </h5>
          <div class="card-body">
                <table class="table table-stripe">
                    <thead>
                        <tr>
                            <th>PPE Class</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ppeClass as  $key=>$item)
                            <tr>
                                <td>{{ $item->ppeclass }}</td>
                                <td>{{ $item->ppeclass_description }}</td>
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
