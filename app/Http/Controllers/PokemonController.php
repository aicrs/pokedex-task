<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PokemonController extends Controller
{

  public function index(){
      return Pokemon::all();
  }

  public function show(){

  }

  public function fetch() {
      // Configure Guzzle Request
      $client = new Client([
        'base_uri' => 'https://pokeapi.co',
      ]);

      // Get 151 Original Pokemon
      try {

        for ($i=1; $i <= 151; $i++) {
          $response = $client->request('GET', '/api/v2/pokemon/' . $i);
          $pokemon_data = json_decode($response->getBody(), true);

          $name = $pokemon_data['name'];
          $sprite = $pokemon_data['sprites']['front_default'];
          $weight = $pokemon_data['weight'];
          $abilities_data = $pokemon_data['abilities'];

          $abilities_array = [];
          foreach ($abilities_data as $ability) {
            $ability_name = $ability['ability']['name'];
            array_push($abilities_array, $ability_name);
          };

          $this->store($name, $sprite, $weight, $abilities_array);

        }


      } catch (\Exception $e) {
        echo 'Caught exception: ',  $e->getMessage();
      }

  }

  public function store($name, $sprite, $weight, $abilities_data) {

    $data = Pokemon::updateOrCreate([
      'name' => $name,
      'sprite' => $sprite,
      'weight' => $weight,
      'abilities' => json_encode($abilities_data),
    ]);
  }

  public function destroy($id) {

    $pokemon = Pokemon::findOrFail($id);
    $pokemon->delete();

  }

}
