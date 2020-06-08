<template>

	<section class="users-page">
		<table-search
			resource="user"
			:count="filteredItems.length"
			@searchQueryChanged="search = $event"
			:loaded="loaded"
			:total="total"
		/>

		<table class="table is-bordered is-striped is-fullwidth">
			<thead>
				<tr>
					<th>id</th>
					<th>name</th>
					<th>email</th>
					<th>registered at</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr
					v-for="user in filteredItems"
					:key="user.id"
				>
					<td>{{ user.id }}</td>
					<td>{{ user.name }}</td>
					<td>{{ user.email }}</td>
					<td>{{ niceDate(user.created_at) }}</td>
					<td>
						<table-edit-links
							resource="user"
							:id="user.id"
						/>
					</td>
				</tr>
			</tbody>
		</table>

	</section>

</template>


<script>
import tableMixin from '../../mixins/tableMixin'
import TableSearch from '../../components/TableSearch'
import TableEditLinks from '../../components/TableEditLinks.vue'

export default {
	mixins: [tableMixin],
	components: {
		TableSearch,
		TableEditLinks
	},
	data() {
		return {
			searchColumn: 'name',
			loaded: false,
			total: 0
		}
	},
	created() {
		axios.get('/api/users/').then(response => {
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