<template>
	<div>
		<h1 class="title">create new post</h1>

		<post-create-form
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
			errors: {}
		}
	},
	components: {
		PostCreateForm
	},
	methods: {
		submitForm(data) {
			axios
				.post('/api/posts', data)
				.then(response => {
					this.$router.push(`/admin/posts/${response.data.post.id}`)
					this.$root.$emit('new', 'post')
					this.$root.$emit('flash', response.data.message)
				})
				.catch(errors => {
					this.errors = errors.response.data.errors
				})
		}
	}
}
</script>
