<template>
    <div class="card-columns">
        <div v-for="dynamic in dynamics" :key="dynamic.id" class="card card-img">
            <div class="mg-news-img">
                <img v-for="image in dynamic.pic" :src="image">
            </div>
            <div class="p-2">
                <p class="card-text mt-2 mb-0">
                    <router-link :to="{ name: 'Dynamic', params: { id: dynamic.id }}">{{ dynamic.content }}</router-link>
                </p>
                <p class="card-text">
                    <small class="text-muted">
                        <svg id="i-clock" viewBox="0 0 32 32" width="10" height="10" fill="none"
                             stroke="currentcolor" stroke-linecap="round"
                             stroke-linejoin="round"
                             stroke-width="2">
                            <circle cx="16" cy="16" r="14"/>
                            <path d="M16 8 L16 16 20 20"/>
                        </svg>
                        {{ dynamic.published_at }}
                    </small>
                </p>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props:['dynamics']
    }
</script>
<style>
    .mg-news-img {
        background: #f5f8fa;
    }

    .mg-news-img img {
        width: 72px;
        margin: 0 1px 1px 0;
    }

    .mg-news .card-img {
        border-top-left-radius: 0.5rem !important;
    }

    .mg-news-img img:first-child {
        border-top-left-radius: 0.5rem !important;
    }

    .mg-news-img img:last-child {
        border-bottom-right-radius: 0.5rem !important;
    }
</style>
