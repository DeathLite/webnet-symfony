<template>
  <div class="space-y-6">
    <div class="bg-slate-800/50 p-4 rounded-xl border border-slate-700">
      <h4 class="text-xs font-bold text-emerald-400 uppercase mb-3 tracking-widest">Ordre des Couleurs</h4>
      <draggable v-model="localSuits" item-key="id" class="space-y-2">
        <template #item="{ element }">
          <div class="p-2 bg-slate-700 rounded border border-slate-600 cursor-grab active:cursor-grabbing hover:bg-slate-600 transition-colors text-sm flex justify-between items-center">
            <span>{{ element }}</span>
            <span class="text-slate-500 text-xs">☰</span>
          </div>
        </template>
      </draggable>
    </div>

    <div class="bg-slate-800/50 p-4 rounded-xl border border-slate-700">
      <h4 class="text-xs font-bold text-cyan-400 uppercase mb-3 tracking-widest">Ordre des Valeurs</h4>
      <draggable v-model="localValues" item-key="id" class="grid grid-cols-1 gap-2">
        <template #item="{ element }">
          <div class="p-2 bg-slate-700 rounded border border-slate-600 cursor-grab active:cursor-grabbing hover:bg-slate-600 transition-colors text-[10px] flex justify-between items-center">
            <span>{{ element }}</span>
            <span class="text-slate-500">☰</span>
          </div>
        </template>
      </draggable>
    </div>
  </div>
</template>

<script setup>
import draggable from 'vuedraggable'
import { computed } from 'vue'

const props = defineProps(['suits', 'values'])
const emit = defineEmits(['update:suits', 'update:values'])

const localSuits = computed({
  get: () => props.suits,
  set: (val) => emit('update:suits', val)
})

const localValues = computed({
  get: () => props.values,
  set: (val) => emit('update:values', val)
})
</script>