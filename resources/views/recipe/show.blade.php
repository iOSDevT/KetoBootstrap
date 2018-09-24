@extends('layouts.app', ['title' => $recipe->name.' Keto Recipe', 'description' => strip_tags($recipe->description).' Delicious keto recipe.'])

@section('content')
<section class="welcome food">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1 class="linewrap"><span>{{ $recipe->name }}</span></h1>
				<h2 class="linewrap d-print-none"><span><a href="/recipes">Keto Recipes</a></span></h2>
			</div>
		</div>
	</div>
</section>
<section class="content">
	<div class="container">
		<div class="row">
			<div class="col-12">
				{!! Form::open(['url' => 'recipesearch', 'class' => 'form-inline']) !!}
					<div class="form-row">
						<div class="col-9 form-group">
							<label class="sr-only" for="search">Search Recipes</label>
							<input style="width: 100%" type="text" class="form-control col-12" id="search" name="search" placeholder="Search for a recipe">
						</div>
						<div class="col-3 form-group">
							<button type="submit" class="btn btn-primary">Search</button>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</section>
<section class="content smoke">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-6 d-print-none">
				@unless(count($recipe->tags) < 1)
				<ul class="tags ">
					@foreach($recipe->tags as $tag)
						<li><a href="/keto-recipes/{{ $tag->slug }}">{{ ucwords($tag->tag) }}</a></li>
					@endforeach
				</ul>
				@endunless
				<div class="clearfix"></div>
				@if($recipe->source)
					<p><em>Original recipe can be found <a href="{{ $recipe->source }}" rel="nofollow">here</a>.</em></p>
				@endif
				<div class="d-print-none">{!! $recipe->description !!}</div>
			</div>
			<div class="col-12 col-lg-6">
				<div class="d-print-none" style="margin-bottom: 2rem;">
					@unless(Auth::user()->recipes->contains($recipe->id))
						<a href="" class="btn btn-success print-button" data-toggle="modal" data-target="#saveModal">Save Recipe</a>
					@endunless
					<a href="javascript:window.print()" class="btn btn-primary print-button">Print Recipe</a>
				</div>
				<h4>Servings: {{ $recipe->servings }}</h4>
				<div class="recipe-description">
					<p>{!! $recipe->serving_description !!}</p>
				</div>
				<h4>Nutritional Info (Per Serving)</h4>
				<table class="table">
					<thead>
						<tr>
							<td>Calories</td>
							<td>Fats (g)</td>
							<td>Protein (g)</td>
							<td>Net Carbs (g)</td>	
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $recipe->calories }}</td>
							<td>{{ $recipe->fat }}</td>
							<td>{{ $recipe->protein }}</td>
							<td>{{ $recipe->carbs }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</section>
@guest
<section class="content announcement d-print-none">
    <p style="margin-bottom: 0;" class="text-center"><a class="btn btn-lg btn-primary" href="/join">Sign up today for the 28-Day Weight Loss Challenge!</a></p>    
</section>
@endguest
<section class="content">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-6">
				<h4>Ingredients</h4>
				<ul class="list-unstyled ingredient-list">
					@foreach($recipe->ingredients as $ingredient)
						<li>@if($ingredient->pivot->item)[{{$ingredient->pivot->item}}] @endif<a href="/ingredient/{{ $ingredient->slug }}">{{ $ingredient->pivot->amount }} {{ strtolower($ingredient->pivot->measurement) }} {{ $ingredient->name }}</a> @isset($ingredient->link) [<a href="{{ $ingredient->link }}">get it here</a>]@endisset</li>
					@endforeach
				</ul>
			</div>
			<div class="col-12 col-lg-6">
					<h4>Instructions</h4>
					<ol>
						@foreach($recipe->instructions as $instruction)
							<li>{!! $instruction->description !!}</li>
						@endforeach
					</ol>
			</div>
		</div>
	</div>
</section>
<section class="content d-print-none smoke">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3 class="">More Delicious Keto Recipes</h3>
				<table class="table">
					<thead>
						<tr>
							<td>Recipe</td>
							<td>Calories</td>
							<td>Protein</td>
							<td>Fat</td>
							<td>Net Carbs</td>
						</tr>
					</thead>
					<tbody>
						@foreach($recipes as $rec)
							@unless($rec->id == $recipe->id)
								<tr>
									<td><a title="{{$rec->name}}" href="/recipe/{{$rec->slug}}">{{$rec->name}}</a></td>
									<td>{{$rec->calories }}</td>
									<td>{{$rec->protein}}</td>
									<td>{{$rec->fat}}</td>
									<td>{{$rec->carbs}}</td>
								</tr>
							@endunless
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
<div class="modal fade" tabindex="-1" role="dialog" id="saveModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Save This Recipe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['url' => 'recipeuser']) !!}
      <div class="modal-body">
        <div class="form-group">
        	<label for="category">Category</label>
        	<input class="form-control" type="text" name="category" id="category">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Recipe</button>
        <input type="hidden" name="recipe" value="{{ $recipe->id }}">
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection