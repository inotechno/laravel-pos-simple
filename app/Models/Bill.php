<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'date',
        'total',
        'payment_method',
        'bank_account_id',
        'status',
        'customer_id',
        'image_transfer',
        'staff_id'
    ];

    /**
     * Get the customer that owns the Bill
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the staff that owns the Bill
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staff()
    {
        return $this->belongsTo(staff::class);
    }
    /**
     * Get the bank_account that owns the Bill
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank_account()
    {
        return $this->belongsTo(BankAccount::class);
    }

    /**
     * Get all of the details for the Bill
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany(BillDetail::class);
    }
}
