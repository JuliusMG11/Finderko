<template>

	<div>
		<div class="navbar-brand">
			<strong>JOBSEEKER</strong>
		</div>

		<nav class="is-hidden-mobile">
			<h5 class="heading">ADMIN</h5>

			<router-link to="/admin/">Dashboard</router-link>

			<h5 class="heading">RESOURCES</h5>

			<router-link to="/admin/posts">Jobs</router-link>
			<router-link to="/admin/comments">Comments</router-link>
			<router-link to="/admin/users">Users</router-link>

			<h5 class="heading">GENERAL</h5>

			<a href="/">Homepage</a>
			<a href="/logout" @click="logout">
			Logout
			</a>
			<form id="logout-form" action="/logout" method="POST" type="hidden">
				<input type="hidden" name="_token" :value="csrf">
			</form>
		</nav>
	</div>

</template>


<script>
export default {
	data() {
		return {
			csrf: ''
		}
	},
	methods: {
		logout() {
			event.preventDefault()
			document.getElementById('logout-form').submit()
		}
	},
	mounted () {
		this.csrf = document.querySelector("meta[name='csrf-token'").content
	},
}
</script>


<style lang="scss" scoped>
.heading {
	margin-top: 4em;
}
</style>