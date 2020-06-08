<template>
	<div>
		<h1 class="title">edit comment</h1>

		<div class="field">
			<label class="label">Text</label>
			<div class="control content">
				<input
					id="x"
					:value="text"
					type="hidden"
					name="text"
				>
				<trix-editor
					input="x"
					:class="{ 'input is-danger': errors.text }"
				></trix-editor>
			</div>
			<div v-if="errors.text">
				<p
					class="help is-danger"
					v-for="(error, index) in errors.text"
					:key="index"
				>
					{{ error }}
				</p>
			</div>
		</div>

		<div class="field is-grouped">
			<div class="control">
				<button
					@click="submitForm"
					class="button is-primary"
				>Submit</button>
			</div>
			<div class="control">
				<button
					@click="$router.go(-1)"
					class="button is-text"
				>Cancel</button>
			</div>
		</div>
	</div>
</template>


<script>
import trix from 'trix'

export default {
	data() {
		return {
			errors: {},
			comment: {},
			text: ''
		}
	},
	methods: {
		submitForm() {
			let id = this.$route.params.id
			let data = {
				text: this.text,
				user_id: document.querySelector("meta[name='user_id']").getAttribute('content')
			}
			axios
				.patch(`/api/comments/${id}`, data)
				.then(response => {
					this.$router.push(`/admin/comments/${id}`)
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
	mounted() {
		document.addEventListener('trix-change', () => {
			this.text = document.getElementById('x').value
		})
	},
	created() {
		axios.get('/api/comments/' + this.$route.params.id).then(response => {
			this.comment = response.data
		})
	},
	watch: {
		comment(comment) {
			this.text = comment.text

			let trix = document.querySelector('trix-editor')
			trix.editor.insertHTML(comment.text)
		}
	}
}
</script>
