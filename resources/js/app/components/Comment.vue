<script>
export default {
	props: ['comment-data'],

	data() {
		return {
			editing: false,
			newText: '',
			oldText: '',
			commentText: '',
			formEditing: false
		}
	},

	mounted() {
		this.oldText = this.newText = this.commentData.text
	},

	methods: {
		editComment() {
			this.formEditing = false
			setTimeout( () => {
				this.$router.go('/' + window.location.href)
			}, 100)
		},

		deleteC() {
			setTimeout( () => {
				this.$router.go('/' + window.location.href)
			}, 100)
		},

		newEdit() {
			this.formEditing = true
			this.oldText = this.$refs.input.textContent
		},

		cancelEdit(e) {
			e.preventDefault();
			
			this.formEditing = false

			this.$refs.commentEditArea.value = this.newText
			
		},

		startEditing() {
			this.editing = true
			this.selectText()
		},

		resetText() {
			this.editing = false
			this.$refs.input.innerText = this.oldText
		},

		textChanged() {
			this.newText = this.$refs.input.innerText
		},

		updateComment() {
			this.editing = false

			axios.patch('/comments/' + this.commentData.id, {
				text: this.newText
			})

			this.$root.$emit('flash', 'comment updated')
			this.oldText = this.newText
		},

		deleteComment() {
			if (window.confirm('are you sure??')) {
				axios.delete('/comments/' + this.commentData.id)
				this.$root.$emit('flash', 'comment deleted')
				this.$el.remove()
			}
		},

		selectText() {
			setTimeout(() => {
				let p = this.$refs.input,
					s = window.getSelection(),
					r = document.createRange()
				r.setStart(p, 0)
				r.setEnd(p, 1)
				s.removeAllRanges()
				s.addRange(r)
				p.focus()
			}, 0)
		}
	}
}
</script>


<style lang="scss" scoped>
[contenteditable='true'] {
	box-shadow: 0 2px 0 #fff;
	outline: none;
}
</style>