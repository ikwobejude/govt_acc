@extends('admin_dashboard')
<style>
    .box {
        border: 2px solid black;
        padding: 10px 5px;

    }

    .box p {
        text-transform: unset
    }

    .td {
        border: 1px solid black;
    }
</style>
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Payment Receipt /View/</span> Voucher</h4>

    <div class="row">

      <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">Revenue(s)</h5>
          <div class="card-body">
           <table>
            <tr>
                <td style="border-right: 2px solid black">
                    <img src="{{ asset('logo.png') }}" alt="" style="height: 100px">
                </td>
                <td>
                    <span>
                        Health Record Officers Registration Board of Nigeria <br>
                        <span style="font-size: 7px; margin-top: -60px">Vocher</span> <br>
                        <strong>NATIONAL SECRETERIAT</strong> <br>
                        <small>Address</small> <br>
                        <strong>ZONAL OFFICES:</strong> <br>
                        <span style="font-size: 7px;">OFFICES</span> <br>
                    </span>
                </td>
            </tr>
           </table>

           <table width='100%'>
            <tr >
                <td width='10%'>Deptal No.</td>
                <td width='20%'>
                    <strong>HRB/PIS/02/057</strong>
                </td>
                <td width='40%'>Checked and passed for payment at:</td>
                <td width='30%'>
                    <strong>Abuja</strong>
                </td>
            </tr>
           </table>

           <table width="100%">
            <tr>
                <td width="20px">
                    <div class="box">
                        <p>
                            For cash in payment of advance
                            <br> certified the advance of <br>
                            N <u>_____________________</u> <br>
                            Has been entered <br>
                            Deptal No: <br>
                            Signature: <br>
                            Name
                        </p>
                    </div>
                </td>
                <td>
                    <table style="border: 1px solid black">
                        <tr>
                            <td class="td"></td>
                            <td class="td"></td>
                            <td class="td"></td>
                            <td class="td"></td>
                            <td class="td"></td>
                            <td class="td"></td>
                            <td class="td"></td>
                            <td class="td"></td>
                            <td class="td"></td>
                            <td class="td"></td>
                            <td class="td"></td>
                            <td class="td"></td>
                        </tr>
                        <tr>

                        </tr>
                        <tr>

                        </tr>
                        <tr>

                        </tr>
                        <tr>

                        </tr>
                        <tr>

                        </tr>
                        <tr>

                        </tr>
                        <tr>

                        </tr>
                    </table>
                </td>
                <td></td>
            </tr>
           </table>

          </div>
        </div>
      </div>






    </div>
  </div>


  @endsection
