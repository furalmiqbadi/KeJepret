<?php

namespace App\Http\Controllers;

use App\Models\UserFace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Mendaftarkan wajah baru (Face Enrollment).
     */
    public function enroll(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:10240',
        ]);

        try {
            $user = Auth::user();
            $file = $request->file('image');
            $fileName = 'user_' . $user->id . '_face_' . time() . '.' . $file->getClientOriginalExtension();
            $r2Path = 'user-faces/' . $fileName;

            // 1. Upload ke R2 (Disk S3)
            // Mengikuti pola DemoController: Storage::disk('s3')->put($r2Path, file_get_contents($file));
            Storage::disk('s3')->put($r2Path, file_get_contents($file));
            $r2Url = env('AWS_URL') . '/' . $r2Path;

            // 2. Simpan ke database
            $face = UserFace::create([
                'user_id' => $user->id,
                'face_url' => $r2Url,
            ]);

            // 3. Update status user
            $user->update([
                'face_enrolled' => true,
                'profile_face_url' => $r2Url, // Opsional: Gunakan wajah terakhir sebagai profil
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Wajah berhasil didaftarkan!',
                'face' => $face
            ]);

        } catch (\Exception $e) {
            Log::error('Face Enroll Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendaftarkan wajah: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menghapus data wajah.
     */
    public function deleteFace($id)
    {
        try {
            $face = UserFace::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
            
            // Hapus dari R2 jika memungkinkan (Opsional)
            // Storage::disk('s3')->delete(str_replace(env('AWS_URL') . '/', '', $face->face_url));

            $face->delete();

            // Cek jika masih ada wajah tersisa
            $hasFaces = UserFace::where('user_id', Auth::id())->exists();
            if (!$hasFaces) {
                Auth::user()->update(['face_enrolled' => false]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
