
<comment :comment-data="{{ $comment }}" inline-template>

	<article class="comment">

		<div
			ref="input"
			class="content"
			:contenteditable="editing"
			@input="textChanged"
			@blur="resetText"
			@keydown.esc="resetText"
			@keydown.enter="updateComment"
		>
			{{ $comment->text }}
		</div>

		<footer class="meta">

			<a href="/users/{{ $comment->user->id }}" class="author">
				@<strong>{{ $comment->user->name }}</strong>
			</a>

			<time datetime="{{ $comment->created_at->toW3cString() }}" class="has-text-grey">
				{{ $comment->created_at->diffForHumans() }}
			</time>

			@can('update', $comment)

			<a class="edit" @click="newEdit">Edit</a>

			<form style="display: inline-block" ref="deleteComment" method="POST" action="/comments/{{ $comment->id }}">
				<button class="delete" @click="deleteC">X</button>
				@method('delete')
				@csrf
			</form>

			<span class="controls has-text-grey" v-show="formEditing">
				<form ref="editForm" method="POST" action="/comments/{{ $comment->id }}" @submit="editComment">
					<textarea ref="commentEditArea" class="textarea" name="text" @keydown.esc="cancelEdit">{{ $comment->text }}</textarea><br>
					<input type="submit" class="button is-primary" value="Confirm">
					<button class="button is-light" @click="cancelEdit">Cancel</button>
					@method('put')
					@csrf
				</form>
			</span>
			@endcan

		</footer>

	</article>

</comment>