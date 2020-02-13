<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class Pokemon extends Controller
{
    public function __construct(){
        $pokemonArray = array();
    }

    public function index(Request $request){       

        $client = new Client();
        $res;
        $next = null;
        $previous = null;

        if($request->query('url')){
            $res = $client->request('GET',$request->query('url'));
        }else{
            $res = $client->request('GET','https://pokeapi.co/api/v2/pokemon/');
        }
        

        if ($res->getStatusCode() == 200) { 
            $response_data = json_decode($res->getBody()->getContents());
        }
        
        $count = $response_data->count;
        if(!empty($response_data->next)){
            $next = '/pokemon?url='.$response_data->next;
        }
        if(!empty($response_data->previous)){
            $previous = '/pokemon?url='.$response_data->previous;
        }
        $pokemons = $response_data->results;
        
        foreach($pokemons as $pokemon){
            $pokemonDetailsRequest = $client->request('GET',$pokemon->url);

            if ($pokemonDetailsRequest->getStatusCode() == 200) { 

                $pokemonDetails = json_decode($pokemonDetailsRequest->getBody()->getContents());
                
                $types = array();
                $statDetails = array();

                foreach($pokemonDetails->types as $type)
                {
                    $types[] = array('typeName'=> $type->type->name,'typeUrl'=> $type->type->url);
                } 

                foreach($pokemonDetails->stats as $stat){
                    $statDetails[] = array('stateName'=>$stat->stat->name,'statUrl'=>$stat->stat->url,'baseStat'=>$stat->base_stat);                        
                }

                $pokemonArray[] = array(
                                        'name'=>$pokemon->name,
                                        'pokemonImage' => $pokemonDetails->sprites->front_default,
                                        'height'=>$pokemonDetails->height,
                                        'weight'=>$pokemonDetails->weight,
                                        'type' => $types, 
                                        'statDetails'=> array_chunk($statDetails,3)
                                    );
            }
        
        }

        $data = array(
            'home'  => 'pokemon/',
            'count' => $count,
            'next'  => $next,
            'prev'  => $previous,
            'pokemons' => $pokemonArray
        );
        
        return view('pokemons')->with('pokemonData',$data);
    }
}