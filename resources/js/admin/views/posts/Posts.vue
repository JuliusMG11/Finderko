<template>

	<section class="posts-page">

		<table-search
			:count="filteredItems.length"
			resource="post"
			@searchQueryChanged="search = $event"
			:loaded="loaded"
			:total="total"
		/>

		<table class="table is-bordered is-striped is-fullwidth">
			<thead>
				<tr>
					<th>id</th>
					<th>title</th>
					<th>Typ prace</th>
					<th>user</th>
					<th>date work</th>
					<th>start work</th>
					<th>end work</th>
					<th>published at</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr
					v-for="post in filteredItems"
					:key="post.id"
				>
					<td>{{ post.id }}</td>
					<td>
						{{ post.title }}
					</td>
					<td>
						{{ shorten(post.type) }}
					</td>
					<td>
						<a :href="'/admin/users/' + post.user.id">
							{{ post.user.name }}
						</a>
					</td>
					<td>
						{{ post.date_work }}
					</td>
					<td>
						{{ post.start_work }}
					</td>
					<td>
						{{ post.end_work }}
					</td>
					
					<td>
						{{ niceDate(post.created_at) }}
					</td>
					<td>
						<table-edit-links
							resource="post"
							:id="post.id"
						/>
					</td>
				</tr>
			</tbody>
		</table>

	</section>

</template>


<script>
import tableMixin from '../../mixins/tableMixin'
import TableSearch from '../../components/TableSearch.vue'
import TableEditLinks from '../../components/TableEditLinks.vue'

export default {
	data() {
		return {
			searchColumn: 'title',
			loaded: false,
			total: 0
		}
	},
	mixins: [tableMixin],
	components: {
		TableSearch,
		TableEditLinks
	},
	created() {
		axios.get('/api/posts/').then(response => {
			this.data = response.data
			this.loaded = true
			this.total = response.data.length
		})
	},
	mounted () {
		this.$root.$on('update', () => {this.total--});
	},
}
</script>


<style lang="scss" scoped>
small {
	font-size: 75%;
	color: #afafaf;
}
</style>