<template>
    <div class="row panel-footer form-group">
        <input type="text" placeholder="search users?" v-model="query" v-on:keyup="autoComplete" class="form-control">
        <div>
            <ul class="list-group">
            <li class="list-group-item" v-if='results.length === 0'>There are no result!</li>
             <li class="list-group-item" v-for="result in results">
                {{ result.name }}
             </li>
            </ul>
        </div>
    </div>
</template>

<script>

    export default{
    data(){
        return {
            query: '',
            results: []
        }
        },
    methods: {
    autoComplete(){

        this.results = [];
        if(this.query.length > 1){
            axios.get('/api/search',{params: {query: this.query}}).then(response => {
            this.results = response.data;
            });
        }
      }
    }

    }

</script>