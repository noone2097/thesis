<script setup lang="ts">
import type { HTMLAttributes } from 'vue'
import { cn } from '@/lib/utils'
import { AvatarImage } from 'radix-vue'

defineProps<{
  class?: HTMLAttributes['class']
  src?: string
  alt?: string
}>()
</script>

<template>
  <AvatarImage
    :src="src"
    :alt="alt"
    :class="cn('aspect-square h-full w-full object-cover', $props.class)"
  />
</template>
