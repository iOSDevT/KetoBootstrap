@extends('layouts.app', ['title' => 'Keto Recipes: 300+ Recipes to Help You Lose Weight', 'description' => 'Being on the ketogenic diet does not mean you should lack variety in your foods. Here are 200+ Keto recipes that we make that keep food exciting.'])

@section('content')
<section class="welcome food2">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1 class="linewrap"><span>{{ ucwords($search) }}</span></h1>
				<h2 class="linewrap"><span>Search Results</span></h2>
			</div>
		</div>
	</div>
</section>
@include('partials.search')
<section class="content smoke">
	<div class="container">
		<div class="row">
			<div class="col-12">
				@if(count($recipes) == 0)
					<p>Sorry, no results found.</p>
				@else
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
							@foreach($recipes as $recipe)
								<tr>
									<td><a title="{{$recipe->name}}" href="/recipe/{{$recipe->slug}}">{{$recipe->name}}</a></td>
									<td>{{$recipe->calories }}</td>
									<td>{{$recipe->protein}}</td>
									<td>{{$recipe->fat}}</td>
									<td>{{$recipe->carbs}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@endif
			</div>
		</div>
	</div>
</section>
@endsection