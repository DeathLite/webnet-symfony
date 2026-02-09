<template>
  <div ref="cardRef" class="card-container">
    <div class="card-content" :class="suitColor">
      <div class="top-left">
        <span class="value">{{ value }}</span>
        <span class="suit">{{ suitIcon }}</span>
      </div>
      <div class="center-icon">{{ suitIcon }}</div>
      <div class="bottom-right">
        <span class="value">{{ value }}</span>
        <span class="suit">{{ suitIcon }}</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import gsap from 'gsap'

const props = defineProps({
  cardString: String,
  index: Number
})
const cardRef = ref(null)

const [value, suit] = props.cardString.split(' ')

const suitIcon = computed(() => {
  const icons = { 'Cœur': '♥', 'Carreau': '♦', 'Pique': '♠', 'Trèfle': '♣' }
  return icons[suit] || suit
})

const suitColor = computed(() => 
  (['Cœur', 'Carreau'].includes(suit)) ? 'text-red-600' : 'text-gray-900'
)

onMounted(() => {
  gsap.from(cardRef.value, {
    scale: 0.5,
    y: 30,
    opacity: 0,
    rotation: Math.random() * 10 - 5,
    duration: 0.4,
    delay: props.index * 0.03,
    ease: "back.out(1.7)"
  })
})
</script>

<style scoped>
.card-container {
  @apply w-28 h-40 bg-white rounded-xl shadow-[0_10px_20px_rgba(0,0,0,0.3)] p-3 relative flex flex-col justify-between border border-gray-200;
  background: linear-gradient(135deg, #ffffff 0%, #f3f4f6 100%);
}
.card-content { @apply h-full flex flex-col justify-between font-serif; }
.value { @apply text-2xl font-black; }
.suit { @apply text-xl; }
.center-icon { @apply text-5xl opacity-10 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2; }
</style>