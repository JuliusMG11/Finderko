// let's rock
import '../bootstrap'

import router from './router'

// components
import FlashMessage from './components/FlashMessage.vue'
import Comment from './components/Comment.vue'
import CommentCreate from './components/CommentCreate.vue'
import Axios from 'axios'

// font awesome
import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserSecret } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'


library.add(faUserSecret)

Vue.component('font-awesome-icon', FontAwesomeIcon)

// vue me
const app = new Vue({
	el: '#app',
	router,
	components: {
		FlashMessage,
		Comment,
		CommentCreate,
	},
	mounted() {
		if (location.hash) {
			setTimeout(() => {
				let el = location.hash.replace('scroll-to-', '')
				document
					.querySelector(el)
					.scrollIntoView({ behavior: 'smooth' })
			}, 150)
		}
	}
})

window.flash = function(text) {	
	Axios.post('/flash-me', {data: text}).then(
		setTimeout( () => {
			document.location.reload(true)
		}, 1)
	)
}
