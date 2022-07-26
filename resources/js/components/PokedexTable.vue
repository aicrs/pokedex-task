<template lang="html">
  <div class="">

    <div class="w-[1200px]">
      <div class="bg-secondary pl-4 pr-8 py-4 flex items-center">
        <div class="flex-1">
          <span class="font-bold text-base text-white tracking-wide">#</span>
        </div>
        <div class="flex-1">
          <span class="font-bold text-base text-white tracking-wide">Sprite</span>
        </div>
        <div class="flex-1">
          <span class="font-bold text-base text-white tracking-wide">Name</span>
        </div>
        <div class="flex-1">
          <span class="font-bold text-base text-white tracking-wide">Weight</span>
        </div>
        <div class="flex-1">
          <span class="font-bold text-base text-white tracking-wide">Abilities</span>
        </div>
        <div class="flex-1">
          <span class="font-bold text-base text-white tracking-wide">Actions</span>
        </div>
      </div>

      <div class="border border-secondary max-h-[70vh] overflow-y-scroll">
        <div class="flex items-center bg-white px-4 border-b border-gray-200" v-for="pokemon in pokemonData" :key="pokemon.id">
          <div class="flex-1 py-4">
            <span class="">{{pokemon.id}}</span>
          </div>
          <div class="flex-1 py-4">
            <img class="" :src="pokemon.sprite" />
          </div>
          <div class="flex-1 py-4">
            <span class="">{{pokemon.name}}</span>
          </div>
          <div class="flex-1 py-4">
            <span class="">{{pokemon.weight}}</span>
          </div>
          <div class="flex-1 py-4">
            <ul v-for="ability in JSON.parse(pokemon.abilities)">
              <li class="">{{ ability.replace('-', ' ') }}</li>
            </ul>
          </div>
          <div class="flex-1 py-4">
            <span class="text-red-600 underline cursor-pointer" @click="deletePokemon(pokemon.id)">Delete</span>
          </div>
        </div>
      </div>

    </div>

  </div>
</template>

<script>
  export default {
    name: 'pokedex-table',
    data () {
      return {
        pokemonData: []
      }
    },
    methods: {
      async fetchPokemonData() {
        await axios.get('/api/pokemon')
        .then((response) => {
          this.pokemonData = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
      },
      deletePokemon(id) {
        axios.post('/api/pokemon/' + id, {_method: 'delete'})
        .then((response) => {
          window.location.reload()
        })
      }
    },
    mounted(){
      this.fetchPokemonData();
    }
  }
</script>
