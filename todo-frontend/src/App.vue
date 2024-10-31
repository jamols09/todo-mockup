<script setup lang="ts"></script>

<template>
  <div class="min-h-screen flex flex-col">
    <!-- Main Content Area -->
    <div class="flex flex-1 container mx-auto">
      <!-- Main Content -->
      <main class="flex-1 p-4">
        <RouterView />
      </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
      <p>&copy; 2024 My Nuxt App. All rights reserved.</p>
    </footer>
  </div>
</template>
