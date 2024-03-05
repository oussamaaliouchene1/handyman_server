<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\SaveCcpPaymentProof;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class CcpPaymentController extends Controller
{
    public function saveCcpPaymentProof(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'required',
            'api_token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }
        // return dd(Auth::user()->id);
        $accessToken = Auth::user();
        if (!$accessToken) {
            return dd('ooooooooo');
        }
        $user_id = Auth::user()->id;
        if (!$user_id) {
            return 'ffffff'; 
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            SaveCcpPaymentProof::create([
                'image_path' => $imageName,
                'duration' => $request->duration,
                'user_id' => $user_id,            
            ]);
            $image->move(public_path('images'), $imageName);


            return response()->json(['message' => 'Image enregistrée avec succès'], 200);
        }

        return response()->json(['message' => 'Aucune image trouvée dans la requête'], 400);
    }
}
