<template>
	<div>
		<div class="field">
			<label class="label">Title</label>
			<div class="control">
				<input
					class="input"
					:class="{ 'is-danger': errors.title }"
					type="text"
					placeholder="title"
					name="title"
					autocomplete="off"
					v-model="titleWatch"
				>
			</div>
			<div v-if="errors.title">
				<p
					class="help is-danger"
					v-for="(error, index) in errors.title"
					:key="index"
				>
					{{ error }}
				</p>
			</div>
		</div>

		<div class="field">
			<label class="label">Slug</label>
			<div class="control">
				<input
					class="input"
					:class="{ 'is-danger': errors.slug }"
					type="text"
					placeholder="slug"
					name="slug"
					v-model="slug"
				>
			</div>
			<div v-if="errors.slug">
				<p
					class="help is-danger"
					v-for="(error, index) in errors.slug"
					:key="index"
				>
					{{ error }}
				</p>
			</div>
		</div>
			<div class="field">
            <label class="label">Typ prace</label>
                <div class="control content">
                    <input 
                        class="input"
						:class="{ 'is-danger': errors.type }"
                        type="text" 
                        placeholder="type"
                        name="type"
                        v-model="type"
						
                    >
                </div>

                <div v-if="errors.type">
                    <p 
                        class="help is-danger"
                        v-for="(error, index) in errors.type"
                        :key="index"
                    >
                        
                        {{ error }}
                    </p>
                </div>
        </div>

		  <div class="field">
            <label class="label">Datum smeny</label>
                <div class="control">
                    <input 
                        class="input"
                        type="date" 
                        placeholder="date"
                        name="date_work"
                        v-model="date_work"
                       
                    >
                </div>
        </div>

        <div class="field">
            <label class="label">Nastavte cas od od</label>
                <div class="columns">
                    <div class="column">
                        Od
                            <input 
                                class="input"
                                type="time" 
                                placeholder="time"
                                name="start_work"
                                v-model="start_work"
                            >
                    </div>
                    <div class="column">
                        Do
                             <input 
                                class="input"
                                type="time" 
                                placeholder="time"
                                name="end_work"
                                v-model="end_work"
                            >
                    </div>
                </div>
        </div>
	

		

		<div class="field">
			<label class="label">Text</label>
			<div class="control content">
				<input
					id="x"
					:value="text"
					type="hidden"
					name="text"
				>
				<trix-editor
					input="x"
					:class="{ 'input is-danger': errors.text }"
				></trix-editor>
			</div>
			<div v-if="errors.text">
				<p
					class="help is-danger"
					v-for="(error, index) in errors.text"
					:key="index"
				>
					{{ error }}
				</p>
			</div>
		</div>

		<div class="field is-grouped">
			<div class="control">
				<button
					@click="submitForm"
					class="button is-primary"
				>Submit</button>
			</div>
			<div class="control">
				<button
					@click="$router.go(-1)"
					class="button is-text"
				>Cancel</button>
			</div>
		</div>
	</div>
</template>


<script>
import trix from 'trix'

export default {
	props: ['errors', 'post'],
	data() {
		return {
			title: '',
			text: '',
			slug: '',
			type: '',
			date_work: '',
			start_work: '',
			end_work: ''
			
		}
	},
	mounted() {
		document.addEventListener('trix-change', () => {
			this.text = document.getElementById('x').value
		})
	},
	methods: {
		submitForm() {
			let data = {
				title: this.title,
				slug: this.slug,
				text: this.text,
				type: this.type,
				date_work: this.date_work,
				start_work: this.start_work,
				end_work: this.end_work,
				user_id: document.querySelector("meta[name='user_id']").getAttribute('content')
			}

			this.$emit('post-form-submitted', data)
		}
	},
	computed: {
		titleWatch: {
			get: function (value) {
				return value.title
			},
			set: function (value) {
				this.slug = _.trim(
					_.deburr(value.toLowerCase())
						.replace(/[^\w\s]/gi, '') // special characters
						.replace(/ {2,}/g, ' ') // repeating spaces
						.replace(/ /g, '-'), // spaces to -
					'-'
				)
				this.title = value
			}
		}
	},
	watch: {
		post(post) {
			this.title = post.title
			this.slug = post.slug
			this.text = post.text
			this.type = post.type
			this.date_work = post.date_work
			this.start_work = post.start_work
			this.end_work = post.end_work


			let trix = document.querySelector('trix-editor')
			trix.editor.insertHTML(post.text)
		}
	}
}
</script>


<style lang="scss" scoped>
@import '~trix/dist/trix.css';

trix-editor {
	min-height: 20em;
}
</style>