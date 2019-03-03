# Calendar
laravel calendar

# install
crontab -e

```
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

.env
```
GCM_KEY=YOUR_KEY
```

App\Console\Kernel.php
```
use Quidmye\Jobs\SendWebPush;
```
And
```
$schedule->job(new SendWebPush)->everyMinute();
```
