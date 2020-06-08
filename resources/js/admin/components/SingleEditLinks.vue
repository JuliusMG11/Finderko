<template>
	<div class="field is-grouped">
		<p class="control" v-if="resources">
			<router-link
				:to="`/admin/${resource}s/new`"
				class="button is-success"
			>
				create new
			</router-link>
		</p>
		<p class="control">
			<router-link
				:to="`/admin/${resource}s/${id}/edit`"
				class="button is-info is-outlined"
			>
				<span class="icon"><i class="mdi mdi-pencil-outline"></i></span>
				&nbsp; edit {{ resource }}
			</router-link>
		</p>
		<p class="control">
			<a
				@click="deleteResource"
				class="button is-danger is-outlined"
			>
				<span class="icon"><i class="mdi mdi-trash-can-outline"></i></span>
				&nbsp; delete {{ resource }}
			</a>
		</p>
	</div>
</template>


<script>
export default {
	props: ['resource', 'id'],
	data() {
		return {
			data: {
				user_id: document.querySelector("meta[name='user_id']").getAttribute('content')
			}
		}
	},
	computed: {
		resources() {
			if (this.resource === 'user') {
				return false
			} else {
				return true
			}
		}
	},
	methods: {
		deleteResource() {
			if (window.confirm("are you sure? there's no going back!")) {
				axios
					.delete(`/api/${this.resource}s/${this.id}`, this.data)
					.then(response => {
						this.$router.push(`/admin/${this.resource}s`)
						this.$root.$emit('deleted', this.resource)
						this.$root.$emit('flash', response.data.message)
					})
					.catch(errors => {
						if(errors.message.includes(403)) {
							this.$root.$emit('flash', 'You are not permitted to perform this action')
						}
					})
			}
		}
	}
}
</script>


<style lang="scss" scoped>
</style>