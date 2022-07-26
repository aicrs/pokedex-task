<template lang="html">
  <div class="w-screen h-screen flex items-center justify-center">
    <pokedex-table></pokedex-table>
  </div>
</template>

<script>
  import PokedexTable from '../components/PokedexTable'
  export default {
    components: {
      PokedexTable
    }
  }
</script>
