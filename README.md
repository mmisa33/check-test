# お問い合わせフォーム

## 概要
このプロジェクトは、Laravelを使用したお問い合わせ管理システムです。  
Dockerを利用した環境構築が可能で、MySQLデータベースを使用しています。  
ユーザーがお問い合わせを送信し、管理者が一覧・検索・削除できます。



## 環境構築

### **Dockerビルド**

1. リポジトリをクローン　
   ```bash
   git clone git@github.com:mmisa33/check-test.git　
2. プロジェクトフォルダに移動
    ```bash
    cd check-test　
3. Dockerコンテナをビルドして起動
    ```bash
    docker-compose up -d --build　
> **⚠ 注意:**　
> MySQLはOSによって起動しない場合があるので、それぞれのPCに合わせて `docker-compose.yml` ファイルを編集してください。



### **Laravel環境構築**

1. PHPコンテナに入る　
   ```bash
   docker-compose exec php bash　
2. 必要な依存関係をインストール
    ```bash
    composer install　
3. .env.example ファイルから .env を作成し、環境変数を変更
    ```bash
    cp .env.example .env　
4. アプリケーションキーを生成　
   ```bash
   php artisan key:generate
5. データベースをマイグレーション　
   ```bash
   php artisan migrate
6. データベースに初期データを挿入　
   ```bash![er_contact_form](https://github.com/user-attachments/assets/09fd57be-fda2-43a3-aa11-8f7fdf6ee787)

   php artisan db:seed　
   ```


## 使用技術
- PHP 7.4.9
- Laravel 8.83.8
- MySQL 10.3.39 (MariaDB)
- Laravel Fortify（認証機能の追加）
- Livewire（リアルタイムインタラクション）

## ER図
![er_contact_form](https://github.com/user-attachments/assets/52a01c2b-5565-4b27-beec-09c73634ac02)

## URL
- 開発環境： [http://localhost/](http://localhost/)
- phpMyAdmin： [http://localhost:8080/](http://localhost:8080/)
