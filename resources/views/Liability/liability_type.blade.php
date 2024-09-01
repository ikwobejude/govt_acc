@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">ASSET /</span> ASSET CLASSIFICATION</h4>

    <div class="row">

      <div class="col-md-5">
        <div class="card mb-4">
          {{-- <h5 class="card-header">PPEClass(s)</h5> --}}
          <div class="card-body">
            <form action="{{ route('liability_type.store.post') }}" method="post">
                @csrf
                <div class="fieldset">
                    <h1>Laibility Type</h1>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control  @error('type') is-invalid @enderror" name="type" id="floatingInput" placeholder="Liability type" value="{{ old('type')}}" />
                        <label for="floatingInput">Liability Type</label>
                        <div id="floatingInputHelp" class="form-text"></div>
                        @error('type')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control  @error('description') is-invalid @enderror" name="description" id="description" placeholder="Description" value="{{ old('description')}}" />
                        <label for="floatingInput">Description</label>
                        <div id="floatingInputHelp" class="form-text"></div>
                        @error('description')
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

      <div class="col-md-7">
        <div class="card mb-4">
          <h5 class="card-header">Liability Type</h5>
          <div class="card-body">
                <table class="table table-stripe">
                    <thead>
                        <tr>
                            <th>Liability Type</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($liability_type as  $key=>$item)
                            <tr>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="edit(
                                        '{{ $item->type }}',
                                        '{{ $item->description }}',
                                        '{{ $item->id }}'
                                        )" data-bs-toggle="modal"data-bs-target="#modalCenter">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('liability_type.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this item?');"><i class="bx bx-trash me-1"></i>Delete</button>
                                        </form>
                                        {{-- <a class="dropdown-item" href="{{ route('liability_type.destroy') }}"><i class="bx bx-trash me-1"></i> Delete</a> --}}
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
       <form action="{{ route('liability_type.edit.put') }}" method="post">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <div class="row">
              <div class="col mb-3">
                <label for="nameWithTitle" class="form-label">Laibility Type</label>
                <input
                  type="text"
                  id="e_type"
                  name="type"
                  class="form-control"
                  placeholder="Enter Name" />
              </div>
            </div>
            <div class="row g-2">
              <div class="col mb-0">
                <label for="emailWithTitle" class="form-label">Description</label>
                <input
                  type="text"
                  id="e_description"
                  class="form-control"
                  placeholder="" />
                  <input type="hidden" name="id" id="id">
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

  @endsection
  <script>
    function edit(type, description, id) {
        // console.log({type, description, id})
        document.getElementById("e_type").value = type
        document.getElementById("e_description").value = description
        document.getElementById("id").value =id
    }
  </script>
