# お問い合わせフォーム
## 環境構築
Dockerビルド  
 1.git clone リンク　git@github.com:fujiwara-k0814/laravel.git  
 2.docker compose -up -d --build  
※MySQLはOSの都合上、各人でファイルを編集  
  
Laravel環境構築  
 1.docker compose exec php bash  
 2.compopser install  
 3..env.exampleファイルから.envファイルを作成し、環境変数を設定  
 4.php artisan key:generate  
 5.php artisan migrate  
 6.php artisan db:seed  
※尚、categoriesテーブルにはマイグレーション時に値が入力されるようになっているので  
シーディングをする際は実施前に手動でテーブル項目を削除してから実施してください。  
→理由：プログラムで書き込むよりデータ管理の方が管理しやすい為。  
   
## 使用技術
・PHP 8.1  
・Lravel 8.83  
・MySQL 8.0  
・dockerやcomposerに関しては都度最新を使用  
  
## ER図  
<img width="718" height="527" alt="お問い合わせフォーム_ER図" src="https://github.com/user-attachments/assets/cd82ce09-16f6-4d13-b64e-3ebe97215c4b" />  

## URL
・開発環境：http://localhost/  
・phpMyAdmin：http://localhost:8080/
