お問合せフォーム

## 環境構築

1. `git clone git@github.com:hiroakiokamura/confirm-test.git`
2. `composer install`
3. `php artisan sail install`
4. DockerDesktopを起動
5. .env.exampleファイルの名前を.envに変更
6. `./vendor/bin/sail up -d`
7. `./vendor/bin/sail artisan key:generate`
8. `./vendor/bin/sail artisan migrate`
9. `./vendor/bin/sail artisan db:seed`
10. `npm install`
11. `npm run dev`

## 使用技術(実行環境)

-   **フレームワーク**: Laravel 10.48.22
-   **プログラミング言語**: PHP 8.3.12
-   **データベース**: MySQL 8.0.39
-   **その他**: Docker, Docker Compose, Bootstrap 4.5

## ER 図

[ER 図](storage/images/ER.png)

## URL

-   開発環境：http://localhost/
-   phpMyAdmin:：http://localhost:8080/

[def]: erd.png
