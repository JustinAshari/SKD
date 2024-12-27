<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Generate OTP
        $otp = rand(100000, 999999);
        
        // Simpan OTP ke database
        Otp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expire_at' => now()->addMinutes(5), // OTP berlaku 5 menit
            'is_verified' => false
        ]);

        // Kirim email
        Mail::to($request->email)->send(new OtpMail($otp));

        return response()->json([
            'message' => 'OTP telah dikirim ke email Anda'
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric'
        ]);

        $otp = Otp::where('email', $request->email)
                  ->where('otp', $request->otp)
                  ->where('is_verified', false)
                  ->where('expire_at', '>', now())
                  ->first();

        if (!$otp) {
            return response()->json([
                'message' => 'OTP tidak valid atau sudah kadaluarsa'
            ], 400);
        }

        $otp->update(['is_verified' => true]);

        return response()->json([
            'message' => 'OTP berhasil diverifikasi'
        ]);
    }
}