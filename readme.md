# Bauten
## Cloning instructions
1) Clone this repository.
2) Run "composer install -o" command from terminal.
3) Copy ".env.example" to ".env"
4) Run "php artisan key:generate --ansi" command from terminal.
5) Run "php artisan ckfinder:download" command from terminal.
6) Configure database, migrate and seed.
7) Configure sass.
### Sass configuration for JetBrains PhpStorm
1) __Program:__ *Your sass file path (Default path for windows installed globally with NPM: "C:\Users\Hayko\AppData\Roaming\npm\sass").*
2) __Arguments:__ *"--update $FileName$:$ContentRoot$/public/f/$FileDirName$/css/$FileNameWithoutExtension$.css --style compressed".*
3) __Output paths to refresh:__ *"$ContentRoot$/public/f/$FileDirName$/css/$FileNameWithoutExtension$.css".*
4) __Scope__: Include recursively *"/resources/sass"* directory.
#### Advanced Options for sass
1) Uncheck *"Auto-save edited files to trigger the watcher"* checkbox.
2) Check *"Trigger the watcher on external changes"* checkbox.