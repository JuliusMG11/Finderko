<template>
	<div>
		<router-link :to="`/admin/${resource}s/${id}`">
			<span class="icon"><i class="mdi mdi-eye-outline"></i></span>
		</router-link>

		<router-link :to="`/admin/${resource}s/${id}/edit`">
			<span class="icon"><i class="mdi mdi-pencil-outline"></i></span>
		</router-link>

		<a @click="deleteResource">
			<span class="icon"><i class="mdi mdi-trash-can-outline"></i></span>
		</a>
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
	methods: {
		deleteResource() {
			if (window.confirm("are you sure? there's no going back!")) {
				axios
					.delete(`/api/${this.resource}s/${this.id}`, this.data)
					.then(response => {
						console.log(response)
						axios.get(`/api/${this.resource}s`).then(response => {
							this.$root.$emit('update', response.data)
						})
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
div {
	display: flex;
	justify-content: center;
}

a {
	border: none;
}
</style>