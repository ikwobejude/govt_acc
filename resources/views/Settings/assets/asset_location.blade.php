@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Asset Categories</h4>

    <div class="row">

      <div class="col-md-6">
        <div class="card mb-4">
          <h5 class="card-header">New Asset Location</h5>
          <div class="card-body">
            <form action="{{ route('asset.categories.post') }}" method="post">
                @csrf
                <div class="fieldset">
                    <h1>Asset Location</h1>
                    <div class="form-floating mb-3">
                        <select name="state" id="state2" class="form-control">
                            <option value="">Select option</option>
                            @foreach($state as $st)
                                <option value="{{ $st->state_id }}">{{ $st->state }}</option>
                            @endforeach
                        </select>
                        <label for="floatingInput">State</label>
                        <div id="stateWait" class="form-text"></div>
                        @error('assest_category')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select name="lga" id="lga" class="form-control">
                            <option value="">Select option</option>
                        </select>
                        <label for="floatingInput">Local Govt. Area</label>

                        @error('assest_category')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control @error('assest_category_description') is-invalid @enderror" id="floatingInput" name="assest_category_description" placeholder="Description" value="{{ old('assest_category_description')}}" />
                        <label for="floatingInput">Address</label>
                        <div id="floatingInputHelp" class="form-text"></div>
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
          <h5 class="card-header">Asset Location</h5>
          <div class="card-body">
                <table class="table table-stripe">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Asset Categories</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asset_location as  $key=>$item)
                            <tr>
                                <td>{{ $key + 1}}</td>
                                <td>{{ $item->assest_category }}</td>
                                <td>{{ $item->assest_category_description }}</td>
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
<script>
   document.getElementById("state2").onchange = async() => {
        // const stateID = document.getElementById('state').value;

        console.log("ho")
        // const lgawait = document.getElementById('stateWait');

        // const.log(stateID)
        // return
        // lgawait.textContent = '';
        // lgawait.textContent = 'Fetching Local Governments Areas...';
        // try {
        //     const res = await fetch('/settings/lga/'+stateID);
        //     const data = await res.json();

        //     if (data.status == "error") {
        //         lgawait.style = "color:red";
        //         lgawait.textContent = data.data;
        //     } else {
        //         lgawait.textContent = ' ';
        //         populateLgas(data.data)
        //     }
        // } catch (error) {
        //     lgawait.style = "color:red";
        //     lgawait.textContent = error.message;
        // }

    })

    function populateLgas(data) {
        if (data.length > 0) {
            var html = "";
            html += "<option disabled selected value> SELECT LGA</option>";
            for (var a = 0; a < data.length; a++) {
                html +=
                    '<option value="' + data[a].lga + ' ">' + data[a].lga + "</option>";
            }
            $("#LGA").html(html);
        } else {
            var html = "";
            html += "<option disabled selected value> NO LGA FOUND </option>";
            $("#LGA").html(html);
        }
    }

</script>
