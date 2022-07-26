<template>
	<div class="mt-2" :class="{'ml-2': level == 2, 'ml-4': level == 3}">
		<div class="media">
			<div class="media-body">
				<div class="mt-0 mb-1">
					<span class="h6 font-weight-bold">{{ comment.name }}</span> <span class="font-italic">{{ commented_at }}</span> 
				</div>
				<p class="mb-1">
					<span class="body font-italic">{{ comment.body }}</span>

					<span v-if="replyable" v-show="!reply" class="text-primary reply" @click="toggleReplyPane">Reply</span>

					<span v-show="reply" class="text-danger reply" @click="toggleReplyPane">Hide</span>
				</p>
			</div>
		</div>

		<Reply :parentId="comment.id" v-if="replyable" :reply="reply" @savedComment="savedComment" />
	</div>
</template>

<script>
	import moment from 'moment'
	import Reply from './Reply.vue'
	export default {
		name: 'Comment',
		components: {
			Reply
		},
		props: {
			level: { 
				type: String,
				default: '1'
			},
			replyable: {
				type: Boolean,
				default: true
			},
			comment: {
				type: Object,
				required: true
			}
		},
		computed: {
			commented_at() {
				return moment(this.comment.created_at).fromNow()
			}
		},
		data () {
			return {
				reply: false
			}
		},
		methods: {
			toggleReplyPane() {
				this.reply = !this.reply
			},
			savedComment() {
				this.$emit('savedComment')
				this.toggleReplyPane()
			}
		}
    }
</script>

<style scoped>
	p .body {
		overflow-wrap: anywhere;
		text-align: justify;
	}

	.reply {
        margin-left: 0.5rem;
    }  
</style>