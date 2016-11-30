<template>
    <ul class="pagination pagination-sm no-margin pull-right">
        <li><a href="#">&laquo;</a></li>
        <li v-for="n in paginationRange">
        <a href="#" @click.prevent="pageChanged(n)">{{ n }}</a>
        </li>
        <li><a href="#">&raquo;</a></li>
    </ul>


</template>
<style>

</style>
<script>
export default{

    methods: {
        lowerBound (num, limit) {
            return num >= limit ? num : limit
        }
    }

}
</script>
