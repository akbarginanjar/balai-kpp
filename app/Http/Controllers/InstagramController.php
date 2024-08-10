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

        // Fetch the user's media
        $response = $client->request('GET', 'https://graph.instagram.com/me/media', [
            'query' => [
                'fields' => 'id,caption,media_type,media_url,thumbnail_url,permalink,children{media_url,media_type}',
                'access_token' => $accessToken,
            ]
        ]);

        $posts = json_decode($response->getBody(), true);

        // Process the media data
        $processedPosts = array_map(function ($post) {
            // Check if the media is a carousel
            if ($post['media_type'] === 'CAROUSEL_ALBUM') {
                $carouselMedia = $post['children']['data'];
                $post['carousel_media'] = $carouselMedia;
            } else {
                $post['carousel_media'] = [];
            }
            return $post;
        }, $posts['data']);

        // Return the processed data as JSON
        return view('instagram', ['posts' => $processedPosts]);
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
