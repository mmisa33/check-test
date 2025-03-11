<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;

class Modal extends Component
{
    public $showModal = false;
    public $contactId;
    public $contact;

    // 問い合わせデータ取得
    public function mount($contactId)
    {
        $this->contactId = $contactId;
        $this->contact = Contact::with('category')->find($this->contactId);
    }

    // 問い合わせ削除
    public function deleteContact($id)
    {
        Contact::find($id)->delete();
        $this->showModal = false;
        $this->emit('contactDeleted');
    }

    // モーダル表示
    public function openModal()
    {
        $this->showModal = true;
    }

    // モーダル非表示
    public function closeModal()
    {
        $this->showModal = false;
    }

    // コンポーネントビューをレンダリング
    public function render()
    {
        return view('livewire.modal');
    }
}