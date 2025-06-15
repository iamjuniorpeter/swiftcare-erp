<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function lowStockAlert()
    {
        // Fetch all items with total batch quantity and associated merchant
        $items = Item::withSum('batches', 'quantity')
            //->with('merchant') // Include merchant relationship
            ->get()
            ->filter(function ($item) {
                $availableQty = $item->batches_sum_quantity ?? 0;
                return $availableQty > 0 && $availableQty <= $item->reorder_level;
            });



        foreach ($items as $item) {
            $merchant = $item->merchant;

            //if ($merchant) {
                // Now fetch the user linked to this merchant
                $user = User::with('merchant')
                    ->where('accountID', $item->merchantID)
                    ->first();
                    //dd($user);
                if ($user) {
                     (new MailController)->sendLowAlertsToCustomer($user, $merchant, $item);
                    // $this->sendEmail(
                    //     $user->email,
                    //     $merchant->company_name,
                    //     $item->name,
                    //     $item->batches_sum_quantity ?? 0
                    // );
                }
            //}
        }
    }

}
