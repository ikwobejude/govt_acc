@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin /</span> user</h4>

    <div class="row">
        <div class="col-md-8">
          <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('user_profile') }}"><i class="bx bx-user me-1"></i> Account</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('reset_password') }}"
                ><i class="bx bx-lock me-1"></i> Reset Password</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:;"
                ><i class="bx bx-link-alt me-1"></i> Connections</a
              >
            </li>
          </ul>
          <div class="card mb-4">
            <h5 class="card-header">Profile Details</h5>
            <!-- Account -->
            <div class="card-body">
              <div class="d-flex align-items-start align-items-sm-center gap-4">

                <img src="{{ asset('/assets/img/avatars/1.png') }}" alt="user-avatar" class="d-block rounded" id="img" height="100" width="100" id="uploadedAvatar" />
                <form action="{{ route('upload_picture') }}" method="post">
                    @csrf
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                          <span class="d-none d-sm-block">Upload new photo</span>
                          <i class="bx bx-upload d-block d-sm-none"></i>
                          <input type="file" id="upload" name="upload" class="account-file-input" onchange="readURL(this);" hidden accept="image/png, image/jpeg" />
                        </label>
                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                          <i class="bx bx-reset d-block d-sm-none"></i>
                          <span class="d-none d-sm-block">Reset</span>
                        </button>
                        <button type="submit" class="btn btn-outline-primary account-image-reset mb-4">Submit</button>
                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                    </div>
                </form>

              </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
              <form id="formAccountSettings" method="POST" onsubmit="return false">
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Fullname</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ name() }}" autofocus />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="phoneNumber">Phone Number</label>
                    <div class="input-group input-group-merge">
                      <span class="input-group-text">NGN (+234)</span>
                      <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" value="{{ phone() }}" placeholder="202 555 0111" />
                    </div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input class="form-control" type="text" id="email" name="email" value="{{ emailAddress() }}" placeholder="john.doe@example.com" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="floatingInput">User Role</label>
                    <select name="user_role" id="user_role" class="form-control sel">
                        <option value="">Select option</option>
                        @foreach ($groupId as $role)
                            <option value="{{ $role->group_id  }}" {{ groupId() == $role->group_id ? 'selected': ''}}>
                                {{ $role->group_name }}
                            </option>
                        @endforeach
                    </select>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ address () }}" placeholder="Address" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="state" class="form-label">State</label>
                    <input class="form-control" type="text" id="state" name="state" value="{{ state() }}" placeholder="Abuja FCT" />
                  </div>


                </div>
                <div class="mt-2">
                  <button type="submit" class="btn btn-primary me-2">Save changes</button>
                  <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                </div>
              </form>
            </div>
            <!-- /Account -->
          </div>
          <div class="card">
            <h5 class="card-header">Delete Account</h5>
            <div class="card-body">
              <div class="mb-3 col-12 mb-0">
                <div class="alert alert-warning">
                  <h6 class="alert-heading mb-1">Are you sure you want to delete your account?</h6>
                  <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                </div>
              </div>
              <form id="formAccountDeactivation" onsubmit="return false">
                <div class="form-check mb-3">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    name="accountActivation"
                    id="accountActivation" />
                  <label class="form-check-label" for="accountActivation"
                    >I confirm my account deactivation</label
                  >
                </div>
                <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>





   <!-- Modal -->





      @endsection
  <script>

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#img').attr('src', e.target.result).width(150).height(200);
    };

    reader.readAsDataURL(input.files[0]);
  }
}


function update(name, email, group_id, phone, username, id) {

    // console.log()

    // document.getElementById('e_user_role').value = group_id
    $('#e_user_role').val(group_id)
    // $('#e_username').val(username)
    $('#e_fullname').val(name)
    $('#e_email').val(email)
    $('#e_phone_number').val(phone)
    $('#id').val(id)

    let myModal = new bootstrap.Modal(document.getElementById('edit'), {});
    myModal.show();
}


$('#editUser').on('submit', async function(e) {
    e.preventDefault();
    console.log("Hello")
})


// const formF = document.getElementById('editUser');
// // async function submitUpdate
// document.querySelector('#editUser').on('submit', async function(e) {
//     e.preventDeafult();
//     console.log("Hello Pro")
//     const data = new FormData(formF);

//     // let payload = {
//     //     user_role: data.get("user_role")
//     //     username: data.get("username")
//     //     fullname: data.get("fullname")
//     //     email: data.get("email")
//     //     phone_number: data.get("phone_number")
//     // }
//     // console.log(payload)
// })



</script>
  </script>
