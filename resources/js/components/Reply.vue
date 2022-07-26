<template>
	<div v-show="reply" class="text-right">
		<div class="form-group mb-2">
			<input class="form-control" id="name" v-model="newComment.name" placeholder="Your Name" />
		</div>
		<div class="form-group mb-2">
			<textarea class="form-control" rows="2" id="comment" v-model="newComment.body" placeholder="Comment"></textarea>
		</div>
		<button class="btn btn-sm btn-success pull-right px-3" @click="sendComment">Send</button>
	</div>
</template>

<script>
	export default {
		name: 'Reply',
		props: {
			reply: {
				type: Boolean,
				default: false
			},
			parentId: {
				type: Number,
				default: null
			}
		},
		data () {
			return {
				newComment: {
					name: '',
					body: ''
				}
			}
		},
		methods: {
			reset() {
				this.newComment.name = ''
				this.newComment.body = ''
			},
			sendComment() {
				let comment = {
					parent_id: this.parentId,
					...this.newComment
				}

				axios.post('api/comments', comment)
					.then(response => {
						this.$emit('savedComment')
						this.reset()
					})
					.catch(error => {
						console.log(error)
						alert(error.message)
					})
			}
		}
	}
</script>