<?php

declare(strict_types=1);

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->as('api:')->group(function (): void {

    Route::prefix('tasks')
        ->as('tasks:')
        ->controller(TaskController::class)
        ->group(
            base_path('/routes/tasks/task.php')
        );
});
