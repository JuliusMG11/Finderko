
@include('errors')

<comment-create inline-template>

	<div>
	
		<div class="field">
			<label class="label">
				be nice, dickhead
			</label>
			<div class="control">
				<textarea ref="comment" name="text" rows="3" class="textarea" placeholder="very nice words here" v-model="text"></textarea>
			</div>

			<div v-if="errors.text">
				<p
					class="help is-danger"
					v-for="(error, index) in errors.text"
					:key="index"
				>
					@{{ error }}
				</p>
			</div>
		</div>

		<div class="control">
			<button class="button is-warning" @click="addComment">
				add comment
			</button>
		</div>

		<input ref="postid" type="hidden" name="post_id" value="{{ $post->id }}">
		<input ref="userid" type="hidden" name="user_id" value="{{ auth()->user()->id }}">
		<input ref="apitoken" type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">

		<br>
		<hr>
		<br>

	</div>

</comment-create>