use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;

Route::get('genres', [GenreController::class, 'index']);
Route::get('genres/{id}', [GenreController::class, 'show']);
Route::get('movies', [MovieController::class, 'index']);
Route::get('movies/{id}', [MovieController::class, 'show']);
Route::post('movies', [MovieController::class, 'store']);
Route::put('movies/{id}', [MovieController::class, 'update']);
Route::delete('movies/{id}', [MovieController::class, 'destroy']);
Route::post('movies/{id}/publish', [MovieController::class, 'publish']);
