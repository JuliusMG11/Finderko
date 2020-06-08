<template>

	<div class="columns layout">
		<nav class="column is-2 main-navbar">
			<the-navigation />
		</nav>

		<main class="column is-10">
			<the-stats />
			<router-view />
		</main>

		<flash-message />
	</div>

</template>


<script>
import TheNavigation from './components/TheNavigation.vue'
import TheStats from './components/TheStats.vue'
import FlashMessage from './components/FlashMessage.vue'

export default {
	components: {
		TheNavigation,
		TheStats,
		FlashMessage
	}
}
</script>


<style lang="scss" scoped>
</style>