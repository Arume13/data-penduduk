<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
  title: String,
  value: Number,
  icon: String,
  color: String,
  trend: String,
  description: String
});

const iconClass = computed(() => {
  return {
    'users': 'fas fa-users',
    'user-group': 'fas fa-user-group',
    'home': 'fas fa-home'
  }[props.icon || 'users'];
});
</script>

<template>
  <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
    <div class="flex items-start justify-between">
      <div>
        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
          {{ title }}
        </p>
        <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">
          {{ value }}
        </p>
      </div>
      <div class="p-3 rounded-full" :class="color">
        <i :class="iconClass + ' text-white text-lg'"></i>
      </div>
    </div>
    <div v-if="trend || description" class="mt-1">
      <span class="text-sm" :class="trend?.includes('increase') ? 'text-green-600' : 'text-red-600'">
        {{ trend }}
      </span>
      <p v-if="description" class="text-xs text-gray-500 dark:text-gray-400">
        {{ description }}
      </p>
    </div>
  </div>
</template>

<style scoped>
/* Animasi hover ring */
.animate-hover:hover {
  transform: translateY(-2px);
  transition: all 0.2s ease;
}
</style>
