<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// HANYA UNTUK SETUP AWAL - HAPUS SETELAH MIGRATION SELESAI!
Route::get('/setup-database-now', function () {
    // Cek apakah sudah pernah di-setup
    try {
        \DB::table('users')->count();
        return 'Database already setup! Please delete this route file: routes/setup.php';
    } catch (\Exception $e) {
        // Database belum setup, jalankan migration
        try {
            Artisan::call('migrate', ['--force' => true]);
            $migrationOutput = Artisan::output();
            
            Artisan::call('db:seed', ['--force' => true]);
            $seedOutput = Artisan::output();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Database setup completed!',
                'migration' => $migrationOutput,
                'seed' => $seedOutput,
                'note' => 'Please delete routes/setup.php file now!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
});
