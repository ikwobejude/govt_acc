@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Vendors</h4>

    <div class="row">

      <div class="col-md-12">
        <div class="card mb-4">
          {{-- <h5 class="card-header">Vendors</h5> --}}
          <div class="card-body">
            <form action="{{ route('post.liability') }}" method="post">
                @csrf
                <div class="fieldset">
                    <h1>Add Vendor</h1>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" name="vendor_name" id="vendor_name" value="{{ old('vendor_name')}}" placeholder="Vendor Name" class="form-control @error('vendor_name') is-invalid @enderror" >
                                <label for="floatingInput">Vendor Name</label>
                                <div id="floatingInputHelp" class="form-text"></div>
                                @error('vendor_name')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" name="email" id="email" value="{{ old('email')}}" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" >
                                <label for="floatingInput">Email Address</label>
                                <div id="floatingInputHelp" class="form-text"></div>
                                @error('email')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" name="mobile_phone" id="mobile_phone" value="{{ old('mobile_phone')}}" placeholder="Phone Number" class="form-control @error('mobile_phone') is-invalid @enderror" >
                                <label for="floatingInput">Phone Number</label>
                                <div id="floatingInputHelp" class="form-text"></div>
                                @error('mobile_phone')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="form-floating">
                                <select name="state" id="state" class="form-control @error('state') is-invalid @enderror">
                                    <option value="">Select option</option>
                                    @foreach($states as $st)
                                        <option value="{{ $st->state_id }}">{{ $st->state }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingInput">State </label>

                                @error('economic_code')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" name="address" id="address" value="{{ old('address')}}" placeholder="Liability" class="form-control @error('address') is-invalid @enderror" >
                                <label for="floatingInput">Address</label>
                                <div id="floatingInputHelp" class="form-text"></div>
                                @error('address')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="form-floating">
                                <select name="type_of_liability" id="type_of_liability" class="form-control">
                                    <option value="">Select option</option>
                                    <option value="Current liabilities">Current liabilities</option>
                                    <option value="Non-current liabilities">Non-current liabilities</option>
                                    <option value="Current liabilities">Contingent liabilities</option>
                                </select>
                                <label for="floatingInput">Types of liabilities</label>
                                <div id="floatingInputHelp" class="form-text"> </div>
                                @error('type_of_liability')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="divider divider-primary">
                            <div class="divider-text">Contact Details</div>
                          </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="floatingInput" name="firstname" placeholder="First Name" value="{{ old('firstname')}}" />
                                <label for="floatingInput">First Name</label>
                                @error('contact_lastname')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4 col-sm-5">
                            <div class="form-floating">
                                <input type="text" class="form-control  @error('lastname') is-invalid @enderror" value="{{ old('lastname')}}" id="lastname" name="lastname" placeholder="Last Name" />
                                <label for="floatingInput">Last Name</label>
                                <div id="floatingInputHelp" class="form-text"> </div>
                                @error('lastname')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="contact_phone_no" value="{{ old('contact_phone_no')}}" name="Contact phone" placeholder="contact_phone_no"  />
                                <label for="floatingInput">Contact phone</label>
                                <div id="floatingInputHelp" class="form-text"> </div>
                                @error('contact_phone_no')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4 col-sm-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="contact_email" value="{{ old('contact_email')}}" name="Contact phone" placeholder="contact_email"  />
                                <label for="floatingInput">Contact email</label>
                                <div id="floatingInputHelp" class="form-text"> </div>
                                @error('contact_email')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
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
          <h5 class="card-header">Drafted asset(s)</h5>
          <div class="card-body">
            <div class="table-reponsive">
                <table class="table table-stripe">
                    <thead>
                        <tr>
                            {{-- <th>S/N</th> --}}
                            <th>Economic Line/Code</th>
                            <th>Name</th>
                            <th>Liability Type</th>
                            <th>Authorization Ref</th>
                            <th>Date </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

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



function deleteemprow(h) {
  console.log(h);
  $(`#row${h}`).remove();
}
</script>
  </script>
