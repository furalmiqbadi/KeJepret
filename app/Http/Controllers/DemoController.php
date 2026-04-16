<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class DemoController extends Controller
{
    // ==========================================
    // HALAMAN 1: UPLOAD FOTO EVENT
    // ==========================================
    
    // Fungsi ini yang bertugas MENAMPILKAN halaman HTML (Blade)
    public function uploadView()
    {
        return view('demo.upload');
    }

    // Fungsi ini yang bertugas MEMPROSES file foto yang di-drag & drop
    public function uploadProcess(Request $request)
    {
        // 1. Validasi File
        $request->validate([
            'photo' => 'required|image|max:5120', 
        ]);

        try {
            $file = $request->file('photo');
            // Ganti nama file biar nggak ada spasi/karakter aneh
            $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $path = 'event-photos/' . $fileName;

            Storage::disk('s3')->put($path, file_get_contents($file));
            $publicUrl = env('AWS_URL') . '/' . $path;

            // KIRIM KE AI
            $response = Http::timeout(60)->withHeaders([
                'X-API-Key' => env('AI_API_KEY')
            ])->post(env('AI_BASE_URL') . '/embed-photo', [
                // Kita ambil 7 digit terakhir dari time, lalu tambah 2 digit random
                // Hasilnya akan di bawah 2 miliar, jadi database AI-mu nggak akan crash
                'photo_id'  => (int) (substr(time(), -7) . rand(10, 99)), 
                'photo_url' => $publicUrl
            ]);

            if (!$response->successful()) {
                \Log::error("AI Error Response: " . $response->body());
            }

            if ($response->successful()) {
                $aiData = $response->json();
                $generatedId = (int) (substr(time(), -7) . rand(10, 99)); // Kita simpan angkanya di variabel

                // Simpan ke Database
                DB::table('demo_photos')->insert([
                    'ai_photo_id' => $aiData['photo_id'] ?? null, // Simpan ID dari AI
                    'filename'    => $fileName,
                    'r2_url'      => $publicUrl,
                    'faces_data'  => json_encode($aiData),
                    'status'      => 'processed',
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);

                return response()->json([
                    'success' => true, 
                    'message' => 'Upload berhasil!',
                    'url' => $publicUrl
                ]);
            }
            
            // ====================================================
            // 🚨 BAGIAN DEBUGGING: TANGKAP ERROR ASLI DARI AI
            // ====================================================
            return response()->json([
                'success' => false, 
                'message' => 'Error dari AI (' . $response->status() . '): ' . $response->body()
            ], 500);

        } catch (\Exception $e) {
            // ====================================================
            // 🚨 BAGIAN DEBUGGING: TANGKAP ERROR DARI LARAVEL
            // ====================================================
            return response()->json([
                'success' => false, 
                'message' => 'Error Sistem Laravel: ' . $e->getMessage()
            ], 500);
        }
    }


    // ==========================================
    // HALAMAN 2: SEARCH WAJAH (SELFIE)
    // ==========================================
    
    // Kita siapkan fungsinya dari sekarang biar route web.php kamu nggak error
    public function searchView()
    {
        return view('demo.search');
    }

    public function searchProcess(Request $request)
    {
        // Nanti logika pencarian muka/selfie kita taruh di sini
        return response()->json(['message' => 'Fitur search segera hadir!']);
    }
}


