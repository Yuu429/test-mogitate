# test-mogitate
## 環境構築

# コンテナをビルド・起動
- docker-compose up -d --build

# コンポーザーのインストール 環境変数の変更
- docker-compose exec php bash
- composer install
- .env.exampleファイルから.envを作成

# マイグレーション実行
- docker-compose exec php bash
- php artisan migrate

# 初期データ投入
- php artisan key:generate
- docker-compose exec php bash
- php artisan db:seed

## 使用技術（実行環境）
- laravel 8.x
- php 8.x
- mysql 8.x

## ER図
![ER図](index.drawio.png)

## URL
- http://localhost/ 開発環境
- http://localhost:8080/ phpMyAdmin