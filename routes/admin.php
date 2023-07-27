<?php

use App\Http\Controllers\Admin\Administrator\AdminAdministratorController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Cart\AdminCartController;
use App\Http\Controllers\Admin\Category\AdminCategoryController;
use App\Http\Controllers\Admin\Discount\AdminDiscountController;
use App\Http\Controllers\Admin\EmailResponder\AdminEmailResponderController;
use App\Http\Controllers\Admin\Export\ExportController;
use App\Http\Controllers\Admin\Franchise\AdminFranchiseController;
use App\Http\Controllers\Admin\Home\AdminHomeController;
use App\Http\Controllers\Admin\Invoices\AdminInvoiceController;
use App\Http\Controllers\Admin\Location\AdminAreaPostCodeController;
use App\Http\Controllers\Admin\Location\AdminCityController;
use App\Http\Controllers\Admin\Location\AdminCountryController;
use App\Http\Controllers\Admin\Membership\AdminMembershipController;
use App\Http\Controllers\Admin\Member\AdminMemberController;
use App\Http\Controllers\Admin\Package\AdminPackageController;
use App\Http\Controllers\Admin\Preferences\AdminPreferenceController;
use App\Http\Controllers\Admin\Role\AdminRoleController;
use App\Http\Controllers\Admin\Service\AdminServiceController;
use App\Http\Controllers\Admin\SmsResponder\AdminSmsResponderController;
use App\Http\Controllers\Admin\Tag\AdminTagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "admin" middleware group. Enjoy building your Admin!
|
 */

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [AdminLoginController::class, 'index'])->name('auth.admin.login.showform');
    Route::post('login', [AdminLoginController::class, 'login'])->name('auth.admin.login.process');
    Route::post('login/modal', [AdminLoginController::class, 'login_modal'])->name('auth.login.process.modal');
    Route::get('forgot', [AdminLoginController::class, 'forgot'])->name('auth.forgot.showform');
    Route::get('register', [AdminLoginController::class, 'register'])->name('auth.register.showform');
    Route::post('forgot/password', [AdminLoginController::class, 'forgot_password'])->name('auth.forgot.pass.process');
    Route::get('reset', [AdminLoginController::class, 'reset'])->name('auth.reset.showform');
    Route::get('2fa', [AdminLoginController::class, 'two_factor_auth'])->name('auth.2fa.showform');
    Route::get('thankyou', [AdminLoginController::class, 'thankyou'])->name('auth.thankyou.showform');
    Route::post('reset/password', [AdminLoginController::class, 'reset_password'])->name('auth.reset.pass.process');
    /**
     *
     * Auth Pages Routes
     *
     */
    //Route::get('register', [SelfEmployeeController::class, 'register'])->name('auth.register');
    //Route::get('reset', [SelfEmployeeController::class, 'reset'])->name('auth.reset');
    //Route::get('verify', [SelfEmployeeController::class, 'verify'])->name('auth.verify');
});

/**
 *
 * Admin Dashboard Routes Middleware Validation Auth, isAdmin
 *
 */

Route::group(['middleware' => ['auth:admin']], function () {
    // Route::get('error', function () {
    //     return view('backend.error.500');
    // });
    // Route::fallback(function () {
    //     return view('backend.error.404');
    // });
    // Route::get('export{data?}', function () {
    //     return Excel::download(new UsersExport, 'users.xlsx');
    // });

    // return Excel::download(new UsersExport, 'users.xlsx');
    //    });
    Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.auth.logout');
    Route::get('change-password', [AdminLoginController::class, 'change_password'])->name('admin.auth.change-password');
    Route::post('change-password', [AdminLoginController::class, 'changePasswordProcess'])->name('auth.admin.change-password.process');
    Route::get('profile', [AdminLoginController::class, 'profile'])->name('page.admin.profile');
    Route::get('home', [AdminHomeController::class, 'index'])->name('page.admin');

    Route::get('export{data?}', [ExportController::class, 'export_data'])->name('admin.export');

    /**
     *
     * AdminCustomerSupportController Page
     *
     */
    Route::get('roles', [AdminRoleController::class, 'index'])->name('admin.role');
    Route::get('roles/view/{id?}', [AdminRoleController::class, 'show'])->name('admin.role.detail');

    Route::get('roles/add', [AdminRoleController::class, 'create'])->name('admin.role.add');
    Route::post('roles/store', [AdminRoleController::class, 'store'])->name('admin.role.store');

    Route::get('roles/edit/{id?}', [AdminRoleController::class, 'edit'])->name('admin.role.edit');
    Route::post('roles/update/{id?}', [AdminRoleController::class, 'update'])->name('admin.role.update');

    Route::delete('roles/delete', [AdminRoleController::class, 'delete'])->name('admin.role.delete');

    /**
     *
     * AdminAdministratorController Page
     *
     */
    Route::get('administrators', [AdminAdministratorController::class, 'index'])->name('admin.administrator');
    Route::get('administrators/view/{id?}', [AdminAdministratorController::class, 'show'])->name('admin.administrator.detail');

    Route::get('administrators/add', [AdminAdministratorController::class, 'create'])->name('admin.administrator.add');
    Route::post('administrators/store', [AdminAdministratorController::class, 'store'])->name('admin.administrator.store');

    Route::get('administrators/edit/{id?}', [AdminAdministratorController::class, 'edit'])->name('admin.administrator.edit');
    Route::post('administrators/update/{id?}', [AdminAdministratorController::class, 'update'])->name('admin.administrator.update');

    Route::delete('administrators/delete', [AdminAdministratorController::class, 'delete'])->name('admin.administrator.delete');

    Route::post('administrators/getCountries', [AdminAdministratorController::class, 'getCountries'])->name('admin.administrator.getCountries');
    Route::post('administrators/getCitiesByCountry', [AdminAdministratorController::class, 'getCitiesByCountry'])->name('admin.administrator.getCitiesByCountry');
    Route::post('administrators/getStatesByCountry', [AdminAdministratorController::class, 'getStatesByCountry'])->name('admin.administrator.getState');
    Route::post('administrators/getCitiesByState', [AdminAdministratorController::class, 'getCitiesByState'])->name('admin.administrator.getCity');
    Route::post('administrators/geAreaPostCodes', [AdminAdministratorController::class, 'geAreaPostCodes'])->name('admin.administrator.geAreaPostCodes');

    /**
     *
     * AdminCustomerSupportController Page
     *
     */
    // Route::get('customer-support', [AdminCustomerSupportController::class, 'index'])->name('admin.customer.support');
    // Route::get('customer-support/view/{id?}', [AdminCustomerSupportController::class, 'show'])->name('admin.customer.support.detail');

    // Route::get('customer-support/add', [AdminCustomerSupportController::class, 'create'])->name('admin.customer.support.add');
    // Route::post('customer-support/store', [AdminCustomerSupportController::class, 'store'])->name('admin.customer.support.store');

    // Route::get('customer-support/edit/{id?}', [AdminCustomerSupportController::class, 'edit'])->name('admin.customer.support.edit');
    // Route::post('customer-support/update/{id?}', [AdminCustomerSupportController::class, 'update'])->name('admin.customer.support.update');

    // Route::delete('customer-support/delete', [AdminCustomerSupportController::class, 'delete'])->name('admin.customer.support.delete');

    /**
     *
     * AdminMemberController Page
     *
     */
    Route::get('users', [AdminMemberController::class, 'index'])->name('admin.users');
    Route::get('users/view/{id?}', [AdminMemberController::class, 'show'])->name('admin.users.detail');

    Route::get('users/add', [AdminMemberController::class, 'create'])->name('admin.users.add');
    Route::post('users/store', [AdminMemberController::class, 'store'])->name('admin.users.store');

    Route::get('users/edit/{id?}', [AdminMemberController::class, 'edit'])->name('admin.users.edit');
    Route::post('users/update/{id?}', [AdminMemberController::class, 'update'])->name('admin.users.update');

    Route::delete('users/delete', [AdminMemberController::class, 'delete'])->name('admin.users.delete');

    Route::post('users/getMembersByCountry', [AdminMemberController::class, 'getMembersByCountry'])->name('admin.users.getMembersByCountry');
    Route::post('users/getMemberAddressByID', [AdminMemberController::class, 'getMemberAddressByID'])->name('admin.users.getMemberAddressByID');

    /**
     *
     * AdminEmailResponderController Page
     *
     */
    Route::get('email-responders', [AdminEmailResponderController::class, 'index'])->name('admin.email.responder');
    Route::get('email-responders/view/{id?}', [AdminEmailResponderController::class, 'show'])->name('admin.email.responder.detail');

    Route::get('email-responders/add', [AdminEmailResponderController::class, 'create'])->name('admin.email.responder.add');
    Route::post('email-responders/store', [AdminEmailResponderController::class, 'store'])->name('admin.email.responder.store');

    Route::get('email-responders/edit/{id?}', [AdminEmailResponderController::class, 'edit'])->name('admin.email.responder.edit');
    Route::post('email-responders/update/{id?}', [AdminEmailResponderController::class, 'update'])->name('admin.email.responder.update');

    Route::delete('email-responders/delete', [AdminEmailResponderController::class, 'delete'])->name('admin.email.responder.delete');

    /**
     *
     * AdminSmsResponderController Page
     *
     */
    Route::get('sms-responders', [AdminSmsResponderController::class, 'index'])->name('admin.sms.responder');
    Route::get('sms-responders/view/{id?}', [AdminSmsResponderController::class, 'show'])->name('admin.sms.responder.detail');

    Route::get('sms-responders/add', [AdminSmsResponderController::class, 'create'])->name('admin.sms.responder.add');
    Route::post('sms-responders/store', [AdminSmsResponderController::class, 'store'])->name('admin.sms.responder.store');

    Route::get('sms-responders/edit/{id?}', [AdminSmsResponderController::class, 'edit'])->name('admin.sms.responder.edit');
    Route::post('sms-responders/update/{id?}', [AdminSmsResponderController::class, 'update'])->name('admin.sms.responder.update');

    Route::delete('sms-responders/delete', [AdminSmsResponderController::class, 'delete'])->name('admin.sms.responder.delete');

    /**
     *
     * AdminTagController Page
     *
     */
    Route::get('tags', [AdminTagController::class, 'index'])->name('admin.tags');
    Route::get('tags/view/{id?}', [AdminTagController::class, 'show'])->name('admin.tags.detail');

    Route::get('tags/add', [AdminTagController::class, 'create'])->name('admin.tags.add');
    Route::post('tags/store', [AdminTagController::class, 'store'])->name('admin.tags.store');

    Route::get('tags/edit/{id?}', [AdminTagController::class, 'edit'])->name('admin.tags.edit');
    Route::post('tags/update/{id?}', [AdminTagController::class, 'update'])->name('admin.tags.update');

    Route::delete('tags/delete', [AdminTagController::class, 'delete'])->name('admin.tags.delete');

    /**
     *
     * AdminCategoryController Page
     *
     */
    Route::get('categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
    Route::get('categories/view/{id?}', [AdminCategoryController::class, 'show'])->name('admin.categories.detail');

    Route::get('categories/add', [AdminCategoryController::class, 'create'])->name('admin.categories.add');
    Route::post('categories/store', [AdminCategoryController::class, 'store'])->name('admin.categories.store');

    Route::get('categories/edit/{id?}', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::post('categgetsubcategoryories/update/{id?}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');

    Route::delete('categories/delete', [AdminCategoryController::class, 'delete'])->name('admin.categories.delete');

    Route::post('categories/getSubcategory', [AdminCategoryController::class, 'getSubcategory'])->name('admin.administrator.getSubcategory');

    /**
     *
     * AdminMembershipController Page
     *
     */
    Route::get('memberships', [AdminMembershipController::class, 'index'])->name('admin.memberships');
    Route::get('memberships/view/{id?}', [AdminMembershipController::class, 'show'])->name('admin.memberships.detail');

    Route::get('memberships/add', [AdminMembershipController::class, 'create'])->name('admin.memberships.add');
    Route::post('memberships/store', [AdminMembershipController::class, 'store'])->name('admin.memberships.store');

    Route::get('memberships/edit/{id?}', [AdminMembershipController::class, 'edit'])->name('admin.memberships.edit');
    Route::post('memberships/update/{id?}', [AdminMembershipController::class, 'update'])->name('admin.memberships.update');

    // Route::delete('membership/delete', [AdminMembershipController::class, 'delete'])->name('admin.membership.delete');
    Route::delete('memberships/delete', [AdminMembershipController::class, 'delete'])->name('admin.memberships.delete');

    /**
     *
     * AdminFranchiseController Page
     *
     */
    Route::get('franchises', [AdminFranchiseController::class, 'index'])->name('admin.franchise');
    Route::get('franchises/list', [AdminFranchiseController::class, 'getEmailResponder'])->name('admin.franchise.list');
    Route::get('franchises/view/{id?}', [AdminFranchiseController::class, 'show'])->name('admin.franchise.detail');

    Route::get('franchise/add', [AdminFranchiseController::class, 'create'])->name('admin.franchise.add');
    Route::post('franchise/store', [AdminFranchiseController::class, 'store'])->name('admin.franchise.store');
    Route::post('franchise/getFranchiseByCountry', [AdminFranchiseController::class, 'getFranchiseByCountry'])->name('admin.franchise.getFranchiseByCountry');
    Route::get('franchises/add', [AdminFranchiseController::class, 'create'])->name('admin.franchise.add');

    Route::get('franchises/edit/{id?}', [AdminFranchiseController::class, 'edit'])->name('admin.franchise.edit');
    Route::post('franchises/update/{id?}', [AdminFranchiseController::class, 'update'])->name('admin.franchise.update');

    Route::delete('franchises/delete', [AdminFranchiseController::class, 'delete'])->name('admin.franchise.delete');

    /**
     *
     * AdminServiceController Page
     *
     */
    Route::get('services', [AdminServiceController::class, 'index'])->name('admin.services');
    Route::get('services/view/{id?}', [AdminServiceController::class, 'show'])->name('admin.services.detail');

    Route::get('services/add', [AdminServiceController::class, 'create'])->name('admin.services.add');
    Route::post('services/store', [AdminServiceController::class, 'store'])->name('admin.services.store');

    Route::get('services/edit/{id?}', [AdminServiceController::class, 'edit'])->name('admin.services.edit');
    Route::post('services/update/{id?}', [AdminServiceController::class, 'update'])->name('admin.services.update');

    Route::delete('services/delete', [AdminServiceController::class, 'delete'])->name('admin.services.delete');

    /**
     *
     * AdminDiscountController Page
     *
     */
    Route::get('discounts', [AdminDiscountController::class, 'index'])->name('admin.discounts');
    Route::get('discounts/view/{id?}', [AdminDiscountController::class, 'show'])->name('admin.discounts.detail');

    Route::get('discounts/add', [AdminDiscountController::class, 'create'])->name('admin.discounts.add');
    Route::post('discounts/store', [AdminDiscountController::class, 'store'])->name('admin.discounts.store');

    Route::get('discounts/edit/{id?}', [AdminDiscountController::class, 'edit'])->name('admin.discounts.edit');
    Route::post('discount/update/{id?}', [AdminDiscountController::class, 'update'])->name('admin.discounts.update');

    Route::delete('discounts/delete', [AdminDiscountController::class, 'delete'])->name('admin.discounts.delete');

    /**
     *
     * AdminPackageController Page
     *
     */
    Route::get('packages', [AdminPackageController::class, 'index'])->name('admin.packages');
    Route::get('packages/view/{id?}', [AdminPackageController::class, 'show'])->name('admin.packages.detail');

    Route::get('packages/add', [AdminPackageController::class, 'create'])->name('admin.packages.add');
    Route::post('package/store', [AdminPackageController::class, 'store'])->name('admin.packages.store');

    Route::get('packages/edit/{id?}', [AdminPackageController::class, 'edit'])->name('admin.packages.edit');
    Route::post('package/update/{id?}', [AdminPackageController::class, 'update'])->name('admin.packages.update');

    Route::delete('packages/delete', [AdminPackageController::class, 'delete'])->name('admin.packages.delete');

    /**
     *
     * AdminPreferenceController Page
     *
     */
    Route::get('prefereces', [AdminPreferenceController::class, 'index'])->name('admin.preferences');
    Route::get('prefereces/view/{id?}', [AdminPreferenceController::class, 'show'])->name('admin.preferences.detail');

    Route::get('prefereces/add', [AdminPreferenceController::class, 'create'])->name('admin.preferences.add');
    Route::post('prefereces/store', [AdminPreferenceController::class, 'store'])->name('admin.preferences.store');

    Route::get('prefereces/edit/{id?}', [AdminPreferenceController::class, 'edit'])->name('admin.preferences.edit');
    Route::post('prefereces/update/{id?}', [AdminPreferenceController::class, 'update'])->name('admin.preferences.update');

    Route::delete('prefereces/delete', [AdminPreferenceController::class, 'delete'])->name('admin.preferences.delete');

    /**
     *
     * AdminCountryController Page
     *
     */
    Route::get('countries', [AdminCountryController::class, 'index'])->name('admin.countries');
    Route::get('countries/view/{id?}', [AdminCountryController::class, 'show'])->name('admin.countries.detail');

    Route::get('countries/add', [AdminCountryController::class, 'create'])->name('admin.countries.add');
    Route::post('countries/store', [AdminCountryController::class, 'store'])->name('admin.countries.store');

    Route::get('countries/edit/{id?}', [AdminCountryController::class, 'edit'])->name('admin.countries.edit');
    Route::post('countries/update/{id?}', [AdminCountryController::class, 'update'])->name('admin.countries.update');

    Route::delete('countries/delete', [AdminCountryController::class, 'delete'])->name('admin.countries.delete');

    /**
     *
     * AdminCityController Page
     *
     */
    Route::get('cities', [AdminCityController::class, 'index'])->name('admin.cities');
    Route::get('cities/view/{id?}', [AdminCityController::class, 'show'])->name('admin.cities.detail');

    Route::get('cities/add', [AdminCityController::class, 'create'])->name('admin.cities.add');
    Route::post('cities/store', [AdminCityController::class, 'store'])->name('admin.cities.store');

    Route::get('cities/edit/{id?}', [AdminCityController::class, 'edit'])->name('admin.cities.edit');
    Route::post('cities/update/{id?}', [AdminCityController::class, 'update'])->name('admin.cities.update');

    Route::delete('cities/delete', [AdminCityController::class, 'delete'])->name('admin.cities.delete');

    /**
     *
     * AdminAreaPostCodeController Page
     *
     */
    Route::get('area-post-codes', [AdminAreaPostCodeController::class, 'index'])->name('admin.areaPostCodes');
    Route::get('area-post-codes/view/{id?}', [AdminAreaPostCodeController::class, 'show'])->name('admin.areaPostCodes.detail');

    Route::get('area-post-codes/add', [AdminAreaPostCodeController::class, 'create'])->name('admin.areaPostCodes.add');
    Route::post('area-post-codes/store', [AdminAreaPostCodeController::class, 'store'])->name('admin.areaPostCodes.store');

    Route::get('area-post-codes/edit/{id?}', [AdminAreaPostCodeController::class, 'edit'])->name('admin.areaPostCodes.edit');
    Route::post('area-post-codes/update/{id?}', [AdminAreaPostCodeController::class, 'update'])->name('admin.areaPostCodes.update');

    Route::delete('area-post-codes/delete', [AdminAreaPostCodeController::class, 'delete'])->name('admin.areaPostCodes.delete');
    Route::delete('areaPostCode/delete', [AdminAreaPostCodeController::class, 'delete'])->name('admin.areaPostCode.delete');

    /**
     *
     * AdminInvoiceController Page
     *
     */
    Route::get('invoices', [AdminInvoiceController::class, 'index'])->name('admin.invoices');
    Route::get('invoices/view/{id?}', [AdminInvoiceController::class, 'show'])->name('admin.invoices.detail');

    Route::get('invoices/add', [AdminInvoiceController::class, 'create'])->name('admin.invoices.add');
    Route::post('invoices/store', [AdminInvoiceController::class, 'store'])->name('admin.invoices.store');

    Route::get('invoices/edit/{id?}', [AdminInvoiceController::class, 'edit'])->name('admin.invoices.edit');
    Route::post('invoices/update/{id?}', [AdminInvoiceController::class, 'update'])->name('admin.invoices.update');

    Route::delete('invoices/delete', [AdminInvoiceController::class, 'delete'])->name('admin.invoices.delete');


    /**
     *
     * AdminCartController Page
     *
     */
    Route::get('carts/mails', [AdminCartController::class, 'sendMails'])->name('admin.carts.mails');
    Route::get('carts', [AdminCartController::class, 'index'])->name('admin.carts');
    Route::get('carts/view/{id?}', [AdminCartController::class, 'show'])->name('admin.carts.detail');
    Route::get('invoices/preview/{id?}', [AdminInvoiceController::class, 'preview'])->name('admin.invoices.preview');
});
