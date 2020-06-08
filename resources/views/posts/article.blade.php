
<article class="post {{ $type }}">

	<header>
	<h2 class="title">
			<a href="/posts/{{ $post->slug }}">
				{{ $post->type }}
			</a>
		</h2>


		<div class="time-work">

		<p> <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($post->start_work)->format('h:s') }} - 
										{{ \Carbon\Carbon::parse($post->end_work)->format('h:s') }}	</p>
		
		
		<p><i class="fas fa-calendar-day"></i> {{ \Carbon\Carbon::parse($post->date_work)->format('d.m.Y')}}</p> 	
		  
		

		</div>

		<div class="adress-work">
			<p >
				<a href="/posts/{{ $post->slug }}">
				{{ $post->title }}
				</a>	
			</p>

		</div>

	</header>

	<div class="content">
		<p>{!! nl2br($post->text) !!}</p>
	</div>

	<footer class="meta">
		<a href="/users/{{ $post->user->id }}" class="author">
			@<strong>{{ $post->user->name }}</strong>
		</a>
		<a href="/posts/{{ $post->slug }}#scroll-to-comments" class="comments">
			{{ $post->comments->count() }}
			<strong>{{ str_plural('comment', $post->comments->count() ) }}</strong>
		</a>
	</footer>

</article>