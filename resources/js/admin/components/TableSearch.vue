<template>
	<nav class="level">
		<!-- Left side -->
		<div class="level-left">
			<div class="level-item">
				<p class="subtitle is-5"  v-if="loaded">
					<strong>{{ count }} of {{ total }}</strong> {{ resource }}s
				</p>
			</div>
			<div class="level-item">
				<div class="field has-addons">
					<p class="control">
						<input
							class="input"
							type="text"
							:placeholder="'find a ' + resource"
							v-model="searchQuery"
							ref="search"
						>
					</p>
					<p class="control" v-if="clear">
						<button class="button" v-on:click="clearSearch">
							X
						</button>
					</p>
				</div>
			</div>
		</div>

		<!-- Right side -->
		<div class="level-right" v-if="resources">
			<p class="level-item">
				<router-link
					:to="`/admin/${resource}s/new`"
					class="button is-success"
				>New {{ resource }}</router-link>
			</p>
		</div>
	</nav>
</template>


<script>
export default {
	props: {
		count: {
			type: Number,
			default: 0
		},
		resource: {
			type: String
		},
		loaded: {
			type: Boolean,
			default: false
		},
		total: {
			type: Number,
			default: 0
		}
	},
	data() {
		return {
			searchQuery: '',
			clear: false
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
		checkCount() {
			return this.loaded = true
		},
		clearSearch() {
			this.$emit('searchQueryChanged', '')
			this.clear = false

			setTimeout( () => {
				this.$refs.search.value = ''
			}, 1)
		}
	},
	watch: {
		searchQuery(value) {
			this.$emit('searchQueryChanged', value)
			if (value.length > 0) {
				this.clear = true
			} else {
				this.clear = false
			}
		}
	}
}
</script>


<style lang="scss" scoped>
input[type='text'] {
	width: 14em;
}
button {
	color: red;
	font-weight: 800;
}
</style>