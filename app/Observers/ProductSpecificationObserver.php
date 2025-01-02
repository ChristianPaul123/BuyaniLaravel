<?php

namespace App\Observers;
use App\Models\ProductSpecification_Log;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductSpecification;

class ProductSpecificationObserver
{
    /**
     * Handle the ProductSpecification "created" event.
     */
    public function created(ProductSpecification $productSpecification): void
    {
        ProductSpecification_Log::create([
            'product_specification_id' => $productSpecification->id,
            'admin_id' => Auth::guard('admin')->id() ?? null,
            'action' => 'created',
            'changes' => null
        ]);
    }

    /**
     * Handle the ProductSpecification "updated" event.
     */
    public function updated(ProductSpecification $productSpecification): void
    {
        $changes = [];
        foreach ($productSpecification->getChanges() as $field => $newValue) {
            if ($field !== 'updated_at') {
                $originalValue = $productSpecification->getOriginal($field);
                $changes[$field] = [
                    'old' => $originalValue,
                    'new' => $newValue
                ];
            }
        }

        if (!empty($changes)) {
            ProductSpecification_Log::create([
                'product_specification_id' => $productSpecification->id,
                'admin_id' => Auth::guard('admin')->id() ?? null,
                'action' => 'updated',
                'changes' => json_encode($changes),
            ]);
        }
    }

    /**
     * Handle the ProductSpecification "deleted" event.
     */
    public function deleted(ProductSpecification $productSpecification): void
    {
        // ProductSpecification_Log::create([
        //     'product_specification_id' => $productSpecification->id,
        //     'admin_id' => Auth::guard('admin')->id() ?? null,
        //     'action' => 'deleted',
        //     'changes' => null
        // ]);
    }

    /**
     * Handle the ProductSpecification "restored" event.
     */
    public function restored(ProductSpecification $productSpecification): void
    {
        //
    }

    /**
     * Handle the ProductSpecification "force deleted" event.
     */
    public function forceDeleted(ProductSpecification $productSpecification): void
    {
        //
    }
}
