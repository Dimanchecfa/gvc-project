<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\MarqueController;
use App\Http\Controllers\Api\ModeleController;
use App\Http\Controllers\Api\MotoController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\HistoricalController;
use App\Http\Controllers\Api\OtherFunctionController;
use App\Http\Controllers\Api\VenteController;
use App\Http\Controllers\Api\CommercialController;
use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\Api\ModelController;
use App\Http\Controllers\Api\SellController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::ApiResource('stock', StockController::class);
Route::ApiResource('marque', MarqueController::class);
Route::ApiResource('model', ModeleController::class);
Route::ApiResource('moto' , MotoController::class);
Route::ApiResource('sales', SellController::class);
Route::ApiResource('commercial' , CommercialController::class);





Route::get('dashboard_price', [DashboardController::class, 'getTodaySellPrice']);
Route::get('dashboard_moto', [DashboardController::class, 'getTodayMotoNumber']);


Route::get('history/{date}/{page}' , [HistoricalController::class, 'getSellByDate']);
Route::get('history/{date}/moto' , [HistoricalController::class, 'getSellMotoNumberByDate']);
Route::get('history/lastmonth' , [HistoricalController::class, 'getLastMonthSell']);
Route::get('history/lastmonth/price' , [HistoricalController::class, 'getLastMonthSellPrice']);
Route::get('history/lastmonth/moto_number' , [HistoricalController::class, 'getLastMonthSellMotoNumber']);
Route::get('history/currentmonth/price' , [HistoricalController::class, 'getCurrentMonthSellPrice']);
Route::get('history/currentmonth/moto_number' , [HistoricalController::class, 'getCurrentMonthSellMotoNumber']);
Route::get('history/currentmonth/sell_moto' , [DashboardController::class,'getCurrentMonthSell']);
Route::get('history/{date}/price' , [HistoricalController::class, 'getSellPriceByDate']);
Route::get('history/{date}/moto_number' , [HistoricalController::class, 'getSellNumberByDate']);


Route::post("motos/add" , [OtherFunctionController::class, 'addMotors']);


Route::get('moto/stock/{numero_stock}', [OtherFunctionController::class, 'getMotoByStock']);
Route::get('moto/marque/{marque}', [OtherFunctionController::class, 'getMotoByMarque']);
Route::get('moto/statut/{statut}', [OtherFunctionController::class, 'getMotoByStatut']);
Route::get('modele/marque/{marque}', [OtherFunctionController::class, 'getModeleByMarque']);
Route::get('commerciale/pseudo/{pseudo}', [OtherFunctionController::class, 'getCommercialeByPseudo']);
Route::get('moto/vente/{numero_serie}', [OtherFunctionController::class, 'getVenteByNumeroSerie']);
Route::get('vente/statut/payé', [OtherFunctionController::class, 'getAllSellStatutPayé']);
Route::get('vente/statut/non_payé', [OtherFunctionController::class, 'getAllSellStatutNonPayé']);
Route::get('vente/number/payé', [OtherFunctionController::class, 'getAllSellStatutPayéNumber']);
Route::get('vente/number/non_payé', [OtherFunctionController::class, 'getAllSellStatutNonPayéNumber']);
Route::get('moto/number/stocker', [OtherFunctionController::class, 'getAllMotoEnStock']);
Route::get('moto/number/vendue', [OtherFunctionController::class, 'getAllMotoVendue']);

Route::get('/vente/today/{page}', [HistoricalController::class, 'TodayVenteListPaginate']);
// Route::get('/stock/page/{page}', [DataController::class, 'StockListPaginate']);
Route::get('/moto/page/{page}/{numero_stock}', [DataController::class, 'MotoListPaginate']);
Route::get('/commerciale/page/{page}' , [DataController::class , 'CommercialeListPaginate']);
Route::get('/modele/page/{page}' , [DataController::class , 'ModeleListPaginate']);
Route::get('/marque/page/{page}' , [DataController::class , 'MarqueListPaginate']);
Route::get('/last_vente' , [DataController::class  , 'getLastVente']);

Route::get('/vente/en_cours/{page}' , [DataController::class , 'getSellByStatutEnCours']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
