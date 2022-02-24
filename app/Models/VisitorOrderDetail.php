<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorOrderDetail extends Model
{
    use HasFactory;

    public function event_item() {
        return $this->belongsTo('App\Models\Event', 'event');
    }
    public function digital_product_item() {
        return $this->belongsTo('App\Models\DigitalProduct', 'digital_product');
    }
    public function physical_product_item() {
        return $this->belongsTo('App\Models\PhysicalProduct', 'physical_product');
    }
    public function support_item() {
        return $this->belongsTo('App\Models\Support', 'support');
    }
}
