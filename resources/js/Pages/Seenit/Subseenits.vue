<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Subseenits
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div class="mt-8">
                            <h1 class="text-3xl font-bold">Subseenits</h1>
                        </div>
                        <div v-for="subseenit in subseenits" class="bg-gray-100 rounded-2xl border p-5">
                            <div>
                                <h1 class="text-2xl font-bold"><a :href="`/s/${subseenit.slug}`">{{ subseenit.name }}</a></h1>
                            </div>
                            <div class="mt-6 text-gray-500">
                                {{ subseenit.description }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
export default {
    components: {
      AppLayout
    },
    props: {
        subseenits: Object
    }
}
</script>
