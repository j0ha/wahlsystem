Useful comands

COMPOSER_MEMORY_LIMIT=-1 composer require the/library

snappy:

für mac:
https://wkhtmltopdf.org

installieren und Pfad in confif/snappy einsetzen!!!

using laravel 5.4 on a 32 bit ubuntu.

add these three lines to composer.json

"barryvdh/laravel-snappy": ">=0.4.0",
"h4cc/wkhtmltopdf-i386": "0.12.x",
"h4cc/wkhtmltoimage-i386": "0.12.x"
64-bit systems

"barryvdh/laravel-snappy": ">=0.4.0",
"h4cc/wkhtmltopdf-amd64": "0.12.x",
"h4cc/wkhtmltoimage-amd64": "0.12.x",
from your terminal , navigate to your laravel folder and type

composer update
In config/app add these two lines under 'aliases'

'PDF' => Barryvdh\Snappy\Facades\SnappyPdf::class,

'SnappyImage' => Barryvdh\Snappy\Facades\SnappyImage::class,
in your terminal type

php artisan vendor:publish --provider="Barryvdh\Snappy\ServiceProvider"
go to config/snappy and change your binary path for 'pdf' array to this

'binary' => base_path('/vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386'),
and 'image' array to this:

'binary' => base_path('/vendor/h4cc/wkhtmltoimage-i386/bin/wkhtmltoimage-i386'),



Permissions:

see_information_menu
see_information
edit_information_name
edit_information_description
