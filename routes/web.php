<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PPE\PPEController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Ajax\fetchController;
use App\Http\Controllers\Asset\AssetController;
use App\Http\Controllers\PPE\PPECLassController;
use App\Http\Controllers\Vendors\VendorController;
use App\Http\Controllers\Revenue\RevenueController;
use App\Http\Controllers\Budgeting\BudgetController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Settings\AssetSizeController;
use App\Http\Controllers\Settings\AssetTypeController;
use App\Http\Controllers\Liability\LiabilityController;
use App\Http\Controllers\Uploads\RevenueUploadController;
use App\Http\Controllers\Budgeting\BudgetReportController;
use App\Http\Controllers\Expenditure\ExpenditureBatchName;
use App\Http\Controllers\Settings\AssetCategoryController;
use App\Http\Controllers\Settings\AssetLocationController;
use App\Http\Controllers\Approvals\AssetApprovalController;
use App\Http\Controllers\Approvals\BudgetApprovalsController;
use App\Http\Controllers\FinalAccount\TrialBalanceController;
use App\Http\Controllers\Approvals\RevenueApprovalsController;
use App\Http\Controllers\FinalAccount\GeneralLedgerController;
use App\Http\Controllers\Expenditure\ExpenditureTypeController;
use App\Http\Controllers\Approvals\ExpenditureApprovalController;
use App\Http\Controllers\Approvals\ApproveLiabilityController;
use App\Http\Controllers\Expenditure\ExpenditureBatchNameController;
use App\Http\Controllers\Expenditure\ExpenditurePayRegisterController;
use App\Http\Controllers\FinalAccount\FinancialPositionController;
use App\Http\Controllers\FinalAccount\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/dashboard', [HomeController::class, 'Home'])->middleware(['auth', 'verified'])->name('dashboard');


// controlled with middleware so everything is protected
Route::group(['prefix' => 'settings'], function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/revenue_line', [SettingsController::class, 'index'])->name('get.revenue_line');
        Route::post('/revenue_line', [SettingsController::class, 'store'])->name('post.revenue_line');
        Route::put('/revenue_line', [SettingsController::class, 'edit'])->name('edit.revenue_line1');
        Route::get('/delete_revenue_line/{id}', [SettingsController::class, 'destroy'])->name('delete.revenue_line1');
        Route::post('/revenue_line-excel', [RevenueUploadController::class, 'import'])->name('upload.revenue');


        Route::get('/expenditure_line', [SettingsController::class, 'indexExp'])->name('get.expenditure_line');
        Route::get('/asset_line', [SettingsController::class, 'indexAsset'])->name('get.asset_line');
        Route::get('/liability_line', [SettingsController::class, 'indexLiability'])->name('get.liability_line');




        // expenditure type
        Route::get('/expenditure_type', [ExpenditureTypeController::class, 'index'])->name('expenditure_type');
        Route::post('/expenditure_type', [ExpenditureTypeController::class, 'store'])->name('post.expenditure_type');

         // expenditure type
         Route::get('/expenditure_batch_name', [ExpenditureBatchNameController::class, 'index'])->name('expenditure_batch_name');
         Route::post('/expenditure_batch_name', [ExpenditureBatchNameController::class, 'store'])->name('post.expenditure_batch_name');
         Route::get('/delete_expenditure_batch_name/{id}', [ExpenditureBatchNameController::class, 'destroy'])->name('delete.expenditure_batch_name');
         Route::put('/expenditure_batch_name', [ExpenditureBatchNameController::class, 'edit'])->name('update.expenditure_batch_name');


        // asset type
        Route::get('/asset_type', [AssetTypeController::class, 'index'])->name('asset.type');
        Route::post('/asset_type', [AssetTypeController::class, 'store'])->name('asset.type.post');
        Route::put('/asset_type', [AssetTypeController::class, 'edit'])->name('asset.type.edit');
        Route::get('/delete/asset_type', [AssetTypeController::class, 'destroy'])->name('asset.type.delete');

        // asset Size
        Route::get('/asset_size', [AssetSizeController::class, 'index'])->name('asset.size');
        Route::post('/asset_size', [AssetSizeController::class, 'store'])->name('asset.size.post');
        Route::put('/asset_size', [AssetSizeController::class, 'edit'])->name('asset.size.edit');
        Route::post('/delete/asset_size', [AssetSizeController::class, 'destroy'])->name('asset.size.delete');

        // asset Categories
        Route::get('/asset_categories', [AssetCategoryController::class, 'index'])->name('asset.categories');
        Route::post('/asset_categories', [AssetCategoryController::class, 'store'])->name('asset.categories.post');

        // asset Categories
        Route::get('/asset_location', [AssetLocationController::class, 'index'])->name('asset.location');
        Route::post('/asset_location', [AssetLocationController::class, 'store'])->name('asset.location.post');

        // fetch get Location [State, Lga]
        Route::get('/lga/{id}', [fetchController::class, 'localGovernmentArea'])->name('fetch.lga');
        Route::get('/state', [fetchController::class, 'state'])->name('fetch.state');
        Route::get('/economic_lines', [fetchController::class, 'economicLines'])->name('economic_lines');
        // Asset classification type
        Route::get('/asset_classificaton_type', [fetchController::class, 'assetClassificationType'])->name('economic_lines');


        // Route::get('/')

        // asset Location


    });
});


Route::group(['prefix' => 'revenue'], function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [RevenueController::class, 'index'])->name('get.revenue');
        Route::post('/', [RevenueController::class, 'store'])->name('post.revenue');
        Route::put('/', [RevenueController::class, 'update'])->name('put.revenue');
        Route::get('/delete/{id}', [RevenueController::class, 'destroy'])->name('delete_revenue');

        Route::post('/submit', [RevenueController::class, 'finalSubmission'])->name('confirm_submission');
    });
});

// Expenditure pay register
Route::group(['prefix' => 'expenditure'], function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [ExpenditurePayRegisterController::class, 'index'])->name('get.expenditure');
        Route::post('/', [ExpenditurePayRegisterController::class, 'store'])->name('post.expenditure');

        Route::put('/', [ExpenditurePayRegisterController::class, 'update'])->name('put.expenditure');
        Route::get('/delete/{id}', [ExpenditurePayRegisterController::class, 'destroy'])->name('deleted_expenditure');
        Route::post('/submit', [ExpenditurePayRegisterController::class, 'finalize'])->name('finalize_expenditure');

    });
});

// Asset
Route::group(['prefix' => 'asset'], function () {
    Route::middleware(['auth'])->group(function () {
        // Account payable
        Route::get('/', [AssetController::class, 'index'])->name('get.asset');
        Route::post('/', [AssetController::class, 'store'])->name('post.asset');

        Route::put('/', [AssetController::class, 'update'])->name('put.asset');
        Route::get('/delete/{id}', [AssetController::class, 'destroy'])->name('delete_asset');

        Route::post('/submit', [AssetController::class, 'finalize'])->name('finalize_asset');
    });
});


Route::group(['prefix' => 'ppe'], function () {
    Route::middleware(['auth'])->group(function () {
        // Account payable
        Route::get('/_class', [PPECLassController::class, 'index'])->name('get.ppeclass');
        Route::post('/_class', [PPECLassController::class, 'store'])->name('post.ppe.class');

        Route::get('/sub_class', [PPECLassController::class, 'indexSb'])->name('get.ppeclass.sub');
        Route::post('/sub_class', [PPECLassController::class, 'storeSub'])->name('post.ppe.class.sub');


        Route::get('/', [PPEController::class, 'index'])->name('get.ppe');
        Route::post('/', [PPEController::class, 'store'])->name('post.ppe');

        Route::put('/', [PPEController::class, 'update'])->name('put.ppe');
        Route::get('/delete/{id}', [PPEController::class, 'destroy'])->name('delete.ppe');
        Route::post('/submit', [PPEController::class, 'finalization'])->name('finalization_ppe');
    });
});

// Asset
Route::group(['prefix' => 'liability'], function () {
    Route::middleware(['auth'])->group(function () {
        // Account payable
        Route::get('/', [LiabilityController::class, 'index'])->name('get.liabilities');
        Route::post('/', [LiabilityController::class, 'store'])->name('post.liability');

        Route::put('/', [LiabilityController::class, 'update'])->name('put.liability');
        Route::get('/delete/{id}', [LiabilityController::class, 'destroy'])->name('delete.liability');
        Route::post('/submit', [LiabilityController::class, 'finalization'])->name('finalization_liability');
    });
});

// Vouchers
Route::group(['prefix' => 'voucher'], function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [ExpenditurePayRegisterController::class, 'expenditures'])->name('expenditure');
        Route::get('/view/{id}', [ExpenditurePayRegisterController::class, 'expenditureVoucher'])->name('view.voucher');
    });
});

// approvals
Route::group(['prefix' => 'approve'], function () {
    Route::middleware(['auth'])->group(function () {

        // revenue approval
        Route::get('/revenue', [RevenueApprovalsController::class, 'revenueDraft'])->name('view.approve.revenue');
        // Route::get('/view/{id}', [RevenueApprovalsController::class, 'expenditureVoucher'])->name('view.voucher');
        Route::get('/revenue/approval',  [RevenueApprovalsController::class, 'approveRevenue'])->name('approve.revenue');
        Route::get('/revenue/disapproval',  [RevenueApprovalsController::class, 'disApprovedRevenue'])->name('disapprove.revenue');
        Route::post('/revenue/multiple_approval',  [RevenueApprovalsController::class, 'multiple_approvals'])->name('multiple.revenue.approval');

        // expenditure
        Route::get('/expenditure', [ExpenditureApprovalController::class, 'index'])->name('view.approve.expenditure');
        // Route::get('/expenditure/view/{id}', [RevenueApprovalsController::class, 'expenditureVoucher'])->name('view.voucher');
        Route::get('/expenditure/approval',  [ExpenditureApprovalController::class, 'approveExpenditure'])->name('approve.expenditure');
        Route::get('/expenditure/disapproval',  [ExpenditureApprovalController::class, 'disApprovedExpenditure'])->name('disapprove.expenditure');
        Route::post('/expenditure/multiple_approvals',  [ExpenditureApprovalController::class, 'multiple_approval'])->name('multiple.expenditure.approval');

        //asset approval
        Route::get('/asset', [AssetApprovalController::class, 'index'])->name('view.approve.asset');
        Route::get('/asset/approval',  [AssetApprovalController::class, 'approveAsset'])->name('approve.asset');
        Route::get('/asset/disapproval',  [AssetApprovalController::class, 'rejected'])->name('rejected.asset');
        Route::post('/asset/multiple_approval',  [AssetApprovalController::class, 'multiple_approval'])->name('multiple.asset.approval');



        // Budget approval
        Route::get('/budget', [BudgetApprovalsController::class, 'index'])->name('view.approve.budget');
        Route::get('/budget/approval',  [BudgetApprovalsController::class, 'approveAsset'])->name('approve.asset');
        Route::get('/budget/disapproval',  [BudgetApprovalsController::class, 'rejected'])->name('rejected.asset');
        Route::post('/budget/multiple_approval',  [BudgetApprovalsController::class, 'multiple_approval'])->name('multiple.budget.approval');

        Route::get('/liability', [ApproveLiabilityController::class, 'index'])->name('view.approve.liability');
        Route::get('/liability/approval',  [ApproveLiabilityController::class, 'approveLiability'])->name('approve.liability');
        Route::get('/liability/disapproval',  [ApproveLiabilityController::class, 'rejectedLiability'])->name('rejected.liability');
        Route::post('/liability/multiple_approval',  [ApproveLiabilityController::class, 'multiple_approval'])->name('multiple.liability.approval');
    });
});



// GENERAL lEDGER
Route::group(['prefix' => 'general_ledger'], function () {
    Route::middleware(['auth'])->group(function () {
        // Account payable
        Route::get('/account_payable', [GeneralLedgerController::class, 'payable'])->name('view.account_payable');
        Route::get('/account_receivable', [GeneralLedgerController::class, 'accountReceivable'])->name('view.account_receivable');
    });
});

Route::group(['prefix' => 'trial_balance'], function () {
    Route::middleware(['auth'])->group(function () {
        // Account payable
        Route::get('/', [TrialBalanceController::class, 'index'])->name('view.trial_balcance');
        // Route::get('/', [GeneralLedgerController::class, 'accountReceivable'])->name('view.account_receivable');
    });
});

Route::group(['prefix' => 'vendor'], function () {
    Route::middleware(['auth'])->group(function () {
        // Account payable
        Route::get('/', [VendorController::class, 'index'])->name('view.vendor');
        // Route::get('/', [GeneralLedgerController::class, 'accountReceivable'])->name('view.account_receivable');
    });
});

Route::group(['prefix' => 'budget'], function () {
    Route::middleware(['auth'])->group(function () {
        // Account payable
        Route::get('/', [BudgetController::class, 'index'])->name('index_budget');
        Route::post('/', [BudgetController::class, 'store'])->name('store.budget');

        Route::put('/', [BudgetController::class, 'update'])->name('put.budget');
        Route::get('/delete/{id}', [BudgetController::class, 'destroy'])->name('delete_budget');

        Route::post('/submit', [BudgetController::class, 'finalization'])->name('finalize_budget');

        Route::get('/personnel/report', [BudgetReportController::class, 'index'])->name('report_budget');
        Route::get('/overhead/report', [BudgetReportController::class, 'overhead'])->name('overhead_report');
        Route::get('/capital/report', [BudgetReportController::class, 'capital'])->name('capital_report');
    });
});


Route::group(['prefix' => 'user'], function () {
    Route::middleware(['auth'])->group(function () {
        // Account payable
        Route::get('/', [UserController::class, 'index'])->name('view.user');
        Route::post('/', [UserController::class, 'store'])->name('user.store');
        Route::post('/edit', [UserController::class, 'update'])->name('user.edit');
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');

        Route::get('/reset_password', [UserController::class, 'resetPassword'])->name('user_reset_password');
        Route::post('/reset_password', [UserController::class, 'reset_Password'])->name('post.user_reset_password');

        Route::get('/profile', [UserController::class, 'user_profile'])->name('user_profile');
        Route::get('/reset_password2', [UserController::class, 'resetPassword2'])->name('reset_password');


        Route::post('/upload_picture', [UserController::class, 'AdminProfileStore'])->name('upload_picture');
    });
});


Route::group(['prefix' => 'statement_of_financial_position'], function () {
    Route::middleware(['auth'])->group(function () {
        // Account payable
        Route::get('/', [FinancialPositionController::class, 'index'])->name('financial_position');
    });
});

Route::group(['prefix' => 'report'], function () {
    Route::middleware(['auth'])->group(function () {
        // Account payable
        Route::get('/financial_performance', [ReportController::class, 'financialPerformance'])->name('financial_performance');
        Route::get('/cash_flow', [ReportController::class, 'cashFlow'])->name('cash_flow');

    });
});

// Router:

