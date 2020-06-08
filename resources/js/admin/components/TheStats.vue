<template>

	<nav class="level is-mobile is-hidden-mobile" v-if="ready">
		<div class="level-item has-text-centered box">
			<div>
				<p class="heading">Jobs</p>
				<p class="title">{{ post }}</p>
			</div>
		</div>
		<div class="level-item has-text-centered box">
			<div>
				<p class="heading">Comments</p>
				<p class="title">{{ comment }}</p>
			</div>
		</div>
		<div class="level-item has-text-centered box">
			<div>
				<p class="heading">Users</p>
				<p class="title">{{ user }}</p>
			</div>
		</div>
	</nav>

</template>


<script>
export default {
	data() {
		return {
			post: 0,
			comment: 0,
			user: 0,
			ready: false
		}
	},
	methods: {
		decrease(data) {
			if (data === 'comment') {
				this.comment--
			} else if (data === 'post') {
				this.post--
			} else if (data === 'user') {
				this.user--
			}
		},
		increase(data) {
			if (data === 'comment') {
				this.comment++
			} else if (data === 'post') {
				this.post++
			}
		}
	},
	mounted () {
		axios.get('/api/posts/')
			.then(response => {
				this.post = response.data.length
			});
		axios.get('/api/comments/')
			.then(response => {
				this.comment = response.data.length
			});
		axios.get('/api/users/')
			.then(response => {
				this.user = response.data.length
				this.ready = true
			});

		this.$root.$on('deleted', data => this.decrease(data))
		this.$root.$on('new', data => this.increase(data))
	}
}
</script>


<style lang="scss" scoped>
.level {
	margin-bottom: 2.5em;
}

.level-item {
	flex-basis: 20%;
	white-space: nowrap;
}
</style>