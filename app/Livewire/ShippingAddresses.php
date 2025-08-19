<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateAddressForm;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShippingAddresses extends Component
{
    public $addresses;

    public $newAddress = true;

    public CreateAddressForm $createAddress;

    public function mount()
    {
        $this->addresses = Address::where('user_id', Auth::user()->id)->get();
        $this->createAddress->receiver_info = [
            'name' => Auth::user()->name,
            'last_name' => Auth::user()->last_name,
            'document_type' => Auth::user()->document_type,
            'document_number' => Auth::user()->document_number,
            'phone' => Auth::user()->phone,
        ];
    }
    public function render()
    {
        return view('livewire.shipping-addresses');
    }
}
