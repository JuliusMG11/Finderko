<template>
	<div>
		<h1 class="title">edit user</h1>

		<div class="field">
			<label class="label">Name</label>
			<div class="control">
				<input
					class="input"
					:class="{ 'is-danger': errors.name }"
					type="text"
					placeholder="name"
					name="name"
					v-model="name"
				>
			</div>
			<div v-if="errors.name">
				<p
					class="help is-danger"
					v-for="(error, index) in errors.name"
					:key="index"
				>
					{{ error }}
				</p>
			</div>
		</div>

		<div class="field">
			<label class="label">Email</label>
			<div class="control">
				<input
					class="input"
					:class="{ 'is-danger': errors.email }"
					type="text"
					placeholder="email"
					name="email"
					v-model="email"
				>
			</div>
			<div v-if="errors.email">
				<p
					class="help is-danger"
					v-for="(error, index) in errors.email"
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
			name: '',
			email: ''
		}
	},
	methods: {
		submitForm() {
			let id = this.$route.params.id
			let data = {
				name: this.name,
				email: this.email,
				user_id: document.querySelector("meta[name='user_id']").getAttribute('content')
			}
			axios
				.patch(`/api/users/${id}`, data)
				.then(response => {
					this.$router.push(`/admin/users/${id}`)
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
		axios.get('/api/users/' + this.$route.params.id).then(response => {
			this.name = response.data.name
			this.email = response.data.email
		})
	}
}
</script>
