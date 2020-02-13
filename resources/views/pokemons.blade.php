<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
<div class="container-fluid">
    <a href="{{ $pokemonData['home']}}" class="btn col-md-12">
        <h1 class="display-4 text-center mx-5">PokiDeck</h1>
    </a>
    <div class="row">
        <div class="col-md-6">
            @isset($pokemonData['prev'])
            <a class="btn btn-warning btn-lg float-left" href="{{ $pokemonData['prev'] }}">Prev</a>
            @endisset
        </div>
        <div class="col-md-6">
            @isset($pokemonData['next'])
            <a class="btn btn-success btn-lg float-right" href="{{ $pokemonData['next'] }}">Next</a><br/>
            @endisset
        </div>
    </div>
    @if($pokemonData['pokemons'])
    <div class="row">
        @foreach ($pokemonData['pokemons'] as $pokemon)
        <div class="col-md-3">
            <div class="card ml-4 my-4 pokemonCard">
                <h3 class="card-title text-center my-2">
                    {{ ucfirst($pokemon['name']) }}
                </h3>
                <div class="row">
                    <div class="col-md-7">
                        <img class="card-img-top" src="{{ $pokemon['pokemonImage'] }}" alt="Card image cap">
                    </div>
                    <div class="col-md-5 my-4">
                        <p class="my-0"><b>Height:</b> {{$pokemon['height']}}</p>
                        <p class="my-0"><b>Weight:</b> {{$pokemon['weight']}}</p>
                        <p class="my-0"><b>Types:</b></p>
                        @foreach ($pokemon['type'] as $pokemonType)
                           <p class="my-0"> {{ $pokemonType['typeName'] }}</p>
                        @endforeach
                    </div>
                </div> 
                <div class="card-body text-center">
                    <p class="text-center">
                        <b>Pokemon Stats:</b> <br/>
                        <div class="row">
                            @foreach ($pokemon['statDetails'] as $pokemonStats)
                            <div class="col-md-6 text-left">
                                @foreach ($pokemonStats as $stat)
                                    <b>{{ $stat['stateName'] }}:</b> {{ $stat['baseStat'] }} <br/>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </p>
                </div>
            </div>
        </div>    
    @endforeach
    </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            @isset($pokemonData['prev'])
            <a class="btn btn-warning btn-lg float-left" href="{{ $pokemonData['prev'] }}">Prev</a>
            @endisset
        </div>
        <div class="col-md-6">
            @isset($pokemonData['next'])
            <a class="btn btn-success btn-lg float-right" href="{{ $pokemonData['next'] }}">Next</a><br/>
            @endisset
        </div>
    </div>
</div>