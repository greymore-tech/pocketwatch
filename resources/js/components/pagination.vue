<template>
    <nav>
        <span style="border-right: solid black; border-right-width: thin;">{{pagination.from}} - {{pagination.to}} of {{pagination.total}}    </span> 
        <a v-if="pagination.prevPageUrl" @click="$emit('prev');" class="btn btn-primary" style="color:white; margin-left:5px;">Prev</a>
        <a v-else :disabled="true" style="margin-left:10px;">Prev</a>
        <a v-if="pagination.nextPageUrl" @click="$emit('next');" class="btn btn-primary" style="color:white;">Next</a>
        <a v-else :disabled="true">Next</a>
    </nav>
</template>

<script>
    export default {
        props:['pagination']
    }
</script>