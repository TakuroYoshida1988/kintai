# 勤怠管理アプリ

![kintai](https://github.com/user-attachments/assets/f4ff868f-2cfa-4ce4-bf81-672ee0693db5)
![kintai2](https://github.com/user-attachments/assets/7418f178-3d51-4b38-93fc-39b6cb172e29)

## 環境構築

### Dockerビルド
1. `git clone https://github.com/TakuroYoshida1988/kintai.git`
2. `docker-compose up -d --build`

* MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせて `docker-compose.yml` ファイルを編集してください。

### Laravel環境構築
1. `docker-compose exec php bash`
2. `composer install`
3. `.env.example` ファイルから `.env` を作成し、環境変数を変更
4. `php artisan key:generate`
5. `php artisan migrate`
6. `php artisan db:seed`

## MailHogの使用方法

MailHogは、開発環境でのメール送信をテストするためのツールです。メールが実際に外部に送信されることなく、MailHogのインターフェースで確認できます。

### MailHogの起動
- `docker-compose.yml` ファイルにMailHogの設定を追加していますので、`docker-compose up -d --build` コマンドでMailHogが自動的に起動します。
- MailHogのWebインターフェースには、ブラウザで `http://localhost:8025/` にアクセスして確認できます。

### MailHogのSMTP設定
- `.env` ファイルに以下の設定を追加します。これにより、Laravelがメール送信時にMailHogを使用するようになります。

MAIL_MAILER=smtp

MAIL_HOST=mailhog

MAIL_PORT=1025

MAIL_USERNAME=null

MAIL_PASSWORD=null

MAIL_ENCRYPTION=null

MAIL_FROM_ADDRESS="noreply@example.com"

MAIL_FROM_NAME="${APP_NAME}"

これにより、開発中に送信されるすべてのメールがMailHogで確認できるようになります。

## 使用技術
- PHP 8.0
- Laravel 10.0
- MySQL 8.0
- MailHog

## URL
- 開発環境：`http://localhost/`
- phpMyAdmin：`http://localhost:8080/`
- MailHog：`http://localhost:8025/`
