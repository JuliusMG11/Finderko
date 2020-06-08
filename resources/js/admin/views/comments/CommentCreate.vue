<template>
	<div>
		<h1 class="title">create new comment</h1>

		<div class="field" v-if="postsReady">
			<label class="label">Assign to Post</label>
			<div class="select is-rounded">
				<select ref="option">
					<option v-for="(title, index) in posts" :key="index">
						{{ title }}
					</option>
				</select>
			</div>
			<div v-if="errors.post_id">
				<p
					class="help is-danger"
					v-for="(error, index) in errors.post_id"
					:key="index"
				>
					{{ error }}
				</p>
			</div>
		</div>

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
			posts: {},
			postsReady: false,
			text: ''
		}
	},
	methods: {
		submitForm() {
			let data = {
				user_id: document.querySelector("meta[name='user_id']").getAttribute('content'),
				text: this.text,
				post_id: this.$refs.option.value.split(' - ')[0]
			}

			axios
				.post('/api/comments', data)
				.then(response => {
					this.$router.push(`/admin/comments/${response.data.comment.id}`)
					this.$root.$emit('new', 'comment')
					this.$root.$emit('flash', response.data.message)
				})
				.catch(errors => {
					this.errors = errors.response.data.errors
				})
		}
	},
	mounted () {
		axios.get('/api/posts'). then(response => {
			response.data.forEach((element, index) => {
				this.posts[index] = element.id + ' - ' + element.title
			});
			this.postsReady = true
		});
		document.addEventListener('trix-change', () => {
			this.text = document.getElementById('x').value
		})
	}
}
</script>
