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