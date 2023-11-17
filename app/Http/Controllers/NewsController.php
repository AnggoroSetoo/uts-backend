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
        //Get All Student
        $news = News::all();

        //Jika Data Ada
        if ($news) {
			$response = [
				'message' => 'Get All Resource',
				'data' => $news,
			];
			return response()->json($response, 200);
		} 
        //Jika Data kosong
        else {
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
         //validasi data
         $validateData = $request->validate([
            'title' => 'required|min:5|max:255',
            'author' => 'required|min:3|max:100',
            'description' => 'required|min:20|max:500',
            'content' => 'required|min:500|max:2000',
            'url' => 'required|url|unique:news,url',
            'url_image' => 'required|url|mimes:jpg,jpeg,png',
            'category' => 'required'
        ]);

        //set tanggal saat ini
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
        //Get ID
        $news = News::find($id);

        //Jika Data Ada
		if($news){
			$response = [
				'message' => 'Get Detail Resource',
				'data' => $news,
			];

			return response()->json($response, 200);
		}

        //Jika Data Tidak Ada
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
        //Get ID    
        $news = News::find($id);

        //Jika Data Ada
		if($news){
			
			$news->update($request->all());
			
			$response = [
				'message' => 'Resource is updated succesfully',
				'data' => $news,
			];
			return response()->json($response, 200);
		}

        //Jika Data Tidak Ada
		else{
			$response = [
				'message' => 'Resource Not Found',
			];
			return response()->json($response, 404);
		}
    }

    /**
     * Menghapus Data dari databasi berdasarkan ID
     */
    public function destroy($id)
    {
        //Get ID 
        $news = News::find($id);

        //Jika Data Ada
		if($news){
			$news->delete();
			$response = [
				'message' => 'Resource is deleted succesfully'
			];
			return response()->json($response, 200);
		}

        //Jika Data Tidak Ada
		else{
			$response = [
				'message' => 'Resource Not Found',
			];
			return response()->json($response, 404);
		}
    }

    public function search($title)
    {
        //Mencari berdasarkan title/author/description/content dengan like 
        $news = News::where('title', 'like', '%' . $title . '%')
        ->orWhere('author', 'like', '%' . $title . '%')
        ->orWhere('description', 'like', '%' . $title . '%')
        ->orWhere('content', 'like', '%' . $title . '%')
        ->get();

        //Jika ada
        if ($news->count()) {
            $resource = [
                'message' => 'Get Search Resource',
                'data' => $news,
            ];
            return response()->json($resource, 200);
        } 
        
        //Jika tidak
        else {
            $data = [
                'message' => 'Resource Not Found',
            ];

            return response()->json($data, 404);
        }
        
    }
    public function sport()
    {
        //Mencari data berdasarkan category sport
        $news = News::where('category', 'sport')->get();

        //Jika ada
        if ($news->count()) {
            $resource = [
                'message' => 'Get Sport Resource',
                'data' => $news,
            ];
            return response()->json($resource, 200);
        }
        
        //Jika tidak
        else {
            $data = [
                'message' => 'No news found for the category "sport"',
            ];

            return response()->json($data, 404);
        }
    }

    public function finance()
    {
        //Mencari data berdasarkan category finance
        $news = News::where('category', 'finance')->get();

        //Jika ada
        if ($news->count()) {
            $resource = [
                'message' => 'Get Finance Resource',
                'data' => $news,
            ];
            return response()->json($resource, 200);
        }
        
        //Jika tidak
        else {
            $data = [
                'message' => 'No news found for the category "finance"',
            ];

            return response()->json($data, 404);
        }
    
    }

    public function automotive()
    {
        //Mencari data berdasarkan category automotive
        $news = News::where('category', 'automotive')->get();

        if ($news->count()) {
            $resource = [
                'message' => 'Get Automotive Resource',
                'data' => $news,
            ];
            return response()->json($resource, 200);
        } 
        
        //Jika tidak
        else {
            $data = [
                'message' => 'No news found for the category "automotive"',
            ];

            return response()->json($data, 404);
        }
    }
}
