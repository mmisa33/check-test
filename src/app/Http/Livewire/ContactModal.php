<?php

namespace App\Http\Livewire;

use Livewire\Component;


class ContactModal extends Component
{
    public $showModal = true;

    public function render()
    {
        return view('livewire.contact-modal');
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}
