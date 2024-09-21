
@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> All NCOA (Economical code)</h4>

    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="accordion mt-3" id="accordionExample">
                <div class="card accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                            data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                            Search
                        </button>
                    </h2>

                    <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form action="" method="get" class="mt-3">
                                @csrf
                                <div class="fieldset">
                                    <h1>Search</h1>
                                    <div class="row mb-3">

                                        <div class="col-md-12 mb-3">
                                            <div class="form-floating">
                                                <select name="revenue_code" id="revenue_code" style="width: 100%" class="form-control selects">
                                                    <option value="">Select Revenue Line/Economic Code</option>
                                                    @foreach ($revenue as $item)
                                                        <option value="{{ $item->economic_code }}"
                                                            {{ old('revenue_code') == $item->economic_code ? 'selected' : '' }}>
                                                            {{ $item->description . ' :: ' . $item->economic_code }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                {{-- <label for="floatingInput">Revenue Line/Economic Code</label> --}}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <select name="note" id="note" style="width: 100%" class="form-control selects">
                                                    <option value="">Select note</option>
                                                    @foreach ($notes as  $note)
                                                    <option value="{{ $note->note_code }}">{{ $note->note_name." ".$note->description }}</option>
                                                    @endforeach
                                                </select>
                                                {{-- <label for="floatingInput">Revenue Line/Economic Code</label> --}}
                                            </div>
                                        </div>

                                    </div>




                                    <div class="row">


                                        <div class="col-12" style="text-align: right">
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
        <div class="col-md-6 mb-3"></div>
      <div class="col-md-4">
        <div class="card mb-4">
          <h5 class="card-header">New Revenue Item</h5>
          <div class="card-body">
            <form action="{{ route('post.revenue_line') }}" method="post">
                @csrf
                <div class="fieldset">
                    <h1>Add Economical code</h1>

                    <div class="form-floating mb-3">
                        <select name="type" id="type" class="form-control">
                            <option value="">Select options</option>
                            <option value="1">REVENUE</option>
                            <option value="2">EXPENDITURE</option>
                            <option value="3">ASSET</option>
                            <option value="4">LAIBILITY</option>
                        </select>
                        <label for="floatingInput">Type</label>

                        @error('type')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control  @error('revenue_line') is-invalid @enderror" name="revenue_line" id="floatingInput" placeholder="Revenue Line" value="{{ old('revenue_line')}}" />
                        <label for="floatingInput">Revenue Line</label>
                        <div id="floatingInputHelp" class="form-text">
                          Revenue line in other word revenue name
                        </div>
                        @error('revenue_line')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('revenue_code') is-invalid @enderror" id="floatingInput" name="revenue_code" placeholder="Revenue Line" value="{{ old('revenue_code')}}" />
                        <label for="floatingInput">Revenue Code</label>
                        <div id="floatingInputHelp" class="form-text">
                          Revenue code for the above inputed revenue name
                        </div>
                        @error('revenue_code')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select name="note" id="note" class="form-control">
                            <option value="">Select note</option>
                            @foreach ($notes as  $note)
                              <option value="{{ $note->note_code }}">{{ $note->note_name." ".$note->description }}</option>
                            @endforeach
                        </select>
                        <label for="floatingInput">Note</label>

                        @error('note')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col">
                             <button type="button" data-bs-toggle="modal" data-bs-target="#modalCenter1" class="btn btn-outline-secondary">Upload</button>
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

      <div class="col-md-8">
        <div class="card mb-4">
          <h5 class="card-header">Revenue Line(s)</h5>
          <div class="card-body">
                <table class="table table-stripe">
                    <thead>
                        <tr>
                            <th>NCOA Line</th>
                            <th>NCOA Code </th>
                            <th>NOTE </th>
                            <th>TYPE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($revenue_lines as  $key=>$item)
                            <tr>
                                <td>{{ $item->economic_code }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->note }}</td>
                                <td>
                                    {{
                                        ($item->type == 1 ? 'REVENUE' :
                                        ($item->type == 2 ? 'EXPENDITURE':
                                        ($item->type == 3 ? 'ASSET': 'LIABILITY')))
                                    }}
                                </td>
                                <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('ncoa.codes', ['note'=> $item->note])}}"><i class="bx bx-folder me-1"></i>View items in note</a>
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"data-bs-target="#modalCenter" onclick="update(
                                            '{{ $item->economic_code }}',
                                            '{{ $item->description }}',
                                            '{{ $item->type }}',
                                            '{{ $item->id }}',
                                            '{{ $item->note }}'
                                        )">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="{{ route('delete.revenue_line1',  $item->id) }}" onclick="return confirm('Are you sure you want to delete?')"><i class="bx bx-trash me-1"></i> Delete</a>
                                      </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>



                </table>
                {{ $revenue_lines->links() }}
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
        <form action="{{ route('edit.revenue_line1') }}" method="post">
            @method('PUT')
            <div class="modal-body">
                @csrf
                <div class="fieldset">
                    <h1>Edit Revenue Item</h1>

                    <div class="form-floating mb-3">
                        <select name="type" id="etype" class="form-control">
                            <option value="">Select options</option>
                            <option value="1">REVENUE</option>
                            <option value="2">EXPENDITURE</option>
                            <option value="3">ASSET</option>
                            <option value="4">LAIBILITY</option>
                        </select>
                        <label for="floatingInput">Type</label>

                        @error('type')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control  @error('revenue_line') is-invalid @enderror" name="revenue_line" id="erevenue_line" placeholder="Revenue Line" value="{{ old('revenue_line')}}" />
                        <label for="floatingInput">Revenue Line</label>
                        <div id="floatingInputHelp" class="form-text">
                            Revenue line in other word revenue name
                        </div>
                        @error('revenue_line')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('revenue_code') is-invalid @enderror" id="erevenue_code" name="revenue_code" placeholder="Revenue Line" value="{{ old('revenue_code')}}" />
                        <label for="floatingInput">Revenue Code</label>
                        <div id="floatingInputHelp" class="form-text">
                            Revenue code for the above inputed revenue name
                        </div>
                        @error('revenue_code')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select name="note" id="enote" class="form-control">
                            <option value="">Select note</option>
                            @foreach ($notes as  $note)
                              <option value="{{ $note->note_code }}">{{ $note->note_name." ".$note->description }}</option>
                            @endforeach
                        </select>
                        <label for="floatingInput">Note</label>

                        @error('type')
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
    function update(economic_code, description, type, revenue_id, note) {
        // console.log({economic_code, description, type, revenue_id})
        $('#etype').val(type)
        $('#erevenue_line').val(description)
        $('#erevenue_code').val(economic_code)
        $('#id').val(revenue_id)
        $('#enote').val(note)
    }
  </script>

  @endsection
