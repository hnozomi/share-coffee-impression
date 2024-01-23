<?php

namespace App\Http\Controllers;

use App\Models\CoffeeImpression;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CoffeeImpressionController extends Controller
{
    public function fetchAllCoffeeImpression(Request $request)
    {
        try {
            Log::info($request);
            // Eloquentで取得
            $coffee_impression = CoffeeImpression::all();
            // クエリビルだで取得
//            $impressions = DB::table('CoffeeImpressions')->get();

            return response()->json($coffee_impression)->header('X-Message', 'データが取得できました');
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'データの取得に失敗しました'], 500);
        }
    }

    public function fetchOnlyCoffeeImpression(Request $request, $id)
    {
        try {
            Log::info($request);
            $coffee_impression = CoffeeImpression::where('id', $id)->first();

            // クエリビルだで取得
//           $record = DB::table('your_table')->where('table_column', $value)->first();

            return response()->json($coffee_impression)->header('X-Message', 'データが取得できました');;
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'データの取得に失敗しました'], 500);
        }
    }

    public function addCoffeeImpressions(Request $request)
    {
        try {
            Log::info($request);

            $validatedData = $request->validate([
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

            $coffee_impression = CoffeeImpression::create([
                'coffeeName' => $validatedData['coffeeName'],
                'purchaseDate' => $validatedData['purchaseDate'],
                'price' => $validatedData['price'],
                'place' => $validatedData['place'],
                'rate' => $validatedData['rate'],
                'scent' => $validatedData['scent'],
                'acidity' => $validatedData['acidity'],
                'bitter' => $validatedData['bitter'],
                'rich' => $validatedData['rich'],
                'taste' => $validatedData['taste'],
            ]);

            // 応答を返す
            return response()->json($coffee_impression)->header('X-Message', 'データの登録が完了しました');
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'データの取得に失敗しました'], 500);
        }
    }

    public function updateCoffeeImpression(Request $request, $id)
    {
        try {
            Log::info($request);

            $validatedData = $request->validate([
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

            // IDに基づいてレコードを検索
            $resource = CoffeeImpression::findOrFail($id);

            $resource->update($validatedData);

//            $coffee_impression = CoffeeImpression::update([
//                'coffeeName' => $validatedData['coffeeName'],
//                'purchaseDate' => $validatedData['purchaseDate'],
//                'price' => $validatedData['price'],
//                'place' => $validatedData['place'],
//                'rate' => $validatedData['rate'],
//                'scent' => $validatedData['scent'],
//                'acidity' => $validatedData['acidity'],
//                'bitter' => $validatedData['bitter'],
//                'rich' => $validatedData['rich'],
//                'taste' => $validatedData['taste'],
//                // 他のフィールドがある場合はここに追加
//            ]);

            // 応答を返す
            return response()->json($resource)->header('X-Message', 'データの更新が完了しました');
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'データの取得に失敗しました'], 500);
        }
    }

    public function deleteCoffeeImpression(Request $request, $id)
    {
        try {
            Log::info($request);

            // IDに基づいてレコードを検索
            $resource = CoffeeImpression::findOrFail($id);

            $resource->delete();

//            $coffee_impression = CoffeeImpression::delete([
//                'coffeeName' => $validatedData['coffeeName'],
//                'purchaseDate' => $validatedData['purchaseDate'],
//                'price' => $validatedData['price'],
//                'place' => $validatedData['place'],
//                'rate' => $validatedData['rate'],
//                'scent' => $validatedData['scent'],
//                'acidity' => $validatedData['acidity'],
//                'bitter' => $validatedData['bitter'],
//                'rich' => $validatedData['rich'],
//                'taste' => $validatedData['taste'],
//                // 他のフィールドがある場合はここに追加
//            ]);

            // 応答を返す
            return response()->json($resource)->header('X-Message', 'データの削除が完了しました');
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'データの取得に失敗しました'], 500);
        }
    }

}
