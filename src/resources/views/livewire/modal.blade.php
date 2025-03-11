<div>
    {{--  詳細ボタン: クリックするとモーダルを開く  --}}
    <button class="open-button" wire:click="openModal({{ optional($contact)->id }})">詳細</button>

    @if($showModal)
    {{--  モーダルのオーバーレイ（背景）  --}}
    <div class="modal-overlay"></div>

    {{--  モーダルコンテンツ  --}}
    <div class="modal-content">
        {{--  閉じるボタン: クリックするとモーダルを閉じる  --}}
        <button class="close-button" wire:click="closeModal"></button>

        {{--  問い合わせ詳細テーブル  --}}
        <div class="modal-content__group">
            <table class="detail-table">
                {{--  名前  --}}
                <tr class="detail-table__row">
                    <th class="detail-table__header">お名前</th>
                    <td class="detail-table__text">{{ $contact->last_name }}&emsp;{{ $contact->first_name }}</td>
                </tr>

                {{--  性別  --}}
                <tr class="detail-table__row">
                    <th class="detail-table__header">性別</th>
                    <td class="detail-table__text">{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
                </tr>

                {{--  メールアドレス  --}}
                <tr class="detail-table__row">
                    <th class="detail-table__header">メールアドレス</th>
                    <td class="detail-table__text">{{ $contact->email }}</td>
                </tr>

                {{--  電話番号  --}}
                <tr class="detail-table__row">
                    <th class="detail-table__header">電話番号</th>
                    <td class="detail-table__text">{{ $contact->tel_area }}{{ $contact->tel_number }}{{ $contact->tel_end }}</td>
                </tr>

                {{--  住所  --}}
                <tr class="detail-table__row">
                    <th class="detail-table__header">住所</th>
                    <td class="detail-table__text">{{ $contact->address }}</td>
                </tr>

                {{--  建物名  --}}
                <tr class="detail-table__row">
                    <th class="detail-table__header">建物名</th>
                    <td class="detail-table__text">{{ $contact->building }}</td>
                </tr>

                {{--  問い合わせ種類  --}}
                <tr class="detail-table__row">
                    <th class="detail-table__header">お問い合わせの種類</th>
                    <td class="detail-table__text">{{ $contact->category->content }}</td>
                </tr>

                {{--  問い合わせ内容  --}}
                <tr class="detail-table__row">
                    <th class="detail-table__header">お問い合わせ内容</th>
                    <td class="detail-table__text">{{ $contact->detail }}</td>
                </tr>
            </table>

            {{--  問い合わせ削除ボタン  --}}
            <button class="delete-button" wire:click="deleteContact({{ $contact->id }})">削除</button>
        </div>
    </div>
    @endif
</div>

<style>
 /* オーバーレイ */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1000;
}

/* モーダル全体 */
.modal-content {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 40%;
    height: 90%;
    padding: 40px;
    background-color: white;
    border: 1px solid #8B7969;
    box-shadow: 4px 4px 4px 0px #8B796940;
    z-index: 1001;
}

/* モーダル開くボタン */
.open-button {
    margin-right: 40px;
    width: 75px;
    height: 40px;
    background: #F4F4F44D;
    border: 1px solid #D9C6B5;
    font-size: 18px;
    color: #D9C6B5;
    cursor: pointer;
}

/* モーダル閉じるボタン */
.close-button {
    position: relative;
    margin: 0 0 0 auto;
    width: 40px;
    height: 40px;
    border: 1px solid #8B7969;
    border-radius: 50%;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 30px;
    color: #8B7969;
    cursor: pointer;
    display: block;
}

.close-button::before,
.close-button::after {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    width: 2px;
    height: 15px;
    background: #8B7969;
}

.close-button::before {
    transform: translate(-50%, -50%) rotate(45deg);
}

.close-button::after {
    transform: translate(-50%, -50%) rotate(-45deg);
}

/* 問い合わせ詳細テーブル */
.modal-content__group {
    margin: 60px 0 0 40px;
    width: 90%;
    height: 60%;
}

.detail-table__row {
    height: 50px;
}

.detail-table__header {
    width: 35%;
    vertical-align: top;
    font-size: 18px;
    font-weight: bold;
    color: #8B7969;
}

.detail-table__text {
    width: 65%;
    vertical-align: top;
    font-size: 18px;
    color: #8B7969;
}

/* 問い合わせ削除ボタン */
.delete-button {
    display: block;
    margin: 60px auto 0;
    width: 75px;
    height: 40px;
    background: #BA370D;
    border: none;
    font-size: 18px;
    color: white;
    cursor: pointer;
}
</style>