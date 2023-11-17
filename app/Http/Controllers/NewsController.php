<?php

namespace App\Http\Controllers;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();

        if ($news) {
			$response = [
				'message' => 'Get All Resource',
				'data' => $news,
			];
			return response()->json($response, 200);
		} else {
			$response = [
				'message' => 'Data is Empty'
			];
			return response()->json($response, 400);
		}
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //validasi
         $validateData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'content' => 'required',
            'url' => 'required',
            'url_image' => 'required',
            'category' => 'required'
        ]);

        $validateData['published_at'] = Carbon::now();

        $news = News::create($validateData);


        $data = [
            'message' => 'Resource is added succesfully',
            'data' => $news,
        ];  

        // mengembalikan data (json) dan kode 201
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $news = News::find($id);

		if($news){
			$response = [
				'message' => 'Get Detail Resource',
				'data' => $news,
			];

			return response()->json($response, 200);
		}
		else{
			$response = [
				'message' => 'Resource Not Found',
			];
			return response()->json($response, 404);
		}
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news, $id)
    {
        $news = News::find($id);
		if($news){
			
			$news->update($request->all());
			
			$response = [
				'message' => 'Resource is updated succesfully',
				'data' => $news,
			];
			return response()->json($response, 200);
		}
		else{
			$response = [
				'message' => 'Resource Not Found',
			];
			return response()->json($response, 404);
		}
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $news = News::find($id);
		if($news){
			$news->delete();
			$response = [
				'message' => 'Resource is deleted succesfully'
			];
			return response()->json($response, 200);
		}
		else{
			$response = [
				'message' => 'Resource Not Found',
			];
			return response()->json($response, 404);
		}
    }

    public function search($title)
    {
        $news = News::where('title', 'like', '%' . $title . '%')
        ->orWhere('author', 'like', '%' . $title . '%')
        ->orWhere('description', 'like', '%' . $title . '%')
        ->orWhere('content', 'like', '%' . $title . '%')
        ->get();

        if ($news->count()) {
            $resource = [
                'message' => 'Get Search Resource',
                'data' => $news,
            ];
            return response()->json($resource, 200);
        } else {
            $data = [
                'message' => 'Resource Not Found',
            ];

            return response()->json($data, 404);
        }
        
    }
    public function sport()
    {
        $news = News::where('category', 'sport')->get();

        if ($news->count()) {
            $resource = [
                'message' => 'Get Sport Resource',
                'data' => $news,
            ];
            return response()->json($resource, 200);
        } else {
            $data = [
                'message' => 'No news found for the category "sport"',
            ];

            return response()->json($data, 404);
        }
    }

    public function finance()
    {
        $news = News::where('category', 'finance')->get();

        if ($news->count()) {
            $resource = [
                'message' => 'Get Finance Resource',
                'data' => $news,
            ];
            return response()->json($resource, 200);
        } else {
            $data = [
                'message' => 'No news found for the category "finance"',
            ];
        }
    
    }

    public function automotive()
    {
        $news = News::where('category', 'automotive')->get();

        if ($news->count()) {
            $resource = [
                'message' => 'Get Automotive Resource',
                'data' => $news,
            ];
            return response()->json($resource, 200);
        } else {
            $data = [
                'message' => 'No news found for the category "automotive"',
            ];
        }
    }
}
