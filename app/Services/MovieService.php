<?php

namespace App\Services;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieService {
  
  public function getMovies($request) {
    $title = $request->title;
    $per_page = 10;
    if($request->per_page){
      $per_page = $request->per_page;
    }    
    if($title) {
      return Movie::where('title', $title)->get();
    }else {
      return Movie::paginate($per_page);
    }
  }

  public function getMovie($id) {
    $movie = Movie::find($id);
    
    return $movie;
  }

  public function storeMovie(Request $request) {
    $request->validate([
      'title' => 'required|unique:movies,title',
      'director' => 'required',
      'duration' => 'min:1|max:500',
      'image_url' => 'url',
      'release_date' => 'unique:movies,release_date'
    ]);

    $movie = new Movie;
    $movie->title = $request->title;
    $movie->director = $request->director;
    $movie->image_url = $request->image_url;
    $movie->duration = $request->duration;
    $movie->release_date = $request->release_date;
    $movie->genre = $request->genre;
    $movie->save();

    return $movie;
  }

  public function updateMovie(Request $request, $id) {
    $movie = Movie::find($id);
    $movie->title = $request->title;
    $movie->director = $request->director;
    $movie->image_url = $request->image_url;
    $movie->duration = $request->duration;
    $movie->release_date = $request->release_date;
    $movie->genre = $request->genre;
    $movie->save();

    return $movie;
  }

  public function deleteMovie($id) {
    Movie::destroy($id);
  }
}