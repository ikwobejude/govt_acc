@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span>Notes</h4>

    <div class="row">


      <div class="col-md-4">
        <div class="card mb-4">
          <h5 class="card-header">Notes</h5>
          <div class="card-body">
            <form action="{{ route('post.note') }}" method="post">
                @csrf
                <div class="fieldset">
                    <h1>Add Note</h1>


                    <div class="form-floating">
                        <input type="text" class="form-control  @error('note_name') is-invalid @enderror" name="note_name" id="floatingInput" placeholder="Note name" value="{{ old('note_name')}}" />
                        <label for="floatingInput">Note</label>
                        <div id="floatingInputHelp" class="form-text">e.g Note 1</div>
                        @error('note_name')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('note_code') is-invalid @enderror" id="floatingInput" name="note_code" placeholder="Note code" value="{{ old('note_code')}}" />
                        <label for="floatingInput">Note Code</label>
                        {{-- <div id="floatingInputHelp" class="form-text"></div> --}}
                        @error('note_code')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="floatingInput" name="description" placeholder="Description" value="{{ old('description')}}" />
                        <label for="floatingInput">Note Description</label>
                        {{-- <div id="floatingInputHelp" class="form-text"></div> --}}
                        @error('description')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>





                    <div class="row">
                        {{-- <div class="col">
                             <button
                             type="button"
                             data-bs-toggle="modal"
                             data-bs-target="#modalCenter1"
                             class="btn btn-outline-secondary">Upload</button>
                        </div> --}}
                        <div class="col" style="text-align: right">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </div>

                    </div>
                </div>

            </form>

          </div>
        </div>
      </div>

      <div class="col-md-8">
        <div class="card mb-4">
          <h5 class="card-header">Asset Line(s)</h5>
          <div class="card-body">
                <table class="table table-stripe">
                    <thead>
                        <tr>
                            <th>Note</th>
                            <th>Description</th>
                            <th>Code </th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notes as  $key=>$item)
                            <tr>
                                <td>{{ $item->note_name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->note_code }}</td>

                                <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('ncoa.codes', ['note'=> $item->note_code])}}"><i class="bx bx-folder me-1"></i>View items in note</a>
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"data-bs-target="#modalCenter" onclick="update(
                                            '{{ $item->note_name }}',
                                            '{{ $item->description }}',
                                            '{{ $item->note_code }}',
                                            '{{ $item->id }}'
                                        )">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item"  href="{{ route('delete.note',  $item->id) }}" onclick="return confirm('Are you sure you want to delete?')"><i class="bx bx-trash me-1"></i> Delete</a>
                                      </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>



                </table>
                {{ $notes->links() }}
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
          <h5 class="modal-title" id="modalCenterTitle">Edit Revenue Items</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <form action="{{ route('edit.note') }}" method="post">
            @method('PUT')
            <div class="modal-body">
                @csrf
                <div class="fieldset">
                    <h1>Edit Note</h1>


                    <div class="form-floating">
                        <input type="text" class="form-control  @error('note_name') is-invalid @enderror" name="note_name" id="enote_name" placeholder="Note name" value="{{ old('note_name')}}" />
                        <label for="floatingInput">Note</label>
                        <div id="floatingInputHelp" class="form-text">e.g Note 1</div>
                        @error('note_name')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('note_code') is-invalid @enderror" id="enote_code" name="note_code" placeholder="Note code" value="{{ old('note_code')}}" />
                        <label for="floatingInput">Note Code</label>
                        {{-- <div id="floatingInputHelp" class="form-text"></div> --}}
                        @error('note_code')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="edescription" name="description" placeholder="Description" value="{{ old('description')}}" />
                        <label for="floatingInput">Note Description</label>
                        {{-- <div id="floatingInputHelp" class="form-text"></div> --}}
                        @error('description')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>

                    <input type="hidden" name="id" id="id">
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
   {{-- <div class="modal fade" id="modalCenter1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Upload Revenue</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <form action="{{ route('upload.revenue') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameWithTitle" class="form-label">Upload file</label>
                        <input type="file" name="file" id="file" class="form-control">
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
  </div> --}}


  <script>
    function update(note_name, description, note_code, id) {
        // console.log({economic_code, description, type, revenue_id})
        $('#enote_name').val(note_name)
        $('#enote_code').val(note_code)
        $('#edescription').val(description)
        $('#id').val(id)
    }
  </script>

  @endsection
