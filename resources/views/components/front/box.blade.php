@props([
  'type',
  'number',
  'title',
  'route',
  'model',
])

<div class="col-lg-3 col-6">
  <div class="small-box bg-{{ $type }}">
    <div class="inner">
      <h3>{{ $number }}</h3>
      <p>@lang($title)</p>
    </div>
    <div class="icon">
      <i class="ion ion-bag"></i>
    </div>
  </div>
</div>
