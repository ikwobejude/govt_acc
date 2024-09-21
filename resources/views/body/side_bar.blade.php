<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="/" class="app-brand-link">
        <span class="app-brand-logo demo">
            <img src="{{ asset('download.png') }}" alt="" style="height: 50px">
        </span>
        {{-- <span class="app-brand-text demo menu-text fw-bold ms-2">Sneat</span> --}}
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboards -->


      <li class="menu-item {{ url()->current() == route('dashboard') ? 'active open' : ''}}">
        <a href="/dashboard" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Boxicons" class="{{ url()->current() == route('dashboard') ? 'active' : ''}}">Dashboards</div>
        </a>
      </li>

      @if (groupId() == 111111)
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">User Management</span>
      </li>
      <li class="menu-item {{ url()->current() == route('view.user') ? 'active open' : ''}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-user"></i>
          <div data-i18n="Account Settings">Manage User</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{url()->current() == route('view.user') ? 'active' : ''}}">
            <a href="{{ route('view.user') }}" class="menu-link">
              <div data-i18n="Account">User</div>
            </a>
          </li>
        </ul>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Settings</span>
      </li>
      <li class="menu-item {{ url()->current() == route('get.notes') ? 'active open' : ''}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Note Setup</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{url()->current() == route('get.notes') ? 'active open' : ''}}">
            <a href="{{ route('get.notes') }}" class="menu-link">
              <div data-i18n="Account">Notes</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item {{ url()->current() == route('get.revenue_line') ? 'active open' : ''}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Revenue Setup</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{url()->current() == route('get.revenue_line') ? 'active open' : ''}}">
            <a href="{{ route('get.revenue_line') }}" class="menu-link">
              <div data-i18n="Account">Revenue</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item {{
         (url()->current() == route('post.expenditure_batch_name') ? 'active open' :
         (url()->current() == route('get.expenditure_line') ? 'active open' : ''))
      }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
          <div data-i18n="Authentications">Expenditure Setup</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{url()->current() == route('get.expenditure_line') ? 'active' : ''}}">
            <a href="{{ route('get.expenditure_line') }}" class="menu-link" >
              <div data-i18n="Basic">Expenditure Lines</div>
            </a>
          </li>
          <li class="menu-item {{url()->current() == route('post.expenditure_batch_name') ? 'active' : ''}}">
            <a href="{{ route('post.expenditure_batch_name') }}" class="menu-link">
              <div data-i18n="Basic">Expenditure Batch Name</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item {{
        (url()->current() == route('asset.type') ? 'active open' :
        (url()->current() == route('asset.size') ? 'active open' :
        (url()->current() == route('asset.categories') ? 'active open' :
        (url()->current() == route('asset.location.post') ? 'active open' :
        (url()->current() == route('asset.sub_type') ? 'active open' :
        (url()->current() == route('get.asset_line') ? 'active open' : '' ))))))
        }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-cube-alt"></i>
          <div data-i18n="Fixed Assets Register">Assets SetUp </div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{url()->current() == route('get.asset_line') ? 'active' : ''}}">
                <a href="{{ route('get.asset_line') }}" class="menu-link">
                  <div data-i18n="Depreciation Rate">Asset Line</div>
                </a>
            </li>
          <li class="menu-item {{url()->current() == route('asset.type') ? 'active' : ''}}">
            <a href="{{ route('asset.type') }}" class="menu-link">
              <div data-i18n="Depreciation Rate">Asset Type</div>
            </a>
          </li>
          <li class="menu-item {{url()->current() == route('asset.sub_type') ? 'active' : ''}}">
            <a href="{{ route('asset.sub_type') }}" class="menu-link">
              <div data-i18n="Depreciation Rate">Asset Sub Type</div>
            </a>
          </li>
          <li class="menu-item {{url()->current() == route('asset.size') ? 'active' : ''}}">
            <a href="{{ route('asset.size') }}" class="menu-link">
              <div data-i18n="Asset Register">Asset Size</div>
            </a>
          </li>
          <li class="menu-item {{url()->current() == route('asset.categories') ? 'active' : ''}}">
            <a href="{{ route('asset.categories') }}" class="menu-link">
              <div data-i18n="Asset Register">Asset Class</div>
            </a>
          </li>
          <li class="menu-item {{url()->current() == route('asset.location.post') ? 'active' : ''}}">
            <a href="{{ route('asset.location.post') }}" class="menu-link">
              <div data-i18n="Asset Register">Asset Location</div>
            </a>
          </li>
        </ul>
      </li>

      <li class="menu-item {{
        (url()->current() == route('get.liability_line') ? 'active open' :
        (url()->current() == route('liability_type.index') ? 'active open' : '' )) }}">
       <a href="javascript:void(0);" class="menu-link menu-toggle">
         <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
         <div data-i18n="Authentications">Liability Setup</div>
       </a>
       <ul class="menu-sub">
         <li class="menu-item {{url()->current() == route('get.liability_line') ? 'active' : ''}}">
           <a href="{{ route('get.liability_line') }}" class="menu-link" >
             <div data-i18n="Basic">Liability Lines</div>
           </a>
         </li>
         <li class="menu-item {{url()->current() == route('liability_type.index') ? 'active' : ''}}">
           <a href="{{ route('liability_type.index') }}" class="menu-link">
             <div data-i18n="Basic">Laibility Type</div>
           </a>
         </li>
       </ul>
     </li>
      @endif

      @if (groupId() == 111111 || groupId() == 3500)
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Chart of Accounts</span>
        </li>
        <!-- Apps -->
        <li class="menu-item {{
            (url()->current() == route('get.revenue') ? 'active open' :
            (url()->current() == route('get.expenditure') ? 'active open' :
            (url()->current() == route('get.asset') ? 'active open' :
            (url()->current() == route('get.liabilities') ? 'active open' :''))))
            }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-dock-top"></i>
            <div data-i18n="Account Settings">Accounts</div>
            </a>
            <ul class="menu-sub">
            <li class="menu-item {{ url()->current() == route('get.revenue') ? 'active' : ''}}">
                <a href="{{ route('get.revenue') }}" class="menu-link">
                <div data-i18n="Account">Revenue Chart of Accounts</div>
                </a>
            </li>
            <li class="menu-item {{ url()->current() == route('get.expenditure') ? 'active' : ''}}">
                <a href="{{ route('get.expenditure') }}" class="menu-link">
                <div data-i18n="Notifications" >Expenditure Chart of Accounts</div>
                </a>
            </li>
            <li class="menu-item {{ url()->current() == route('get.asset') ? 'active' : ''}}">
                <a href="{{ route('get.asset') }}" class="menu-link">
                <div data-i18n="Connections">Assets Chart of Accounts</div>
                </a>
            </li>
            <li class="menu-item {{ url()->current() == route('get.liabilities') ? 'active' : ''}}">
                <a href="{{ route('get.liabilities') }}" class="menu-link">
                <div data-i18n="Connections">Liability Chart of Accounts</div>
                </a>
            </li>
            </ul>
        </li>
        <li class="menu-item {{
            (url()->current() == route('index_budget') ? 'active open' : '')
            }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
            <div data-i18n="Authentications">Budget Management</div>
            </a>
            <ul class="menu-sub">
            <li class="menu-item {{ url()->current() == route('index_budget') ? 'active' : ''}}">
                <a href="{{ route('index_budget')}}" class="menu-link" target="_blank">
                <div data-i18n="Basic">Budgeting</div>
                </a>
            </li>
            {{-- <li class="menu-item">
                <a href="auth-register-basic.html" class="menu-link" target="_blank">
                <div data-i18n="Basic">Budget Report</div>
                </a>
            </li> --}}
            {{--<li class="menu-item">
                <a href="auth-forgot-password-basic.html" class="menu-link" target="_blank">
                <div data-i18n="Basic">Forgot Password</div>
                </a>
            </li> --}}
            </ul>
        </li>
        <li class="menu-item {{
            (url()->current() == route('get.ppeclass') ? 'active open' :
            (url()->current() == route('get.ppe') ? 'active open' :
            (url()->current() == route('get.ppeclass.sub') ? 'active open' : '')))
            }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-cube-alt"></i>
            <div data-i18n="Fixed Assets Register">Fixed Assets Register</div>
            </a>
            <ul class="menu-sub">
            <li class="menu-item {{ url()->current() == route('get.ppeclass') ? 'active' : ''}}">
                <a href="{{ route('get.ppeclass')}}" class="menu-link">
                    <div data-i18n="Depreciation Rate">PPE Classification</div>
                </a>
            </li>
            <li class="menu-item {{ url()->current() == route('get.ppeclass.sub') ? 'active' : ''}}">
                <a href="{{ route('get.ppeclass.sub')}}" class="menu-link">
                <div data-i18n="Depreciation Rate">PPE Classification Type</div>
                </a>
            </li>
            <li class="menu-item {{ url()->current() == route('get.ppe') ? 'active' : ''}}">
                <a href="{{ route('get.ppe') }}" class="menu-link">
                <div data-i18n="Asset Register">Asset Register</div>
                </a>
            </li>
            </ul>

        </li>
      @endif
      {{-- <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
          <div data-i18n="Invoicing">Invoicing</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="#" class="menu-link" target="_blank">
              <div data-i18n="Basic">Vendor Management</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link" target="_blank">
              <div data-i18n="Basic">Invoice Management</div>
            </a>
          </li>
        </ul>
      </li> --}}
      <!-- Components -->


      <!-- Extended components -->
      {{-- <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-copy"></i>
          <div data-i18n="Invoicing">Invoicing</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="#" class="menu-link">
              <div data-i18n="Vendor Management">Vendor Management</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <div data-i18n="Invoice Management">Invoice Management</div>
            </a>
          </li>
        </ul>
      </li> --}}

      {{-- <li class="menu-item">
        <a href="icons-boxicons.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-crown"></i>
          <div data-i18n="Boxicons">Boxicons</div>
        </a>
      </li> --}}

      <!-- Forms & Tables -->
      @if (groupId() == 111111 || groupId() == 3000 || groupId()== 1500)
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Approvals</span></li>
      <!-- Forms -->
      <li class="menu-item {{
       (url()->current() == route('view.approve.revenue') ? 'active open' :
       (url()->current() == route('view.approve.expenditure') ? 'active open' :
       (url()->current() == route('view.approve.asset') ? 'active open' :
       (url()->current() == route('view.approve.budget') ? 'active open' :
       (url()->current() == route('view.approve.liability') ? 'active open' : "")))))
       }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Approvals">Approvals</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ url()->current() == route('view.approve.revenue') ? 'active' : ''}}">
            <a href="{{ route('view.approve.revenue') }}" class="menu-link">
              <div data-i18n="Chart of Accounts">Approve Revenue</div>
            </a>
          </li>
          <li class="menu-item {{ url()->current() == route('view.approve.expenditure') ? 'active' : ''}}">
            <a href="{{ route('view.approve.expenditure') }}" class="menu-link">
              <div data-i18n="Chart of Accounts">Approve Expenditure</div>
            </a>
          </li>

          <li class="menu-item {{ url()->current() == route('view.approve.asset') ? 'active' : ''}}">
            <a href="{{ route('view.approve.asset') }}" class="menu-link">
              <div data-i18n="Chart of Accounts">Approve Asset</div>
            </a>
          </li>
          <li class="menu-item {{ url()->current() == route('view.approve.liability') ? 'active' : ''}}">
            <a href="{{ route('view.approve.liability') }}" class="menu-link">
              <div data-i18n="Chart of Accounts">Approve Liability</div>
            </a>
          </li>
          <li class="menu-item {{ url()->current() == route('view.approve.budget') ? 'active' : ''}}">
            <a href="{{ route('view.approve.budget') }}" class="menu-link">
              <div data-i18n="Budgets">Approve Budgets</div>
            </a>
          </li>

        </ul>
      </li>

      @endif

      @if (groupId() == 111111 || groupId() == 3500 || groupId() == 3000 || groupId()== 1500)
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Transactions</span></li>

      <!-- User interface -->
      <li class="menu-item {{ (url()->current() == route('expenditure.trans') ? 'active open' :
                              (url()->current() == route('revenue.transaction') ? 'active open' : ''))}}">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-box"></i>
          <div data-i18n="Revenue Receipts">Transactions</div>
        </a>
        <ul class="menu-sub">
            {{-- <li class="menu-item {{ url()->current() == route('expenditure') ? 'active' : ''}}">
                <a href="{{ route('expenditure') }}" class="menu-link">
                  <div data-i18n="Payment Voucher">Payment Voucher</div>
                </a>
            </li> --}}


          <li class="menu-item {{ url()->current() == route('revenue.transaction') ? 'active' : ''}}">
            <a href="{{ route('revenue.transaction') }}" class="menu-link">
              <div data-i18n="Journal Voucher">Revenue Receipt</div>
            </a>
          </li>
          <li class="menu-item {{ url()->current() == route('expenditure.trans') ? 'active' : ''}}">
            <a href="{{ route('expenditure.trans') }}" class="menu-link">
              <div data-i18n="Payment Voucher">Payment Receipt</div>
            </a>
          </li>






        </ul>
      </li>

      {{-- <li class="menu-item {{ url()->current() == route('expenditure') ? 'active' : ''}}">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-box"></i>
          <div data-i18n="Revenue Receipts">Payment Voucher</div>
        </a>
        <ul class="menu-sub">

          <li class="menu-item {{ url()->current() == route('expenditure') ? 'active' : ''}}">
            <a href="{{ route('expenditure') }}" class="menu-link">
              <div data-i18n="Payment Voucher">Voucher</div>
            </a>
          </li>


        </ul>
      </li> --}}
      @endif


      @if (groupId() == 111111 || groupId() == 3500 || groupId() == 3000 || groupId()== 1500)
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Cashbook</span></li>

      <!-- User interface -->
      <li class="menu-item {{ (url()->current() == route('cashbook') ? 'active open' :
                              (url()->current() == route('personnel.cashbook') ? 'active open' :
                              (url()->current() == route('capital.cashbook') ? 'active open' :
                              (url()->current() == route('overhead.cashbook') ? 'active open' : ''))))}}">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-box"></i>
          <div data-i18n="Revenue Receipts">Cashbook</div>
        </a>
        <ul class="menu-sub">





          <li class="menu-item {{ url()->current() == route('personnel.cashbook') ? 'active' : ''}}">
            <a href="{{ route('personnel.cashbook') }}" class="menu-link">
              <div data-i18n="Personnel cashbook">Personnel cashbook</div>
            </a>
          </li>
          <li class="menu-item {{ url()->current() == route('capital.cashbook') ? 'active' : ''}}">
            <a href="{{ route('capital.cashbook') }}" class="menu-link">
              <div data-i18n="Capital cashbook">Capital cashbook</div>
            </a>
          </li>

          <li class="menu-item {{ url()->current() == route('overhead.cashbook') ? 'active' : ''}}">
            <a href="{{ route('overhead.cashbook') }}" class="menu-link">
              <div data-i18n="Overhead cashbook">Overhead cashbook</div>
            </a>
          </li>

          <li class="menu-item {{ url()->current() == route('cashbook') ? 'active' : ''}}">
            <a href="{{ route('cashbook') }}" class="menu-link">
              <div data-i18n="Treasury cashbook">Treasury cashbook</div>
            </a>
          </li>




        </ul>
      </li>


      @endif

      @if (groupId() == 111111 || groupId()== 1500 || groupId()== 9000 || groupId()== 9000)
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Final Accounts</span></li>
      <li class="menu-item {{
        (url()->current() == route('view.account_payable') ? 'active open' :
        (url()->current() == route('view.account_receivable') ? 'active open' :
        (url()->current() == route('view.general.ledger') ? 'active open' :'' )))
        }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Final Accounts">General Ledger</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ url()->current() == route('view.general.ledger') ? 'active' : ''}}">
                <a href="{{ route('view.general.ledger') }}" class="menu-link">
                    <div data-i18n="Payment Voucher">General Ledger</div>
                </a>
            </li>
          <li class="menu-item {{ url()->current() == route('view.account_payable') ? 'active' : ''}}">
            <a href="{{ route('view.account_payable') }}" class="menu-link">
              <div data-i18n="Vertical Form">Accounts Payables</div>
            </a>
          </li>
          <li class="menu-item {{ url()->current() == route('view.account_receivable') ? 'active' : ''}}">
            <a href="{{ route('view.account_receivable') }}" class="menu-link">
              <div data-i18n="Horizontal Form">Accounts Receivables</div>
            </a>
          </li>

        </ul>
      </li>
      <li class="menu-item {{ url()->current() == route('view.trial_balcance') ? 'active' : ''}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Final Accounts">Trial Balance</div>
        </a>
        <ul class="menu-sub">

          <li class="menu-item {{ url()->current() == route('view.trial_balcance') ? 'active' : ''}}">
            <a href="{{ route('view.trial_balcance') }}" class="menu-link">
              <div data-i18n="Horizontal Form">Trial Balance</div>
            </a>
          </li>



        </ul>
      </li>

      <li class="menu-item {{
        ( url()->current() == route('financial_position') ? 'active open' :
        ( url()->current() == route('cash_flow') ? 'active open' :
        ( url()->current() == route('financial_performance') ? 'active open' : '')))}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Final Accounts">Reports</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ url()->current() == route('financial_performance') ? 'active' : ''}}">
                <a href="{{ route('financial_performance') }}" class="menu-link">
                    <div data-i18n="Horizontal Form">Statement of Financial Perfomace</div>
                </a>
              </li>
          <li class="menu-item {{ url()->current() == route('financial_position') ? 'active' : ''}}">
            <a href="{{ route('financial_position') }}" class="menu-link">
              <div data-i18n="Horizontal Form">Statement of Financial Position</div>
            </a>
          </li>
          <li class="menu-item {{ url()->current() == route('cash_flow') ? 'active' : ''}}">
            <a href="{{ route('cash_flow') }}" class="menu-link">
              <div data-i18n="Horizontal Form">Financial Cash Flow</div>
            </a>
          </li>


          <li class="menu-item">
            <a href="{{ route('note_financial_disclosure') }}" class="menu-link">
                <div data-i18n="Horizontal Form">Note (disclosure) to the financial statement </div>
            </a>
          </li>
          {{-- <li class="menu-item">
            <a href="#" class="menu-link">
                <div data-i18n="Horizontal Form">Statement of Actual and Budget Comparison</div>
            </a>
          </li> --}}



        </ul>
      </li>

      <li class="menu-item {{ url()->current() == route('report_budget') ? 'active open' : ''}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Final Accounts">Budget Report</div>
        </a>
        <ul class="menu-sub">

          <li class="menu-item {{ url()->current() == route('report_budget') ? 'active' : ''}}">
            <a href="{{ route('report_budget') }}" class="menu-link">
              <div data-i18n="Horizontal Form">Budget Report</div>
            </a>
          </li>



        </ul>
      </li>
    @endif



      <!-- Misc -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
      <li class="menu-item">
        <a
          href="https://wa.me/2347031892984"
          target="_blank"
          class="menu-link">
          <i class="menu-icon tf-icons bx bx-support"></i>
          <div data-i18n="Support">Support</div>
        </a>
      </li>
      <li class="menu-item">
        <a
          href="mailto:ikwobejude@gmail.com"
          target="_blank"
          class="menu-link">
          <i class="menu-icon tf-icons bx bx-file"></i>
          <div data-i18n="Documentation">Documentation</div>
        </a>
      </li>
    </ul>
  </aside>
