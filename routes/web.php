<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InventoryReportController;
use App\Http\Controllers\ModelController\CategoryController;
use App\Http\Controllers\ModelController\SubCategoryController;
use App\Http\Controllers\ModelController\CustomerController;
use App\Http\Controllers\ModelController\InventoryController;
use App\Http\Controllers\ModelController\ItemController;
use App\Http\Controllers\ModelController\PurchaseOrderController;
use App\Http\Controllers\ModelController\PurchaseOrderItemController;
use App\Http\Controllers\ModelController\SalesOrderController;
use App\Http\Controllers\ModelController\SalesOrderItemController;
use App\Http\Controllers\ModelController\SupplierController;
use App\Http\Controllers\ModelController\TransactionLogController;
use App\Http\Controllers\ModelController\UnitController;
use App\Http\Controllers\ModelController\WarehouseController;
use App\Http\Controllers\ModelController\InvoiceController;
use App\Http\Controllers\ModelController\ItemBatchController;
use App\Http\Controllers\ReportController;

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


//login
Route::get('/', [LoginController::class, 'index'])->name('login');
//Route::get('/', [LoginController::class, 'index'])->name('home');

// show password recovery page
Route::get('/password-recovery', [LoginController::class, 'passwordrecovery'])->name('password-recovery');

// reset password
Route::post('/reset-password', [LoginController::class, 'resetpassword'])->name('reset-password');

// handle login request
Route::post('/users/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

// handle logout request
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// load 404 page
Route::get('/error/404', [LoginController::class, 'errorPage'])->name('error404');




/**Auth related routes**/
Route::middleware(['auth'])->group(function () {
    //handle dashboard request
    //Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');

    Route::get('/dashboard', [LoginController::class, 'myDashboard'])->name('dashboard');
    Route::get('/book-appointment', [LoginController::class, 'myAppointment'])->name('book-appointment');
    Route::get('/wallet', [LoginController::class, 'myWallet'])->name('wallet');
    Route::get('/transaction/register', [LoginController::class, 'addTransaction'])->name('transaction.register');
    Route::get('/transaction/update/ref/{transaction_id}', [LoginController::class, 'editTransaction'])->name('transaction.edit');
    Route::get('/transaction/view/{status}', [LoginController::class, 'viewTransaction'])->name('transaction.view');
    Route::post('/transaction/save', [LoginController::class, 'saveTransaction'])->name('transaction.post');
    Route::post('/transaction/filter', [LoginController::class, 'filterTransaction'])->name('transaction.filter');
    Route::post('/transaction/update/status/{transaction_id}/{status}', [LoginController::class, 'updateTransactionStatus'])->name('transaction.status.update');
    Route::post('/transaction/update-bulk/status/{status}', [LoginController::class, 'updateBulkTransactionStatus'])->name('transaction.status.update.bulk');
    Route::get('/customer/register', [LoginController::class, 'addCustomer'])->name('customer.register');
    Route::get('/customer/view/{status}', [LoginController::class, 'viewCustomer'])->name('customer.view');
    Route::post('/customer/save', [LoginController::class, 'saveCustomer'])->name('customer.post');
    Route::get('/customer/update/{customer_id}', [LoginController::class, 'editCustomer'])->name('customer.edit');
    Route::post('/customer/update/status/{customer_id}/{status}', [LoginController::class, 'updateCustomerStatus'])->name('customer.status.update');
    Route::post('/customer/update-bulk/status/{status}', [LoginController::class, 'updateBulkCustomerStatus'])->name('customer.status.update.bulk');
    Route::get('/customer/savings-plan/get/{customer_id}', [LoginController::class, 'getCustomerSavingsPlan'])->name('customer.savings-plan');
    Route::get('/loan/register', [LoginController::class, 'myDashboard'])->name('loan.register');
    Route::get('/loan/view/{status}', [LoginController::class, 'myDashboard'])->name('loan.view');

    //Route::group(['prefix' => 'inventory', 'as' => 'inventory.'], function () {

    // Categories
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Sub Categories
    Route::get('sub-categories', [SubCategoryController::class, 'index'])->name('sub-categories.index');
    Route::get('/get-sub-categories/{category_id}', [SubCategoryController::class, 'getByCategory'])->name('sub-categories.by-category');
    Route::get('sub-categories/create', [SubCategoryController::class, 'create'])->name('sub-categories.create');
    Route::post('sub-categories', [SubCategoryController::class, 'store'])->name('sub-categories.store');
    Route::get('sub-categories/{category}', [SubCategoryController::class, 'show'])->name('sub-categories.show');
    Route::get('sub-categories/{category}/edit', [SubCategoryController::class, 'edit'])->name('sub-categories.edit');
    Route::put('sub-categories/{category}', [SubCategoryController::class, 'update'])->name('sub-categories.update');
    Route::delete('sub-categories/{category}', [SubCategoryController::class, 'destroy'])->name('sub-categories.destroy');

    // Customers
    Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    // Inventory
    Route::get('inventory/dashboard', [LoginController::class, 'InventoryDashboard'])->name('inventory.dashboard');
    Route::get('inventory', [LoginController::class, 'InventoryIndex'])->name('inventory.index');
    Route::get('inventory/create', [LoginController::class, 'InventoryCreate'])->name('inventory.create');
    Route::post('inventory', [LoginController::class, 'InventoryStore'])->name('inventory.store');
    Route::get('inventory/{inventory}', [LoginController::class, 'InventoryShow'])->name('inventory.show');
    Route::get('inventory/{inventory}/edit', [LoginController::class, 'InventoryEdit'])->name('inventory.edit');
    Route::put('inventory/{inventory}', [LoginController::class, 'InventoryUpdate'])->name('inventory.update');
    Route::delete('inventory/{inventory}', [LoginController::class, 'InventoryDestroy'])->name('inventory.destroy');

    // Items
    //bulk upload
    Route::get('items/bulk-upload', [ItemController::class, 'showBulkUpload'])->name('items.bulk_upload');
    Route::post('items/bulk-upload', [ItemController::class, 'processBulkUpload'])->name('items.bulk_upload.store');
    Route::get('items/bulk-upload-template', [ItemController::class, 'downloadBulkUploadTemplate'])->name('items.bulk_upload.template');

    Route::get('items', [ItemController::class, 'ItemIndex'])->name('items.index');
    Route::get('items/create', [ItemController::class, 'ItemCreate'])->name('items.create');
    Route::post('items', [ItemController::class, 'ItemStore'])->name('items.store');
    Route::get('items/{item}', [ItemController::class, 'ItemShow'])->name('items.show');
    Route::get('items/{item}/edit', [ItemController::class, 'ItemEdit'])->name('items.edit');
    Route::put('items/{item}', [ItemController::class, 'ItemUpdate'])->name('items.update');
    Route::delete('items/{item}', [ItemController::class, 'ItemDestroy'])->name('items.destroy');


    // Purchase Orders
    Route::get('purchase-orders', [PurchaseOrderController::class, 'index'])->name('purchase_orders.index');
    Route::get('purchase-orders/create', [PurchaseOrderController::class, 'create'])->name('purchase_orders.create');
    Route::post('purchase-orders', [PurchaseOrderController::class, 'store'])->name('purchase_orders.store');
    Route::get('purchase-orders/{purchase_order}', [PurchaseOrderController::class, 'show'])->name('purchase_orders.show');
    Route::get('purchase-orders/{purchase_order}/edit', [PurchaseOrderController::class, 'edit'])->name('purchase_orders.edit');
    Route::put('purchase-orders/{purchase_order}', [PurchaseOrderController::class, 'update'])->name('purchase_orders.update');
    Route::delete('purchase-orders/{purchase_order}', [PurchaseOrderController::class, 'destroy'])->name('purchase_orders.destroy');

    // Purchase Order Items
    Route::get('purchase-order-items', [PurchaseOrderItemController::class, 'index'])->name('purchase_order_items.index');
    Route::get('purchase-order-items/create/{purchase_order}', [PurchaseOrderItemController::class, 'create'])->name('purchase_order_items.create');
    Route::post('purchase-order-items', [PurchaseOrderItemController::class, 'store'])->name('purchase_order_items.store');
    Route::get('purchase-order-items/{purchase_order_item}', [PurchaseOrderItemController::class, 'show'])->name('purchase_order_items.show');
    Route::get('purchase-order-items/{purchase_order_item}/edit', [PurchaseOrderItemController::class, 'edit'])->name('purchase_order_items.edit');
    Route::put('purchase-order-items/{purchase_order_item}', [PurchaseOrderItemController::class, 'update'])->name('purchase_order_items.update');
    Route::delete('purchase-order-items/{purchase_order_item}', [PurchaseOrderItemController::class, 'destroy'])->name('purchase_order_items.destroy');

    // Sales Orders
    Route::get('sales-orders', [SalesOrderController::class, 'index'])->name('sales_orders.index');
    Route::get('sales-orders/create', [SalesOrderController::class, 'create'])->name('sales_orders.create');
    Route::post('sales-orders', [SalesOrderController::class, 'store'])->name('sales_orders.store');
    Route::get('sales-orders/{sales_order}', [SalesOrderController::class, 'show'])->name('sales_orders.show');
    Route::get('sales-orders/{sales_order}/edit', [SalesOrderController::class, 'edit'])->name('sales_orders.edit');
    Route::put('sales-orders/{sales_order}', [SalesOrderController::class, 'update'])->name('sales_orders.update');
    Route::delete('sales-orders/{sales_order}', [SalesOrderController::class, 'destroy'])->name('sales_orders.destroy');

    // Sales Order Items
    Route::get('sales-order-items', [SalesOrderItemController::class, 'index'])->name('sales_order_items.index');
    Route::get('sales-order-items/create', [SalesOrderItemController::class, 'create'])->name('sales_order_items.create');
    Route::post('sales-order-items', [SalesOrderItemController::class, 'store'])->name('sales_order_items.store');
    Route::get('sales-order-items/{sales_order_item}', [SalesOrderItemController::class, 'show'])->name('sales_order_items.show');
    Route::get('sales-order-items/{sales_order_item}/edit', [SalesOrderItemController::class, 'edit'])->name('sales_order_items.edit');
    Route::put('sales-order-items/{sales_order_item}', [SalesOrderItemController::class, 'update'])->name('sales_order_items.update');
    Route::delete('sales-order-items/{sales_order_item}', [SalesOrderItemController::class, 'destroy'])->name('sales_order_items.destroy');

    // Suppliers
    Route::get('suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('suppliers/{supplier}', [SupplierController::class, 'show'])->name('suppliers.show');
    Route::get('suppliers/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('suppliers/{supplier_id}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

    // Transaction Logs
    Route::get('transaction-logs', [TransactionLogController::class, 'index'])->name('transaction_logs.index');
    Route::get('transaction-logs/create', [TransactionLogController::class, 'create'])->name('transaction_logs.create');
    Route::post('transaction-logs', [TransactionLogController::class, 'store'])->name('transaction_logs.store');
    Route::get('transaction-logs/{transaction_log}', [TransactionLogController::class, 'show'])->name('transaction_logs.show');
    Route::get('transaction-logs/{transaction_log}/edit', [TransactionLogController::class, 'edit'])->name('transaction_logs.edit');
    Route::put('transaction-logs/{transaction_log}', [TransactionLogController::class, 'update'])->name('transaction_logs.update');
    Route::delete('transaction-logs/{transaction_log}', [TransactionLogController::class, 'destroy'])->name('transaction_logs.destroy');

    // Units
    Route::get('units', [UnitController::class, 'index'])->name('units.index');
    Route::get('units/create', [UnitController::class, 'create'])->name('units.create');
    Route::post('units', [UnitController::class, 'store'])->name('units.store');
    Route::get('units/{unit}', [UnitController::class, 'show'])->name('units.show');
    Route::get('units/{unit}/edit', [UnitController::class, 'edit'])->name('units.edit');
    Route::put('units/{unit}', [UnitController::class, 'update'])->name('units.update');
    Route::delete('units/{unit}', [UnitController::class, 'destroy'])->name('units.destroy');

    // Warehouses
    Route::get('warehouses', [WarehouseController::class, 'index'])->name('warehouses.index');
    Route::get('warehouses/create', [WarehouseController::class, 'create'])->name('warehouses.create');
    Route::post('warehouses', [WarehouseController::class, 'store'])->name('warehouses.store');
    Route::get('warehouses/{warehouse}', [WarehouseController::class, 'show'])->name('warehouses.show');
    Route::get('warehouses/{warehouse}/edit', [WarehouseController::class, 'edit'])->name('warehouses.edit');
    Route::put('warehouses/{warehouse}', [WarehouseController::class, 'update'])->name('warehouses.update');
    Route::delete('warehouses/{warehouse}', [WarehouseController::class, 'destroy'])->name('warehouses.destroy');
    //types
    Route::post('warehouse/type', [WarehouseController::class, 'storeType'])->name('warehouse-type.store');

    // Invoices
    Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::get('invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
    Route::put('invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');

    // Item Batches
    Route::get('item-batches', [ItemBatchController::class, 'index'])->name('item_batches.index');
    Route::get('item-batches/create/{item}', [ItemBatchController::class, 'create'])->name('item_batches.create');
    Route::post('item-batches', [ItemBatchController::class, 'store'])->name('item_batches.store');
    Route::get('item-batches/{item_batch}', [ItemBatchController::class, 'show'])->name('item_batches.show');
    Route::get('item-batches/{item_batch}/edit', [ItemBatchController::class, 'edit'])->name('item_batches.edit');
    Route::put('item-batches/{item_batch}', [ItemBatchController::class, 'update'])->name('item_batches.update');
    Route::delete('item-batches/{item_batch}', [ItemBatchController::class, 'destroy'])->name('item_batches.destroy');
    //});

    //reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('reports/download', [ReportController::class, 'download'])->name('reports.download');
    Route::get('/inventory/reports', [InventoryReportController::class, 'index'])->name('inventory.reports.index');
    Route::post('/inventory/reports/export', [InventoryReportController::class, 'export'])->name('inventory.reports.export');
    Route::get('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');

    //handle notification request
    Route::get('/notification', [NotificationController::class, 'index'])->name('notification');
});


/*
*   staff routes
*/
Route::prefix('staff')->middleware(['role:admin agent manager'])->group(function () {
    //dashboard
    //Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('staff-dashboard');
});
