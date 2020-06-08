<template>
	<div>
		<h1 class="title">edit post</h1>

		<post-create-form
			:post="post"
			:errors="errors"
			@post-form-submitted="submitForm"
		/>
	</div>
</template>


<script>
import PostCreateForm from './PostCreateForm'

export default {
	data() {
		return {
			errors: {},
			post: {}
		}
	},
	components: {
		PostCreateForm
	},
	methods: {
		submitForm(data) {
			let id = this.$route.params.id

			axios
				.patch(`/api/posts/${id}`, data)
				.then(response => {
					this.$router.push(`/admin/posts/${id}`)
					this.$root.$emit('flash', response.data.message)
				})
				.catch(errors => {
					if(errors.message.includes(403)) {
						this.$root.$emit('flash', 'You are not permitted to perform this action')
						this.$router.go(-1)
					}
					this.errors = errors.response.data.errors
				})
		}
	},
	created() {
		axios.get('/api/posts/' + this.$route.params.id).then(response => {
			this.post = response.data
		})
	}
}
</script>
