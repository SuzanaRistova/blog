<template>
    <div class='row'>
        <h1>My Pages</h1>
        <h4>New Pages</h4>
        <form action="#" @submit.prevent="createPage()">
            <div class="input-group">
                <input v-model="page.title" type="text" name="title" class="form-control" autofocus>
                <input v-model="page.slug" type="text" name="slug" class="form-control">
                <input v-model="page.content" type="text" name="content" class="form-control">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">New Page</button>
                </span>
            </div>
        </form>
        <h4>All Pages</h4>
        <ul class="list-group">
            <li v-if='list.length === 0'>There are no pages yet!</li>
            <li class="list-group-item" v-for="(page, index) in list">
                 {{ page.title }}
                 <button @click="deletePage(page.id)" class="btn btn-danger btn-xs pull-right">Delete</button>
            </li>
        </ul>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                list: [],
                page: {
                    user_id: '',
                    title: '',
                    slug: '',
                    content: '',
                }
            };
        },
        
        created() {
            this.fetchPageList();
        },
        
        methods: {
            fetchPageList() {
                axios.get('vue/pages').then((res) => {
                    this.list = res.data;
                });
            },
 
            createPage() {
                axios.post('vue/pages', this.page)
                    .then((res) => {
                        this.page.title = '';
                        this.page.slug = '';
                        this.page.content = '';
                        this.edit = false;
                        this.fetchPageList();
                    })
                    .catch((err) => console.error(err));
            },
 
            deletePage(id) {
                axios.get('vue/page/delete/' + id)
                    .then((res) => {
                        this.fetchPageList()
                    })
                    .catch((err) => console.error(err));
            },
        }
    }
</script>
</script>