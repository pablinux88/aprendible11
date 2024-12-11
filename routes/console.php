<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('app:process-orders-file')->everyThirtySeconds();

//     * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
//     * * * * * cd /Users/pablo/Sites/aprendible11 && php artisan schedule:run >> /dev/null 2>&1
//     * * * * * cd /opt/homebrew/Cellar/php@8.4/8.4.0_1/bin/php /Users/pablo/Sites/aprendible11 && php artisan schedule:run >> /dev/null 2>&1
//   ⇂ '/opt/homebrew/Cellar/php@8.4/8.4.0_1/bin/php' 'artisan' app:process-orders-file > '/dev/null' 2>&1
// /opt/homebrew/Cellar/php@8.4/8.4.0_1/bin/php /Users/pablo/Sites/aprendible11/artisan app:process-orders-file >> /Users/pablo/Sites/aprendible11/logs/cron.log 2>&1
