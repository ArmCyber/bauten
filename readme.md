# Bauten
## Cloning instructions
1) Clone this repository.
2) Install composer.
    ``` 
    composer install -o
    ```
3) Copy ".env.example" to ".env"
4) Generate application key with Artisan.
    ```
    php artisan key:generate --ansi
    ```
5) Download CKFinder with Artisan.
    ```
    php artisan ckfinder:download
    ```
6) Configure database.
7) Import database with Artisan.
    ```
    php artisan snapshot:load master
    ```
8) Configure sass.
### Sass configuration for JetBrains PhpStorm
```
Program: Your sass file path (Default path for windows installed globally with NPM: "C:\Users\\{User}\AppData\Roaming\npm\sass")
Arguments: "--update $FileName$:$ContentRoot$/public/f/$FileDirName$/css/$FileNameWithoutExtension$.css --style compressed"
Output paths to refresh: "$ContentRoot$/public/f/$FileDirName$/css/$FileNameWithoutExtension$.css"
Scope: Include recursively "/resources/sass" directory
```
#### Advanced Options for Sass
```
Uncheck "Auto-save edited files to trigger the watcher" checkbox.
Check "Trigger the watcher on external changes" checkbox.
```