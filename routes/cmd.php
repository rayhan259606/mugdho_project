<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


// Routes for running artisan commands
Route::get('/run-migrate-fresh', function () {
    try {
        $output = Artisan::call('migrate:fresh', ['--seed' => true]);
        return response()->json([
            'message' => 'Migrations executed.',
            'output' => nl2br($output)
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'An error occurred while running migrations.',
            'error' => $e->getMessage(),
        ], 500);
    }
});
// Run composer update
Route::get('/run-composer-update', function () {
    $output = shell_exec('composer update 2>&1');
    return response()->json([
        'message' => 'Composer update command executed.',
        'output' => nl2br($output)
    ]);
});
// Run optimize:clear
Route::get('/run-optimize-clear', function () {
    $output = Artisan::call('optimize:clear');
    return response()->json([
        'message' => 'Optimize clear command executed.',
        'output' => nl2br($output)
    ]);
});
// Run db:seed
Route::get('/run-db-seed', function () {
    $output = Artisan::call('db:seed', ['--force' => true]);
    return response()->json([
        'message' => 'Database seeding executed.',
        'output' => nl2br($output)
    ]);
});
// Run cache:clear
Route::get('/run-cache-clear', function () {
    $output = Artisan::call('cache:clear');
    return response()->json([
        'message' => 'Cache cleared.',
        'output' => nl2br($output)
    ]);
});
// Run queue:restart
Route::get('/run-queue-restart', function () {
    $output = Artisan::call('queue:restart');
    return response()->json([
        'message' => 'Queue workers restarted.',
        'output' => nl2br($output)
    ]);
});

// Run comprehensive clean and optimize (clear all cache, optimize, and restart workers/logs)
Route::get('/run-clear-optimize-all', function () {
    $results = [];

    // 1. Run optimize:clear
    try {
        $exitCode = Artisan::call('optimize:clear');
        $results['optimize_clear'] = [
            'status' => 'success',
            'exit_code' => $exitCode,
            'output' => trim(Artisan::output())
        ];
    } catch (\Exception $e) {
        $results['optimize_clear'] = [
            'status' => 'failed',
            'error' => $e->getMessage()
        ];
    }

    // 2. Clear compiled files
    try {
        $exitCode = Artisan::call('clear-compiled');
        $results['clear_compiled'] = [
            'status' => 'success',
            'exit_code' => $exitCode,
            'output' => trim(Artisan::output())
        ];
    } catch (\Exception $e) {
        $results['clear_compiled'] = [
            'status' => 'failed',
            'error' => $e->getMessage()
        ];
    }

    // 3. Clear application cache specifically
    try {
        $exitCode = Artisan::call('cache:clear');
        $results['cache_clear'] = [
            'status' => 'success',
            'exit_code' => $exitCode,
            'output' => trim(Artisan::output())
        ];
    } catch (\Exception $e) {
        $results['cache_clear'] = [
            'status' => 'failed',
            'error' => $e->getMessage()
        ];
    }

    // 4. Cache config for optimization
    try {
        $exitCode = Artisan::call('config:cache');
        $results['config_cache'] = [
            'status' => 'success',
            'exit_code' => $exitCode,
            'output' => trim(Artisan::output())
        ];
    } catch (\Exception $e) {
        $results['config_cache'] = [
            'status' => 'failed',
            'error' => $e->getMessage()
        ];
    }

    // 5. Cache routes for optimization
    try {
        $exitCode = Artisan::call('route:cache');
        $results['route_cache'] = [
            'status' => 'success',
            'exit_code' => $exitCode,
            'output' => trim(Artisan::output())
        ];
    } catch (\Exception $e) {
        // If route cache fails (e.g. because of route closures), run route:clear to be safe
        Artisan::call('route:clear');
        $results['route_cache'] = [
            'status' => 'failed',
            'error' => $e->getMessage(),
            'note' => 'Routes cleared instead of cached to prevent route resolution errors.'
        ];
    }

    // 6. Cache views
    try {
        $exitCode = Artisan::call('view:cache');
        $results['view_cache'] = [
            'status' => 'success',
            'exit_code' => $exitCode,
            'output' => trim(Artisan::output())
        ];
    } catch (\Exception $e) {
        $results['view_cache'] = [
            'status' => 'failed',
            'error' => $e->getMessage()
        ];
    }

    // 7. Cache events
    try {
        $exitCode = Artisan::call('event:cache');
        $results['event_cache'] = [
            'status' => 'success',
            'exit_code' => $exitCode,
            'output' => trim(Artisan::output())
        ];
    } catch (\Exception $e) {
        $results['event_cache'] = [
            'status' => 'failed',
            'error' => $e->getMessage()
        ];
    }

    // 8. Restart queue workers
    try {
        $exitCode = Artisan::call('queue:restart');
        $results['queue_restart'] = [
            'status' => 'success',
            'exit_code' => $exitCode,
            'output' => trim(Artisan::output())
        ];
    } catch (\Exception $e) {
        $results['queue_restart'] = [
            'status' => 'failed',
            'error' => $e->getMessage()
        ];
    }

    // 9. Clear/Truncate log files
    try {
        $logFilesCleared = [];
        $logPath = storage_path('logs');
        if (is_dir($logPath)) {
            $files = glob($logPath . '/*.log');
            foreach ($files as $file) {
                if (is_file($file)) {
                    file_put_contents($file, '');
                    $logFilesCleared[] = basename($file);
                }
            }
        }
        $results['log_clear'] = [
            'status' => 'success',
            'cleared_files' => $logFilesCleared
        ];
    } catch (\Exception $e) {
        $results['log_clear'] = [
            'status' => 'failed',
            'error' => $e->getMessage()
        ];
    }

    return response()->json([
        'success' => true,
        'message' => 'Project cleared, optimized, and logs reset successfully.',
        'details' => $results
    ]);
});

// Route to fix SEO database settings and clear cache (useful for live deployment)
Route::get('/run-fix-seo-settings', function () {
    try {
        $updated = \App\Models\Setting::where('id', 1)->update([
            'name' => 'Twistitbd',
            'title' => 'Twistitbd',
            'description' => 'Twistitbd is a leading web and software development agency providing top-notch digital solutions.',
            'author' => 'Twistitbd',
            'keywords' => 'Twistitbd, Web Development, Software Agency'
        ]);

        // Clear cache
        \Illuminate\Support\Facades\Artisan::call('cache:clear');

        return response()->json([
            'success' => true,
            'message' => 'SEO settings updated in database and cache cleared successfully.',
            'rows_affected' => $updated
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
});


