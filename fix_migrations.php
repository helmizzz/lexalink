<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

Schema::dropIfExists('incoming_mails');
Schema::dropIfExists('outgoing_mails');
DB::table('migrations')->whereIn('migration', [
    '2026_07_16_163126_create_incoming_mails_table',
    '2026_07_16_163130_create_outgoing_mails_table',
    '2026_07_16_163133_create_jobs_table'
])->delete();

echo "Dropped incoming_mails, outgoing_mails and removed jobs migration record.\n";
