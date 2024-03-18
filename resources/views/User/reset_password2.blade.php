@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin /</span> user</h4>

    <div class="row">
        <div class="col-md-7">
          <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('user_profile') }}"><i class="bx bx-user me-1"></i> Account</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('reset_password') }}"
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

            </div>
            <hr class="my-0" />
            <div class="card-body">
              <form id="formAccountSettings" method="POST" onsubmit="return false">
                <div class="row">
                  <div class="mb-3 col-md-12">
                    <label for="firstName" class="form-label">Old password</label>
                    <input class="form-control" type="password" id="old_password" name="old_password"  autofocus />
                  </div>
                  <div class="mb-3 col-md-12">
                    <label for="lastName" class="form-label">New Password</label>
                    <input class="form-control" type="password" name="new_passwors" id="new_passwors" />
                  </div>
                  <div class="mb-3 col-md-12">
                    <label for="email" class="form-label">Confirm New Password</label>
                    <input class="form-control" type="password" id="confirm_password" name="confirm_password"   />
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

        </div>
      </div>
  </div>





   <!-- Modal -->





      @endsection
  <script>


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
