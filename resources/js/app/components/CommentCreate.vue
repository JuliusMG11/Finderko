<script>
export default {

	data() {
		return {
			text: '',
			errors: {},
		}
	},

	methods: {
		addComment() {
			let data = {
				post_id: this.$refs.postid.value,
				text: this.text,
				user_id: this.$refs.userid.value,
			}

			axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.$refs.apitoken.value;

			axios
				.post('/api/comments', data)
				.then(response => {
					this.$root.$emit('flash', response.data.message)
					this.$router.go()
				})
				.catch(errors => {
					this.errors = errors.response.data.errors
				})
		},
	}
}
</script>


<style lang="scss" scoped>
[contenteditable='true'] {
	box-shadow: 0 2px 0 #fff;
	outline: none;
}
</style>