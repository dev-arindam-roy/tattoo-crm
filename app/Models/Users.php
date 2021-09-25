<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Users extends Authenticatable
{
	use HasRoles;

    protected $table = 'users';
    protected $primaryKey = "id";

    protected $guard_name = 'web';

    public function totalVouchers() {
    	return $this->hasMany('App\Models\UserPaymentInfo', 'user_id', 'id');
    }

    public function usedVouchers() {
        return $this->hasMany('App\Models\UserPaymentInfo', 'user_id', 'id')
        ->where('useby_user_id', '!=', 0)->where('payment_status', 1)->where('is_deleted', 0);
    }

    public function unusedVouchers() {
        return $this->hasMany('App\Models\UserPaymentInfo', 'user_id', 'id')
        ->where('useby_user_id', 0)->where('payment_status', 1)->where('is_deleted', 0);
    }

    public function allVendorPurchase() {
    	return $this->hasMany('App\Models\StockHistory', 'vendor_id', 'id');
    }

    public function allCustomerSales() {
    	return $this->hasMany('App\Models\StockHistory', 'customer_id', 'id');
    }

    public function allCustomerSalesAmount() {
    	return $this->hasMany('App\Models\Invoices', 'customer_id', 'id');
    }
}
