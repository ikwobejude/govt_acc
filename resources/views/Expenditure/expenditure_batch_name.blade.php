@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Expenditure Batch Name</h4>

    <div class="row">

      <div class="col-md-6">
        <div class="card mb-4">
          <h5 class="card-header">Expenditure(s)</h5>
          <div class="card-body">
            <form action="{{ route('post.expenditure_batch_name') }}" method="post">
                @csrf
                <div class="fieldset">
                    <h1>Expenditure Batch Name</h1>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control  @error('batch_name') is-invalid @enderror" name="batch_name" id="floatingInput" placeholder="Expenditure Batch Name" value="{{ old('batch_name')}}" />
                        <label for="floatingInput">Expenditure Batch Name</label>
                        <div id="floatingInputHelp" class="form-text"></div>
                        @error('batch_name')
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
          <h5 class="card-header">Expenditure Batch Name</h5>
          <div class="card-body">
                <table class="table table-stripe">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Expenditure Batch Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($batch_names as  $key=>$item)
                            <tr>
                                <td>{{ $key + 1}}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:;" id="exp_name_upd" data-bs-toggle="modal" data-bs-target="#updateModal"  onclick="update(
                                            {{ $item->id }},
                                            '{{ $item->name }}'
                                            )">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="{{ route('delete.expenditure_batch_name',  $item->id)}}" onclick="return confirm('Are you sure you want to delete?')"><i class="bx bx-trash me-1"></i> Delete</a>
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
   <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">UPDATE EXPENDITURE BATCH NAME	</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <form action="{{ route('update.expenditure_batch_name') }}" method="post">
            @csrf
            @method('PUT')
            <div class="modal-body">

                <div class="row g-2">
                  <div class="col mb-0">
                      <input type="hidden" name="id" id="id">
                    <label for="emailWithTitle" class="form-label">Revenue Code</label>
                    <input type="text" class="form-control  @error('batch_name') is-invalid @enderror" name="ebatch_name" id="ebatch_name" placeholder="Expenditure Batch Name" value="{{ old('ebatch_name')}}" />
                              {{-- <label for="floatingInput">Expenditure Batch Name</label> --}}
                      <div id="floatingInputHelp" class="form-text"></div>
                      @error('batch_name')
                      <span class="text-danger"> {{ $message }} </span>
                      @enderror
                  </div>
                </div>
              </div>
              <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
        </form>

      </div>
    </div>
  </div>

  @endsection
<script>

    //   $("#exp_name_upd").on("show.bs.modal", async function (event) {
    //         // var button = $(event.relatedTarget);
    //         var button = $(event.relatedTarget);
    //         var itemId = button.data("id");
    //         alert(itemId)
    //         // $('#cover-spin').show(0)
    //   })

      async function update(id, name) {
        console.log(id)
        $('#ebatch_name').val(name);
        $('#id').val(id)
      }
</script>
