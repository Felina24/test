# laravel-docker-template

Laravel の開発環境用 Docker テンプレート。
---
## 変更点
- リモートリポジトリを Estra-Coachtech/laravel-docker-template から  
  Felina24/test に変更しました。

# アプリケーション名
お問い合わせフォーム

## 環境構築
Dockerビルド
1. git@github.com:Felina24/test.git
2. docker-compose up -d --build

Lravel環境構築
1. docker-compose exec php bash
2. composer install
3. .env.exampleファイルから.envを作成し、環境変数を変更
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed


## 使用技術(実行環境)
- PHP 8.3.6
- Laravel 8.83.8
- MySQL 8.0.26


## ER図
+------------------+
|   categories     |
+------------------+
| id (PK)          |
| content          |
| created_at       |
| updated_at       |
+------------------+
          ^
          |
          | (N:1)
          |
+------------------+
|    contacts      |
+------------------+
| id (PK)          |
| category_id (FK) |
| first_name       |
| last_name        |
| gender           |
| email            |
| tel              |
| address          |
| building         |
| detail           |
| created_at       |
| updated_at       |
+------------------+

+------------------+
|     users        |
+------------------+
| id (PK)          |
| name             |
| email            |
| password         |
| created_at       |
| updated_at       |
+------------------+


## URL
- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/

