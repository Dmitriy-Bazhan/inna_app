<template>
    <div class="chat-block">
        <ul >
            <li v-for="comment in comments" >
                {{comment.message}}
            </li>
        </ul>

    </div>
</template>

<script>
export default {
    name: "test",
    data() {
        return {
            comments: []
        }
    },
    methods : {
        getComments() {
            axios.get('/api/getComments/' + $('body').attr('data-user-id'))
                .then( (response) => {
                    console.log(response.data);
                    this.comments = response.data.comments;
                });
        }
    },
    mounted() {
        this.getComments();
    }
}
</script>

<style scoped>
.chat-block{
    position: fixed;
    top: 25%;
    left: 25%;
    width: 25%;
    height: 25%;
    background-color: red;
}
</style>
