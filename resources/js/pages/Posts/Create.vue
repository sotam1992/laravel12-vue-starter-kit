<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Post Create',
        href: '/posts/create',
    },
];
const form = useForm({
    title:"",
    body:""
})
function submit() {
    form.post(route("posts.store"), {
        preserveScroll:true,
        onSuccess: () =>form.reset()
    });
}
</script>

<template>
    <Head title="Post Create" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
                <Link href="/posts" class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">Back</Link>
            </div>
            <form @submit.prevent="submit">
                <div class="grid gap-2">
                    <Label for="email">Title</Label>
                    <Input
                        id="title"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.title"
                        placeholder="Title"
                    />
                    <InputError class="mt-2" :message="form.errors.title" />
                </div>
                <div class="grid gap-2 mt-5">
                    <Label for="email">body</Label>
                    <textarea
                        id="title"
                        type="text"
                        class="mt-1 block w-full file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input flex h-15 min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                        v-model="form.body"
                        placeholder="body"
                    ></textarea>
                    <InputError class="mt-2" :message="form.errors.body" />
                </div>
                <div class="flex items-center gap-4 mt-5">
                    <Button >Submit</Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
