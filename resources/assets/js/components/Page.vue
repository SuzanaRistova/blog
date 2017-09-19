<template>
    <div class='row panel-footer'>
        <h4>Add new page</h4>
        <form action="#" @submit.prevent="createPage()">
            <div class="form-group">
                <input v-model="page.title"  placeholder="Title" type="text" name="title" class="form-control form-group" autofocus>
                <input v-model="page.slug" placeholder="Slug" type="text" name="slug" class="form-control form-group">
                <input v-model="page.content" placeholder="Content" type="text" name="content" class="form-control form-group">
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
                axios.delete('vue/page/delete/' + id)
                    .then((res) => {
                        this.fetchPageList()
                    })
                    .catch((err) => console.error(err));
            },
        }
    }
</script>
</script>