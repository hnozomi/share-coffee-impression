<?php

namespace App\Http\Controllers;

use App\Models\CoffeeImpression;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CoffeeImpressionController extends Controller
{
    public function fetchAllCoffeeImpression(Request $request, CoffeeImpression $coffeeImpression)
    {
        try {
            $coffee_impressions = $coffeeImpression->fetchAllCoffeeImpression();

            return response()->json($coffee_impressions)->header('X-Message', 'データが取得できました');
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'データの取得に失敗しました'], 500);
        }
    }

    public function fetchOnlyCoffeeImpression(Request $request, $id, CoffeeImpression $coffeeImpression)
    {
        try {
            $coffee_impression = $coffeeImpression->fetchOnlyCoffeeImpression($id);

            return response()->json($coffee_impression)->header('X-Message', 'データが取得できました');
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'データの取得に失敗しました'], 500);
        }
    }

    public function fetchMyCoffeeImpression(Request $request)
    {
        try {

            $user = Auth::user();
            $coffee_impression = $user->coffeeImpressions()->get();

            // モデルをリレーションさせていない場合の書き方
            // 基本的にリレーションさせた方が良さそう
            // リレーションをした方がテーブル間の関係性がコードからわかる
            // クエリの書き方が簡略化・開発の効率化
            // $coffee_impression1 = CoffeeImpression::where('id', $userId)->get();


            return response()->json($coffee_impression)->header('X-Message', 'データが取得できました');
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'データの取得に失敗しました'], 500);
        }
    }

    public function addCoffeeImpressions(Request $request, CoffeeImpression $coffeeImpression)
    {
        try {
            $validatedData = $request->validate([
                'userId' => 'required|integer|min:1',
                'coffeeName' => 'required|string',
                'purchaseDate' => 'required|string',
                'price' => 'required|integer',
                'place' => 'required|string',
                'rate' => 'required|integer',
                'scent' => 'required|integer',
                'acidity' => 'required|integer',
                'bitter' => 'required|integer',
                'rich' => 'required|integer',
                'taste' => 'required|integer',
            ]);

            $coffee_impression = $coffeeImpression->addCoffeeImpressions($validatedData);

            // 応答を返す
            return response()->json($coffee_impression)->header('X-Message', 'データの登録が完了しました');
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'データの取得に失敗しました'], 500);
        }
    }

    public function updateCoffeeImpression(Request $request, $id, CoffeeImpression $coffeeImpression)
    {
        try {

            $validatedData = $request->validate([
                'userId' => 'required|integer|min:1',
                'coffeeName' => 'required|string',
                'purchaseDate' => 'required|string',
                'price' => 'required|integer',
                'place' => 'required|string',
                'rate' => 'required|integer',
                'scent' => 'required|integer',
                'acidity' => 'required|integer',
                'bitter' => 'required|integer',
                'rich' => 'required|integer',
                'taste' => 'required|integer',
            ]);

            $resource = $coffeeImpression->updateCoffeeImpression($id, $validatedData);

            // 応答を返す
            return response()->json($resource)->header('X-Message', 'データの更新が完了しました');
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'データの取得に失敗しました'], 500);
        }
    }

    public function deleteCoffeeImpression(Request $request, $id, CoffeeImpression $coffeeImpression)
    {
        try {
            $resource = $coffeeImpression->deleteCoffeeImpression($id, $coffeeImpression);

            return response()->json($resource)->header('X-Message', 'データの削除が完了しました');
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'データの取得に失敗しました'], 500);
        }
    }

}
