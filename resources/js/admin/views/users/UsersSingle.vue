<template>
	<div>
        <table class="table meta">
			<tr>
				<td>
					<strong>id:</strong>
				</td>
				<td>
					{{ user.id }}
				</td>
			</tr>
			<tr>
				<td>
					<strong>name:</strong>
				</td>
				<td>
					{{ user.name }}
				</td>
			</tr>
            <tr>
				<td>
					<strong>email:</strong>
				</td>
				<td>
					{{ user.email }}
				</td>
			</tr>
			<tr>
				<td>
					<strong>created at:</strong>
				</td>
				<td>
					{{ user.created_at }}
				</td>
			</tr>
		</table>

		<single-edit-links
			resource="user"
			:id="user.id"
		/>

	</div>
</template>


<script>
import SingleEditLinks from '../../components/SingleEditLinks'

export default {
	data() {
		return {
			user: {},
			token: ''
		}
	},
	components: {
		SingleEditLinks
	},
	methods: {
renewToken() {
			this.token = ''

			axios.get('/renewToken').then(response =>
				this.token = response.data.token)  
				axios
					.get('/api/users/' + this.$route.params.id)
					.then(response => {
						this.user = response.data
					})
					.catch(error => {
						return this.$router.push('/404')
					})
		}
	},
	created() {
		axios
			.get('/api/users/' + this.$route.params.id)
			.then(response => {
				this.user = response.data
			})
			.catch(error => {
				return this.$router.push('/404')
			})
	}
}

</script>


<style lang="scss" scoped>
div .control {
	width: 100%;
}
</style>