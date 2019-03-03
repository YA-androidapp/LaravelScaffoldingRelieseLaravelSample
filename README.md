LaravelScaffoldingSample
---

1. Laravelプロジェクトの作成

```powershell
$ laravel new LaravelScaffoldingSample
$ cd LaravelScaffoldingSample
```

2. reliese/laravelのインストール

```powershell
$ composer require --dev reliese/laravel
```

```powershell
$file = "app/Providers/AppServiceProvider.php"
$data = Get-Content $file
$lnum = $(Select-String -pattern  "    public function register()" -path $file |  foreach { $_.ToString().split(":")[2] } )-1 + 2
If ($lnum -ne -1){
    $data[$lnum]=$data[$lnum]+"`n        if (`$this->app->environment() == 'local') {`n            `$this->app->register(\Reliese\Coders\CodersServiceProvider::class);`n        }"
    $data | Out-File $file -Encoding UTF8
}
```

3. DB設定の変更

.env にあるDB設定を変更する

既定：

```inf
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

変更後：

```inf
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_scaffolding_sample
DB_USERNAME=homestead
DB_PASSWORD=secret
```

4. artisanコマンドでモデル作成

```powershell
$ php artisan vendor:publish --tag=reliese-models
$ php artisan config:clear
$ php artisan code:models --schema=laravel_scaffolding_sample
```

5. 認証

Laravel5.4以上かつMySQL5.7.7未満の場合は以下の通り置換

```powershell
$file = "app/Providers/AppServiceProvider.php"
$data = Get-Content $file
$lnum = $(Select-String -pattern  "    public function boot()" -path $file |  foreach { $_.ToString().split(":")[2] } )-1 + 2
If ($lnum -ne -1){
    $data[$lnum]=$data[$lnum]+"`n        Schema::defaultStringLength(191);"
    $data | Out-File $file -Encoding UTF8
}
$data = Get-Content $file
$lnum = $(Select-String -pattern  "use Illuminate\\Support\\ServiceProvider;" -path $file |  foreach { $_.ToString().split(":")[2] } )-1
If ($lnum -ne -1){
    $data[$lnum]=$data[$lnum]+"`nuse Illuminate\Support\Facades\Schema;"
    $data | Out-File $file -Encoding UTF8
}
```

認証用テーブルのマイグレーションを実行する

```powershell
$ php artisan make:auth
$ php artisan migrate
```

6. 実行

```powershell
$ php artisan serve
```
