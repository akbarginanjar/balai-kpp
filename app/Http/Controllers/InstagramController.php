<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class InstagramController extends Controller
{
    public function index()
    {
        $accessToken = env('INSTAGRAM_ACCESS_TOKEN');
        $client = new Client();

        $response = $client->request('GET', 'https://graph.instagram.com/me/media', [
            'query' => [
                'fields' => 'id,caption,media_type,media_url,thumbnail_url,permalink',
                'access_token' => $accessToken,
            ]
        ]);

        $posts = json_decode($response->getBody(), true);
        // return response()->json($posts);

        // return json_decode($posts);
        return view('instagram', ['posts' => $posts['data']]);
    }

    public function create()
    {
        // return "ADA";
        return view('instagram-post');
    }

    public function post(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'caption' => 'required', // Instagram caption limit
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);

        // Buat URL gambar
        $imageUrl = url('images/' . $imageName);

        // Kirim data ke Instagram
        $accessToken = 'EAAFjk0O1Q6MBO8kjXEvRpuuZCmLDyMY3lkCXOhkyDQLEeBgncYjplgWsWThn6030orQxFatMITeTHraAAqdhKBFF8uYRWk9rE65Tdp1ZBQaideZCwOEE0T20uLVjsIY0uTvyTEuDIkWFZANZB9pb6yqiJB2LZCveZC08QuNFDqDpMBUv4NXMYGsQGM6YDEiumoHLmltmZBZCOZCXGxwXaV82W8nc4SFf2IuIMHQtvZBptASoNJyKT5K0JnMHsbrRwJR9QZDZD';
        $client = new Client();

        // Gantilah {your-instagram-business-account-id} dengan ID akun Instagram Anda
        $instagramBusinessAccountId = 'ATQORjT4R86zbew4pWotWFq';

        // Kirim permintaan pembuatan media
        $response = $client->request('POST', "https://graph.facebook.com/v13.0/{$instagramBusinessAccountId}/media", [
            'form_params' => [
                'image_url' => $imageUrl, // URL gambar
                'caption' => $request->input('caption'),
                'access_token' => $accessToken,
            ]
        ]);

        $media = json_decode($response->getBody(), true);

        // Publikasikan media
        $response = $client->request('POST', "https://graph.facebook.com/v13.0/{$instagramBusinessAccountId}/media_publish", [
            'form_params' => [
                'creation_id' => $media['id'],
                'access_token' => $accessToken,
            ]
        ]);

        $result = json_decode($response->getBody(), true);

        return response()->json($result);
    }
}
