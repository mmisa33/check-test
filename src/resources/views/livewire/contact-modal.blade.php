<!-- resources/views/livewire/contact-modal.blade.php -->
<div>
    @if($showModal)
    <!-- モーダルコンテンツ -->
    <div class="modal">
        <p>モーダルの中身です。</p>
        <button wire:click="closeModal">Close</button>
    </div>
    @endif
</div>

<!-- Livewire のスタイルとスクリプトを追加 -->
@livewireStyles
@livewireScripts