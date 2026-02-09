<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-900 via-emerald-950 to-slate-900 text-white font-sans p-4 md:p-8">
    <div class="max-w-7xl mx-auto">
      <header class="text-center mb-12">
        <h1 class="text-5xl font-extrabold tracking-tight mb-2 bg-clip-text text-transparent bg-gradient-to-r from-emerald-400 to-cyan-400">
          Webnet Card Drawer
        </h1>
        <p class="text-slate-400 uppercase tracking-widest text-sm">Robin LY UONG</p>
      </header>

      <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <aside class="lg:col-span-1 space-y-6">
          <div class="bg-white/10 backdrop-blur-md border border-white/10 p-6 rounded-2xl shadow-xl">
            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
              <span class="text-emerald-400">⚙️</span> Configuration
            </h3>
            
            <div class="space-y-4">
              <div>
                <label class="block text-xs text-slate-400 mb-1">NOMBRE DE CARTES (X)</label>
                <input v-model="count" type="number" min="1" max="52" 
                  class="w-full bg-slate-800 border-none rounded-lg p-3 text-white focus:ring-2 focus:ring-emerald-500 outline-none" />
              </div>

              <button @click="drawCards" 
                class="w-full py-4 bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold rounded-xl transition-all active:scale-95 shadow-[0_0_20px_rgba(16,185,129,0.3)]">
                DISTRIBUER
              </button>
            </div>
          </div>

          <RulesConfig v-model:suits="suitOrder" v-model:values="valueOrder" />
        </aside>

        <main class="lg:col-span-3 space-y-10">
          <div v-if="results" class="space-y-12">
            
            <section class="bg-white/5 p-8 rounded-3xl border border-white/5">
              <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
                <span class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-sm">01</span>
                Main non triée
              </h2>
              <div class="flex flex-wrap gap-4">
                <Card v-for="(card, i) in results.unsortedHand" :key="'un-' + drawTimestamp + i" :cardString="card" :index="i" />
              </div>
            </section>

            <section class="bg-emerald-500/5 p-8 rounded-3xl border border-emerald-500/20 shadow-inner">
              <h2 class="text-xl font-bold mb-6 flex items-center gap-3 text-emerald-400">
                <span class="w-8 h-8 rounded-full bg-emerald-500 text-slate-900 flex items-center justify-center text-sm">02</span>
                Main triée
              </h2>
              <div class="flex flex-wrap gap-4">
                <Card v-for="(card, i) in results.sortedHand" :key="'so-'+ drawTimestamp + i" :cardString="card" :index="i" />
              </div>
            </section>

          </div>

          <div v-else class="h-64 flex flex-col items-center justify-center text-slate-500 border-2 border-dashed border-slate-700 rounded-3xl">
            <p class="text-lg">Prêt pour une partie ?</p>
            <p class="text-sm">Appuie sur le bouton pour piocher les cartes</p>
          </div>
        </main>
      </div>
    </div>
  </div>
</template>

<script setup>
const count = ref(10)
const results = ref(null)
const suitOrder = ref(['Carreau', 'Cœur', 'Pique', 'Trèfle'])
const valueOrder = ref(['AS', '5', '10', '8', '6', '7', '4', '2', '3', '9', 'Dame', 'Roi', 'Valet'])
const drawTimestamp = ref(Date.now())

const drawCards = async () => {
  const { data } = await useFetch('http://localhost:8000/api/card-game/play', {
    method: 'POST',
    body: { 
      count: count.value, 
      suitOrder: suitOrder.value,
      valueOrder: valueOrder.value 
    }
  })
  results.value = data.value
  drawTimestamp.value = Date.now()

  if (data.value) {
    unsortedHand.value = data.value.unsortedHand
    drawTimestamp.value = Date.now() 
  }
}

onMounted(() => {
  suitOrder.value = [...suitOrder.value].sort(() => Math.random() - 0.5)
  valueOrder.value = [...valueOrder.value].sort(() => Math.random() - 0.5)
})
</script>