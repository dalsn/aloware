<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header h4">
                        Lorem Ipsum
                    </div>

                    <div class="card-body text-justify">
                        <h5>What is Lorem Ipsum?</h5>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                        <h5>Where does it come from?</h5>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>

                        <p class="font-italic mb-0">Culled from: <a href="https://lipsum.com">Lipsum.com</a></p>
                    </div>

                    <div class="card-footer">
                        <h5 class="mb-1 font-weight-bolder">
                            Comments
                        </h5>
                        <!-- <div class="mb-2">
                            <span v-show="!reply" class="text-primary reply" @click="toggleReplyPane">Add Comment</span>

                            <span v-show="reply" class="text-danger reply" @click="toggleReplyPane">Hide</span>
                        </div> -->

                        <Reply :reply="reply" @savedComment="refreshComments" />

                        <div class="mt-4">
                            <template v-for="comment in comments">
                                <Comment :comment="comment" @savedComment="getComments" />
                                <template v-for="comment in comment.comments">
                                    <Comment level="2" :comment="comment" @savedComment="getComments" />
                                    <template v-for="comment in comment.comments">
                                        <Comment level="3" :replyable="false" :comment="comment" @savedComment="getComments" />
                                    </template>
                                </template>
                            </template>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-sm btn-secondary" v-show="links.prev" @click="goPrev">Previous</button>
                            <button class="btn btn-sm btn-secondary ml-2" v-show="links.next" @click="goNext">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Comment from './Comment.vue'
    import Reply from './Reply.vue'
    export default {
        name: 'Blog',
        components: {
            Comment,
            Reply
        },
        mounted() {
            this.getComments()
        },
        data () {
            return {
                comments: [],
                links: {},
                reply: true,
                url: 'api/comments?page=1',
                perPage: 3
            }
        },
        methods: {
            refreshComments() {
                this.getComments()
            },
            goNext() {
                this.url = new URL(this.links.next);
                this.getComments()
            },
            goPrev() {
                this.url = new URL(this.links.prev);
                this.getComments()
            },
            getComments() {
                return axios.get(`${this.url}&perPage=${this.perPage}`)
                    .then(response => {
                        this.comments = response.data.data
                        this.links = response.data.links
                    })
                    .catch(error => {
                        console.log(error)
                        alert(error.message)
                    })
            }
        }
    }
</script>

<style>
    .reply {
        cursor: pointer;
    }  
</style>
