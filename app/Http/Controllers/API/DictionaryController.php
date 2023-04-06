<?php
  
namespace App\Http\Controllers\API;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
  
class DictionaryController extends Controller
{
    public function getWord($word)
    {
        $response = Http::get('https://api.dictionaryapi.dev/api/v2/entries/en/' . $word);
        $jsonData = $response->json();
        return $jsonData;
    }
}