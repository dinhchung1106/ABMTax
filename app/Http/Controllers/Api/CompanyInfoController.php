<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyInfo;
use Illuminate\Support\Facades\Validator;

class CompanyInfoController extends Controller
{
    public function index()
    {
        $companyInfo = CompanyInfo::first();
        if (!$companyInfo) {
            // Create a default entry if none exists
            $companyInfo = CompanyInfo::create([
                'name' => 'Default Company Name',
                'address' => 'Default Address',
                'email' => 'default@example.com',
                'hotline' => '123-456-7890',
                'slogan' => 'Default Slogan',
                'about' => 'Default About text.',
            ]);
        }
        return response()->json($companyInfo);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'hotline' => 'required|string|max:20',
            'slogan' => 'required|string|max:255',
            'about' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $companyInfo = CompanyInfo::first();
        if (!$companyInfo) {
             $companyInfo = CompanyInfo::create([
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'hotline' => $request->hotline,
                'slogan' => $request->slogan,
                'about' => $request->about,
            ]);
        } else {
            $companyInfo->update($request->all());
        }

        return response()->json($companyInfo);
    }
} 