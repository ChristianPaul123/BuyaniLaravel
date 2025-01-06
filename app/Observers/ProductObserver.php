<?php

namespace App\Observers;

use App\Models\Product;

use App\Models\ProductLog;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    public function created(Product $product): void
    {
        ProductLog::create([
            'product_id' => $product->id,
            'admin_id' => Auth::guard('admin')->id() ?? null,
            'action' => 'created',
            'changes' => null
        ]);
    }

    public function updated(Product $product): void
    {
        // Determine changed fields
        $changes = [];
        foreach ($product->getChanges() as $field => $newValue) {
            if ($field !== 'updated_at') {
                $originalValue = $product->getOriginal($field);
                $changes[$field] = [
                    'old' => $originalValue,
                    'new' => $newValue,
                ];
            }
        }

        if (!empty($changes)) {
            ProductLog::create([
                'product_id' => $product->id,
                'admin_id' => Auth::guard('admin')->id() ?? null,
                'action' => 'updated',
                'changes' => json_encode($changes)
            ]);
        }
    }

    public function deleted(Product $product): void
    {
        ProductLog::create([
            'product_id' => $product->id,
            'admin_id' => Auth::guard('admin')->id() ?? null,
            'action' => 'deleted',
            'changes' => null
        ]);
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
