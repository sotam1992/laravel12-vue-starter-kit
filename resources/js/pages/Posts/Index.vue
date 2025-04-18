<script setup lang="ts">
import { ref, computed } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head, Link, useForm } from '@inertiajs/vue3'

// Post type interface
interface Post {
  id: number
  title: string
  body: string
}

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Posts',
    href: '/posts',
  },
]

const props = defineProps<{
  posts: {
    data: Post[]
    links: {
      url: string | null
      label: string
      active: boolean
    }[]
  }
}>()

const form = useForm({})

const deletePost = (id: number) => {
  if (confirm('Are you sure you want to delete this post?')) {
    form.delete(route('posts.destroy', id), {
      preserveScroll: true,
    })
  }
}

const currentPage = computed(() =>
  props.posts.links.find((link) => link.active)?.label
)

const visibleLinks = computed(() => {
  const totalLinks = props.posts.links
  const maxVisible = 5
  const numericLinks = totalLinks.filter(link => Number(link.label))
  const currentIndex = numericLinks.findIndex(link => Number(link.label) === Number(currentPage.value))
  const totalPages = numericLinks.length

  let start = Math.max(0, currentIndex - 2)
  let end = Math.min(start + maxVisible, totalPages)

  if (end - start < maxVisible) {
    start = Math.max(0, end - maxVisible)
  }

  return {
    previous: totalLinks[0],
    next: totalLinks[totalLinks.length - 1],
    pages: numericLinks.slice(start, end)
  }
})
</script>

<template>
  <Head title="Posts" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 bg-white dark:bg-black transition-colors duration-300">
      <div>
        <Link href="/posts/create" class="px-3 py-1 text-sm text-white bg-green-500 rounded hover:bg-green-600">Create</Link>
      </div>

      <div class="overflow-x-auto rounded-xl border border-sidebar-border/70 dark:border-sidebar-border bg-white dark:bg-[#121212] shadow">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
          <thead class="bg-gray-50 dark:bg-[#1e1e1e]">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">#ID</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Title</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Body</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white dark:bg-black divide-y divide-gray-200 dark:divide-gray-800">
            <tr v-for="post in props.posts.data" :key="post.id">
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ post.id }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ post.title }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ post.body }}</td>
              <td class="px-6 py-4 whitespace-nowrap space-x-2">
                <Link :href="`/posts/${post.id}/edit`" class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">
                  Edit
                </Link>
                <button @click="deletePost(post.id)" class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600">
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="flex justify-end items-center mt-6 space-x-1">
        <Link
          v-if="visibleLinks.previous.url"
          :href="visibleLinks.previous.url"
          preserve-scroll
          class="px-3 py-1.5 rounded-md border text-sm font-medium bg-white dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800"
        >
          Prev
        </Link>

        <Link
          v-for="(link, index) in visibleLinks.pages"
          :key="index"
          :href="link.url ?? '#'"
          preserve-scroll
          class="px-3 py-1.5 rounded-md border text-sm font-medium transition-all duration-200"
          :class="{
            'bg-blue-600 text-white border-blue-600 hover:bg-blue-700': link.active,
            'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800': !link.active && link.url,
            'pointer-events-none opacity-50': !link.url
          }"
          v-html="link.label"
        />

        <Link
          v-if="visibleLinks.next.url"
          :href="visibleLinks.next.url"
          preserve-scroll
          class="px-3 py-1.5 rounded-md border text-sm font-medium bg-white dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800"
        >
          Next
        </Link>
      </div>
    </div>
  </AppLayout>
</template>
